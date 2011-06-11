<?php
namespace HAPI;

/**
 * The interface for interacting with the Hyperiums API (HAPI).&nbsp;
 * Compatable with HAPI v0.1.8.
 * @author Mike Angstadt [github.com/mangstadt]
 * @version 0.1.0-SNAPSHOT
 */
class HAPI{
	/**
	 * The URL to the HAPI web service.
	 * @var string
	 */
	const URL = 'http://www.hyperiums.com/servlet/HAPI';
	
	/**
	 * The max number of requests per second you are allowed to send.
	 * @var integer
	 */
	const MAX_REQUESTS_PER_SEC = 3;
	
	/**
	 * The max number of requests per minute you are allowed to send.
	 * @var integer
	 */
	const MAX_REQUESTS_PER_MIN = 30;
	
	/**
	 * True to log all requests/responses, false not to.
	 * @var boolean
	 */
	private static $logMessages = false;
	
	/**
	 * True to enable flood protection, false not to.
	 * @var boolean
	 */
	private static $floodProtection = false;

	/**
	 * The HAPI session.
	 * @var HAPISession
	 */
	private $session;
	
	/**
	 * Creates a new HAPI connection.
	 * @param string $gameName the game to connect to
	 * @param string $username the username
	 * @param string $hapiKey the external authentication key (login to Hyperiums and go to Preferences &gt; Authentication to generate one)
	 * @throws Exception if there was a problem authenticating or the authentication failed
	 */
	public function __construct($gameName, $username, $hapiKey){
		$this->session = $this->authenticate($gameName, $username, $hapiKey);
	}
	
	/**
	 * Authenticates the user so HAPI requests can be made.
	 * @param string $gameName the game to connect to
	 * @param string $username the player's username
	 * @param string $hapiKey the external authentication key (to generate one, login to Hyperiums and go to "Preferences &gt; Authentication")
	 * @throws Exception if there was a problem authenticating or the authentication failed
	 * @return HAPISession the HAPI session info
	 */
	protected function authenticate($gameName, $username, $hapiKey){
		$params = array(
			"game"=>$gameName,
			"player"=>$username,
			"hapikey"=>$hapiKey
		);
		$respParams = self::sendRequest(null, $params);

		$session = new HAPISession($respParams["gameid"], $respParams["playerid"], $respParams["authkey"], strtotime($respParams["servertime"]));
		return $session;
	}
	
	/**
	 * Gets a list of all games.
	 * @throws Exception if there was a problem making the request
	 * @return array(Game) all games
	 */
	public static function getAllGames(){
		$respParams = self::sendRequest("games");
		
		//parse the game information from the response
		$games = array();
		for ($i = 0; isset($respParams["game$i"]); $i++){
			$game = new Game();
			$game->setName($respParams["game$i"]);
			$game->setState($respParams["state$i"]);
			$game->setDescription($respParams["descr$i"]);
			$game->setLength($respParams["length$i"]);
			$game->setMaxEndDate($respParams["maxenddate$i"]); //this isn't a date
			$game->setPeec($respParams["ispeec$i"]);
			$game->setMaxPlanets($respParams["maxplanets$i"]);
			$game->setInitCash($respParams["initcash$i"]);
			$game->setMaxOfferedPlanets($respParams["maxofferedplanets$i"]);
			$game->setNextPlanetDelay($respParams["nextplanetdelay$i"]);
			$games[] = $game;
		}
		return $games;
	}
	
	/**
	 * Downloads the daily-generated list of alliances.&nbsp;
	 * The list is gzipped and can only be downloaded once per day.
	 * @param string $username the account username
	 * @param string $password the account password
	 * @param string $gameName the game name
	 * @param string $file the path to save the file to.  The file name should end with ".txt.gz".
	 * @throws Exception if you have already downloaded the file today or there was a problem saving the file to disk
	 */
	public static function downloadAlliances($username, $password, $gameName, $file){
		self::download("alliances", $username, $password, $gameName, $file);
	}
	
	/**
	 * Downloads the daily-generated list of events.&nbsp;
	 * The list is gzipped and can only be downloaded once per day.
	 * @param string $username the account username
	 * @param string $password the account password
	 * @param string $gameName the game name
	 * @param string $file the path to save the file to.  The file name should end with ".txt.gz".
	 * @throws Exception if you have already downloaded the file today or there was a problem saving the file to disk
	 */
	public static function downloadEvents($username, $password, $gameName, $file){
		self::download("events", $username, $password, $gameName, $file);
	}
	
	/**
	 * Downloads the daily-generated list of players.&nbsp;
	 * The list is gzipped and can only be downloaded once per day.
	 * @param string $username the account username
	 * @param string $password the account password
	 * @param string $gameName the game name
	 * @param string $file the path to save the file to.  The file name should end with ".txt.gz".
	 * @throws Exception if you have already downloaded the file today or there was a problem saving the file to disk
	 */
	public static function downloadPlayers($username, $password, $gameName, $file){
		self::download("players", $username, $password, $gameName, $file);
	}
	
	/**
	 * Downloads the daily-generated list of planets.&nbsp;
	 * The list is gzipped and can only be downloaded once per day.
	 * @param string $username the account username
	 * @param string $password the account password
	 * @param string $gameName the game name
	 * @param string $file the path to save the file to.  The file name should end with ".txt.gz".
	 * @throws Exception if you have already downloaded the file today or there was a problem saving the file to disk
	 */
	public static function downloadPlanets($username, $password, $gameName, $file){
		self::download("planets", $username, $password, $gameName, $file);
	}
	
	/**
	 * Downloads one of the daily-generated lists.&nbsp;
	 * Each list is gzipped and can only be downloaded once per day.
	 * @param string $type the file type
	 * @param string $username the account username
	 * @param string $password the account password
	 * @param string $gameName the game name
	 * @param string $file the path to save the file to.  The file name should end with ".txt.gz".  If a file already exists with this name, it will be overwritten.
	 * @throws Exception if you have already downloaded the file today or there was a problem saving the file to disk
	 */
	private static function download($type, $username, $password, $gameName, $file){
		//create non-existant directories
		$dir = dirname($file);
		if (!file_exists($dir)){
			$result = mkdir($dir, 0774, true);
			if ($result === false){
				throw new \Exception("Could not create non-existant directories.");
			}
		}
		
		//send request
		$params = array(
			"game"=>$gameName,
			"player"=>$username,
			"passwd"=>$password,
			"filetype"=>$type
		);
		$response = self::sendRequest("download", $params, true);
		
		//save response to file
		$result = file_put_contents($file, $response);
		if ($result === false){
			throw new \Exception("Could not save the file.");
		}
	}
	
	/**
	 * Gets the HAPI session information.
	 * @return HAPISession the HAPI session information
	 */
	public function getSession(){
		return $this->session;
	}
	
	/**
	 * Gets information on all moving fleets.
	 * @throws Exception if there was a problem making the request
	 * @return array(MovingFleet)
	 */
	public function getMovingFleets(){
		$resp = $this->sendAuthRequest("getmovingfleets");
		
		$movingFleets = array();
		for ($i = 0; isset($resp["fleetid$i"]); $i++){
			$movingFleet = new MovingFleet();
			$movingFleet->setId($resp["fleetid$i"]);
			$movingFleet->setName($resp["fname$i"]);
			$movingFleet->setFrom($resp["from$i"]);
			$movingFleet->setTo($resp["to$i"]);
			$movingFleet->setDistance($resp["dist$i"]);
			$movingFleet->setDelay($resp["delay$i"]);
			$movingFleet->setDefending($resp["defend$i"]);
			$movingFleet->setAutoDropping($resp["autodrop$i"]);
			$movingFleet->setCamouflaged($resp["camouf$i"]);
			$movingFleet->setBombing($resp["bombing$i"]);
			$movingFleet->setRace($resp["race$i"]);
			$movingFleet->setBombers($resp["nbbomb$i"]);
			$movingFleet->setDestroyers($resp["nbdest$i"]);
			$movingFleet->setCruisers($resp["nbcrui$i"]);
			$movingFleet->setScouts($resp["nbscou$i"]);
			$movingFleet->setArmies($resp["nbarm$i"]);
			$movingFleets[] = $movingFleet;
		}
		return $movingFleets;
	}
	
	/**
	 * Gets exploitation information from all your planets.
	 * @throws Exception if there was a problem making the request
	 * @return array(Exploitation)
	 */
	public function getExploitations(){
		$respParams = $this->sendAuthRequest("getexploitations");
		
		$exploitations = array();
		for ($i = 0; isset($respParams["planet$i"]); $i++){
			$exploitation = new Exploitation();
			$exploitation->setPlanetName($respParams["planet$i"]);
			$exploitation->setPlanetId($respParams["planetid$i"]);
			$exploitation->setNumExploits($respParams["nbexp$i"]);
			$exploitation->setNumInPipe($respParams["inpipe$i"]);
			$exploitation->setNumToBeDemolished($respParams["tobedem$i"]);
			$exploitation->setNumOnSale($respParams["nbonsale$i"]);
			$exploitation->setSellPrice($respParams["sellprice$i"]);
			$exploitation->setRentability($respParams["rentability$i"]);
			$exploitations[] = $exploitation;
		}
		return $exploitations;
	}
	
	/**
	 * Gets info on a specific planet or all of your planets.&nbsp;
	 * Includes general, trading, and infiltration info.
	 * @param $planetName (optional) the name of a specific planet to retrieve info on. This can be a planet you own or a planet that you have fleets/armies stationed on. If this is left out, it will return info on all of your planets.
	 * @throws Exception if a planet with the given name does not exist or it is not under the player's control or there was a problem sending the request
	 * @return PlanetInfo|array(PlanetInfo) a single object if a planet name was specified, an array if not
	 */
	public function getPlanetInfo($planetName = null){
		//TODO what does the response look like when it's a foreign planet that you have units on?
		$planetInfos = array();

		$params = array();
		$params["planet"] = ($planetName == null) ? "*" : $planetName;
		
		//get general info
		$params["data"] = "general";
		$respParams = $this->sendAuthRequest("getplanetinfo", $params);
		for ($i = 0; isset($respParams["planet$i"]); $i++){
			$planetInfo = new PlanetInfo();
			$planetInfo->setName($respParams["planet$i"]);
			$planetInfo->setX($respParams["x$i"]);
			$planetInfo->setY($respParams["y$i"]);
			$planetInfo->setSize($respParams["size$i"]);
			$planetInfo->setOrbit($respParams["orbit$i"]);
			$planetInfo->setGovernment($respParams["gov$i"]);
			$planetInfo->setProdType($respParams["ptype$i"]);
			$planetInfo->setTax($respParams["tax$i"]);
			$planetInfo->setNumExploits($respParams["exploits$i"]);
			$planetInfo->setNumExploitsInPipe($respParams["expinpipe$i"]);
			$planetInfo->setActivity($respParams["activity$i"]);
			$planetInfo->setPopulation($respParams["pop$i"]);
			$planetInfo->setRace($respParams["race$i"]);
			$planetInfo->setNrj($respParams["nrj$i"]);
			$planetInfo->setNrjMax($respParams["nrjmax$i"]);
			$planetInfo->setPurifying($respParams["purif$i"]);
			$planetInfo->setParanoidMode($respParams["parano$i"]);
			$planetInfo->setBlockaded($respParams["block$i"]);
			$planetInfo->setBlackHole($respParams["bhole$i"]);
			$planetInfo->setStasis($respParams["stasis$i"]);
			$planetInfo->setNexusType($respParams["nexus$i"]);
			$planetInfo->setNexusBuildTimeLeft(@$respParams["nxbuild$i"]); //left out the planet does not have a nexus
			$planetInfo->setNexusBuildTimeTotal(@$respParams["nxbtot$i"]); //left out the planet does not have a nexus
			$planetInfo->setEcomark($respParams["ecomark$i"]);
			$planetInfo->setId($respParams["planetid$i"]);
			$planetInfo->setPublicTag($respParams["publictag$i"]);
			$planetInfo->setNumFactories($respParams["factories$i"]);
			$planetInfo->setCivLevel($respParams["civlevel$i"]);
			$planetInfo->setDefBonus($respParams["defbonus$i"]);
			$planetInfos[] = $planetInfo;
		}

		//get trading info
		$params["data"] = "trading";
		$respParams = $this->sendAuthRequest("getplanetinfo", $params);
		for ($i = 0; isset($respParams["planet$i"]) && $i < count($planetInfos); $i++){
			$planetInfo = $planetInfos[$i];
			
			$trades = array();
			//note: parse_str() replaces dots in parameter names with underscores (example: "tid0.0" becomes "tid0_0")
			for ($j = 0; isset($respParams["tid{$i}_$j"]); $j++){
				$trade = new Trade();
				$trade->setId($respParams["tid{$i}_$j"]);
				$trade->setPlanetName($respParams["toplanet{$i}_$j"]);
				$trade->setPlanetTag($respParams["tag{$i}_$j"]);
				$trade->setPlanetDistance($respParams["dist{$i}_$j"]);
				$trade->setPlanetX($respParams["x{$i}_$j"]);
				$trade->setPlanetY($respParams["y{$i}_$j"]);
				$trade->setPlanetRace($respParams["race{$i}_$j"]);
				$trade->setPlanetActivity($respParams["activity{$i}_$j"]);
				$trade->setIncome($respParams["incomeBT{$i}_$j"]);
				$trade->setCapacity($respParams["capacity{$i}_$j"]);
				$trade->setTransportType($respParams["transtype{$i}_$j"]);
				$trade->setPending($respParams["ispending{$i}_$j"]);
				$trade->setAccepted($respParams["isaccepted{$i}_$j"]);
				$trade->setRequestor($respParams["isrequestor{$i}_$j"]);
				$trade->setUpkeep($respParams["upkeep{$i}_$j"]);
				$trade->setProdType($respParams["prodtype{$i}_$j"]);
				$trade->setPlanetBlockaded($respParams["isblockade{$i}_$j"]);
				$trades[] = $trade;
			}
			$planetInfo->setTrades($trades);
			$planetInfos[] = $planetInfo;
		}
		
		//get infiltration info
		$params["data"] = "infiltr";
		$respParams = $this->sendAuthRequest("getplanetinfo", $params);
		for ($i = 0; isset($respParams["planet$i"]) && $i < count($planetInfos); $i++){
			$planetInfo = $planetInfos[$i];
			
			$infiltrations = array();
			//note: parse_str() replaces dots in parameter names with underscores (example: "tid0.0" becomes "tid0_0")
			for ($j = 0; isset($respParams["infid{$i}_$j"]); $j++){
				$infil = new Infiltration();
				$infil->setId($respParams["infid{$i}_$j"]);
				$infil->setPlanetName($respParams["planetname{$i}_$j"]);
				$infil->setPlanetTag($respParams["planettag{$i}_$j"]);
				$infil->setPlanetX($respParams["x{$i}_$j"]);
				$infil->setPlanetY($respParams["y{$i}_$j"]);
				$infil->setLevel($respParams["level{$i}_$j"]);
				$infil->setSecurity($respParams["security{$i}_$j"]);
				$infil->setGrowing($respParams["growing{$i}_$j"]);
				$infil->setCaptive($respParams["captive{$i}_$j"]);
				$infiltrations[] = $infil;
			}
			$planetInfo->setInfiltrations($infiltrations);
		}
		
		if ($planetName != null){
			return $planetInfos[0];
		}
		return $planetInfos;
	}
	
	/**
	 * Gets info on your fleets and armies that are stationed on a planet.&nbsp;
	 * Does not include fleets that are in transit (see getMovingFleets()).
	 * @param $planetName (optional) the name of a specific planet to retrieve fleet info on.
	 * This can be a planet you own or a planet that you have fleets/armies stationed on.
	 * If this is left out, it will return info on all of your planets and all planets that you have fleets/armies on.
	 * @throws Exception if there was a problem making the request
	 * @return array(FleetsInfo) an array of objects where each object represents planet that has 0 or more fleets
	 */
	public function getFleetsInfo($planetName = null){
		$fleetsInfos = array();
		
		$params = array();
		$params["planet"] = ($planetName == null) ? "*" : $planetName;
		
		//own planets
		$params["data"] = "own_planets";
		$resp = $this->sendAuthRequest("getfleetsinfo", $params);
		for ($i = 0; isset($resp["planet$i"]); $i++){
			$fleetsInfo = new FleetsInfo();
			$fleetsInfo->setOwnPlanet(true);
			$fleetsInfo->setPlanetName($resp["planet$i"]);
			$fleetsInfo->setStasis($resp["stasis$i"]);
			$fleetsInfo->setVacation($resp["vacation$i"]);
			$fleetsInfo->setNrj($resp["nrj$i"]);
			$fleetsInfo->setNrjMax($resp["nrjmax$i"]);
			$fleets = array();
			for ($j = 0; isset($resp["fleetid{$i}_$j"]); $j++){
				$fleet = new Fleet();
				$fleet->setId($resp["fleetid{$i}_$j"]);
				
				//if a fleet is never named, "null" will be returned
				//if a fleet is named, but its name is later removed, an empty string will be returned
				//this is true despite the fact that "[No name]" is displayed on the website in both cases 
				$name = $resp["fname{$i}_$j"];
				if ($name == "null"){
					$name = "";
				}
				
				$fleet->setName($name);
				$fleet->setSellPrice($resp["sellprice{$i}_$j"]);
				$fleet->setRace($resp["frace{$i}_$j"]);
				$fleet->setOwner($resp["owner{$i}_$j"]);
				$fleet->setDefending($resp["defend{$i}_$j"]);
				$fleet->setCamouflaged($resp["camouf{$i}_$j"]);
				$fleet->setBombing($resp["bombing{$i}_$j"]);
				$fleet->setAutoDropping($resp["autodrop{$i}_$j"]);
				$fleet->setDelay($resp["delay{$i}_$j"]);
				
				//note: army groups and fleet groups are separate, so if there are any ground armies in a fleet, there won't be any ships, and vice versa.
				
				$fleet->setGroundArmies(@$resp["garmies{$i}_$j"]);
				
				$fleet->setScouts(@$resp["scou{$i}_$j"]);
				$fleet->setCruisers(@$resp["crui{$i}_$j"]);
				$fleet->setBombers(@$resp["bomb{$i}_$j"]);
				$fleet->setDestroyers(@$resp["dest{$i}_$j"]);
				$fleet->setCarriedArmies(@$resp["carmies{$i}_$j"]);
				
				$fleets[] = $fleet;
			}
			$fleetsInfo->setFleets($fleets);
			$fleetsInfos[] = $fleetsInfo;
		}
		
		//foreign planets
		$params["data"] = "foreign_planets";
		$resp = $this->sendAuthRequest("getfleetsinfo", $params);
		for ($i = 0; isset($resp["planet$i"]); $i++){
			$fleetsInfo = new FleetsInfo();
			$fleetsInfo->setOwnPlanet(false);
			$fleetsInfo->setPlanetName($resp["planet$i"]);
			$fleetsInfo->setStasis($resp["stasis$i"]);
			$fleetsInfo->setVacation($resp["vacation$i"]);
			$fleets = array();
			for ($j = 0; isset($resp["fleetid{$i}_$j"]); $j++){
				$fleet = new Fleet();
				$fleet->setId($resp["fleetid{$i}_$j"]);
				$fleet->setName(@$resp["fname{$i}_$j"]);
				$fleet->setSellPrice($resp["sellprice{$i}_$j"]);
				$fleet->setRace($resp["frace{$i}_$j"]);
				$fleet->setOwner($resp["owner{$i}_$j"]);
				$fleet->setDefending($resp["defend{$i}_$j"]);
				$fleet->setCamouflaged($resp["camouf{$i}_$j"]);
				$fleet->setBombing(@$resp["bombing{$i}_$j"]);
				$fleet->setAutoDropping(@$resp["autodrop{$i}_$j"]);
				$fleet->setDelay(@$resp["delay{$i}_$j"]);
				
				//note: army groups and fleet groups are separate, so if there are any ground armies in a fleet, there won't be any ships, and vice versa.
				
				$fleet->setGroundArmies(@$resp["garmies{$i}_$j"]);
				
				$fleet->setScouts(@$resp["scou{$i}_$j"]);
				$fleet->setCruisers(@$resp["crui{$i}_$j"]);
				$fleet->setBombers(@$resp["bomb{$i}_$j"]);
				$fleet->setDestroyers(@$resp["dest{$i}_$j"]);
				$fleet->setCarriedArmies(@$resp["carmies{$i}_$j"]);
				
				$fleets[] = $fleet;
			}
			$fleetsInfo->setFleets($fleets);
			$fleetsInfos[] = $fleetsInfo;
		}
		
		return $fleetsInfos;
	}
	/**
	 * Gets a list of all planets that belong to an alliance.&nbsp;
	 * <br>A max of 50 planets are returned in each response.&nbsp; Use the <code>$start</code> parameter to specify what row it should start on.
	 * @param string $tag the alliance tag (without brackets, case-insensitive)
	 * @param integer $start (optional) the row in the list it should start on (defaults to the beginning of the list, first row is "0")
	 * @throws Exception if there was a problem making the request
	 * @return array(AlliancePlanet) the alliance planets
	 */
	public function getAlliancePlanets($tag, $start = 0){
		$alliancePlanets = array();
		
		$params = array(
			"tag"=>$tag,
			"start"=>$start
		);
		$resp = $this->sendAuthRequest("getallianceplanets", $params);
		$num = $resp["nb"];
		for ($i = 0; $i < $num; $i++){
			$alliancePlanet = new AlliancePlanet();
			$alliancePlanet->setName($resp["planet$i"]);
			$alliancePlanet->setOwner($resp["owner$i"]);
			$alliancePlanet->setX($resp["x$i"]);
			$alliancePlanet->setY($resp["y$i"]);
			$alliancePlanet->setProdType($resp["prodtype$i"]);
			$alliancePlanet->setRace($resp["race$i"]);
			$alliancePlanet->setActivity($resp["activity$i"]);
			$alliancePlanet->setPublicTag(@$resp["publictag$i"]); //not included if planet does not have a public tag
			$alliancePlanet->setPublicTagId(@$resp["ptagid$i"]); //not included if planet does not have a public tag
			$alliancePlanets[] = $alliancePlanet;
		}
		return $alliancePlanets;
	}
	
	/**
	 * Calls the "ismsg" method.
	 * @throws Exception if there was a problem making the request
	 * @return IsMsg the response
	 */
	public function isMsg(){
		$resp = $this->sendAuthRequest("ismsg");
		
		$isMsg = new IsMsg();
		$isMsg->setMsg($resp["ismsg"]);
		$isMsg->setReport($resp["isreport"]);
		return $isMsg;
	}
	
	/**
	 * Calls the "ismsginfo" method.
	 * @throws Exception if there was a problem making the request
	 * @teturn IsMsgInfo the response
	 */
	public function isMsgInfo(){
		$resp = $this->sendAuthRequest("ismsginfo");
		
		$isMsgInfo = new IsMsgInfo();
		$isMsgInfo->setMsg($resp["ismsg"]);
		$isMsgInfo->setPlanet($resp["isplanet"]);
		$isMsgInfo->setReport($resp["isreport"]);
		$isMsgInfo->setMilitary($resp["ismilitary"]);
		$isMsgInfo->setTrading($resp["istrading"]);
		$isMsgInfo->setInfiltration($resp["isinfiltr"]);
		$isMsgInfo->setControl($resp["iscontrol"]);
		return $isMsgInfo;
	}
	
	/**
	 * Gets all new player and planet messages.&nbsp;
	 * Note that these messages will be marked as "read" after this method is called.
	 * @throws Exception if there was a problem making the request
	 * @return array(Message) all new messages
	 */
	public function getNewMessages(){
		$messages = array();
		
		//this is confusing, see docs/example-responses.txt
		$resp = $this->sendAuthRequest("getnewmsg");
		$num = $resp["nbmsg"];
		if ($num > 0){
			$cur = 0;
			$curRecipient = null;
			$nextIndex = @$resp["planetstart$cur"];
			if ($nextIndex === null){
				$nextIndex = -1;
			}
			for ($i = 0; $i < $num; $i++){
				if ($i == $nextIndex){
					$curRecipient = $resp["planet$cur"];
					$cur++;
					$nextIndex = @$resp["planetstart$cur"];
				}
				
				$message = new Message();
				$message->setDate(strtotime($resp["date$i"]));
				$message->setType($resp["type$i"]);
				$message->setMessage($resp["msg$i"]);
				$message->setSubject($resp["subj$i"]);
				$sender = $resp["sender$i"];
				if ($sender == "null"){
					$sender = null;
				}
				$message->setSender($sender);
				$message->setRecipient($curRecipient);
				$messages[] = $message;
			}
		}
		return $messages;
	}
	
	/**
	 * Gets old player messages.
	 * @param \DateTime $startDate the start date
	 * @param integer $maxMessages the max number of messages to return
	 * @throws Exception if there was a problem making the request
	 * @return array(Message) the messages
	 */
	public function getOldPlayerMessages(\DateTime $startDate, $maxMessages){
		$messages = array();
		
		//TODO figure out how the start date works
		
		//$startDate->setTimezone(new \DateTimeZone("GMT")); //convert the start date to GMT
		$params = array(
			"startmsg"=>$startDate->format("Y-m-d G:i:s"),
			"maxmsg"=>$maxMessages
		);
		$resp = $this->sendAuthRequest("getoldpersomsg", $params);
		$num = $resp["nbmsg"];
		for ($i = 0; $i < $num; $i++){
			$message = new Message();
			$message->setDate(strtotime($resp["date$i"]));
			$message->setType(Message::TYPE_PERSONAL);
			$message->setMessage($resp["msg$i"]);
			$message->setSubject($resp["subj$i"]);
			$sender = $resp["sender$i"];
			if ($sender == "null"){
				$sender = null;
			}
			$message->setSender($sender);
			$messages[] = $message;
		}
		return $messages;
	}
	
	/**
	 * Gets old planet messages.
	 * @param \DateTime $startDate the start date
	 * @param integer $maxMessages the max number of messages to return
	 * @param string $planetName (optional) the planet you want to retrieve the messages of or null to get messages from all planets
	 * @throws Exception if there was a problem making the request
	 * @return array(Message) the messages
	 */
	public function getOldPlanetMessages(\DateTime $startDate, $maxMessages, $planetName = null){
		$messages = array();
		
		//TODO figure out how the start date works
		
		//$startDate->setTimezone(new \DateTimeZone("GMT")); //convert the start date to GMT
		$params = array(
			"startmsg"=>$startDate->format("Y-m-d G:i:s"),
			"maxmsg"=>$maxMessages,
			"planet"=>($planetName === null) ? "*" : $planetName
		);
		$resp = $this->sendAuthRequest("getoldplanetmsg", $params);
		$num = $resp["nbmsg"];
		for ($i = 0; $i < $num; $i++){
			$message = new Message();
			$message->setDate(strtotime($resp["date$i"]));
			$message->setType($resp["type$i"]);
			$message->setMessage($resp["msg$i"]);
			$message->setSubject($resp["subj$i"]);
			$sender = $resp["sender$i"];
			if ($sender == "null"){
				$sender = null;
			}
			$message->setSender($sender);
			$messages[] = $message;
		}
		return $messages;
	}
	
	/**
	 * Gets the version of HAPI.
	 * @throws Exception if there was a problem making the request
	 * @return string the version of HAPI
	 */
	public function getVersion(){
		$resp = $this->sendAuthRequest("version");
		return $resp["version"];
	}
	
	/**
	 * Logs you out of the current HAPI session.
	 * @throws Exception if there was a problem making the request
	 */
	public function logout(){
		$resp = $this->sendAuthRequest("logout");
		$status = $resp["status"];
		if ($status != "ok"){
			throw new \Exception("Logout failure.  Status code: $status");
		}
	}
	
	/**
	 * Gets info on a particular player.
	 * @param string $playerName (optional) the name of the player. If this is left out, then it will retrieve info on the authenticated player.
	 * @throws Exception if there was a problem making the request
	 * @return PlayerInfo the info on the player
	 */
	public function getPlayerInfo($playerName = null){
		$params = array();
		if ($playerName != null){
			$params["targetplayer"] = $playerName;
		}
		$resp = $this->sendAuthRequest("getplayerinfo", $params);
		
		$playerInfo = new PlayerInfo();
		$playerInfo->setName($resp["name"]);
		$playerInfo->setHypRank($resp["hyprank"]);
		$playerInfo->setRankinf($resp["rankinf"]);
		$playerInfo->setScoreinf($resp["scoreinf"]);
		if ($playerName == null){
			//these parameters only appear if you are asking for information about yourself
			$playerInfo->setCash($resp["cash"]);
			$playerInfo->setRankfin($resp["rankfin"]);
			$playerInfo->setScorefin($resp["scorefin"]);
			$playerInfo->setRankpow($resp["rankpow"]);
			$playerInfo->setScorepow($resp["scorepow"]);
			$playerInfo->setPlanets($resp["nbplanets"]);
			$playerInfo->setLastIncome($resp["lastincome"]);
		}
		return $playerInfo;
	}
	
	/**
	 * Sends a HAPI request.
	 * @param string $method the method to call
	 * @param array(string=>string) $params (optional) additional parameters to add to the request
	 * @param boolean $rawResponse (optional) true to return the raw response, false to parse the response as a query string and return an assoc array (default is false)
	 * @throws Exception if there was a problem sending the request or an error response was returned
	 * @return array(string=>string)|string the response
	 */
	protected static function sendRequest($method, array $params = array(), $rawResponse = false){
		//build request URL
		$params["request"] = $method;
		$url = self::URL . "?" . http_build_query($params);
		
		if (self::$floodProtection){
			//only allow one request to be sent every 2 seconds
			$lockFile = __DIR__ . "/flood.lock";
			$secondsPerRequest = 60/self::MAX_REQUESTS_PER_MIN;
			$fp = fopen($lockFile, "r");
			flock($fp, LOCK_EX);
			clearstatcache();
			$t = fileatime($lockFile);
			$diff = time() - $t;
			if ($diff >= 0 && $diff < $secondsPerRequest){
				//pause if a request was made recently
				sleep($secondsPerRequest-$diff);
			}
		}
		
		//make the request
		$response = file_get_contents($url);
		
		if (self::$floodProtection){
			//update the last-modified time and unlock
			touch($lockFile);
			flock($fp, LOCK_UN);
		}
		
		$failed = $response === false; //problem sending the request?
		
		if (self::$logMessages){
			//log the request and response
			
			$m = ($method == null) ? "<no method name>" : $method;
			
			if ($failed){
				$r = "<request failed>";
			} else if ($rawResponse && strlen($response) > 200){
				$r = substr($response, 0, 200) . "...snipped";
			} else {
				$r = $response;
			}
			
			error_log("HAPI request: $m\n  url: $url\n  response: $r\n\n");
		}
		
		//problem sending request?
		if ($failed){
			throw new \Exception("Problem sending the request.");
		}
		
		if ($rawResponse){
			//only return the raw response if it is not an error response
			$sub = substr($response, 0, 5);
			if ($sub != "error"){
				return $response;
			}
		}

		//ampersands are not URL encoded, so make them URL encoded so parse_str() doesn't break
		$response = str_replace("[:&:]", urlencode("&"), $response);
		
		//parse the query string into an assoc array
		parse_str($response, $respParams);
		
		//check for errors in the response
		$error = @$respParams["error"];
		if ($error !== null){
			throw new \Exception($error);
		}
		
		return $respParams;
	}
	
	/**
	 * Sends a HAPI request including auth info.
	 * @param string $method the method to call
	 * @param array(string=>string) $params (optional) additional parameters to add to the request
	 * @throws Exception if there was a problem sending the request or an error response was returned
	 * @return array(string=>string) the response
	 */
	protected function sendAuthRequest($method, array $params = array()){
		//add auth parameters
		$params["gameid"] = $this->session->getGameId();
		$params["playerid"] = $this->session->getPlayerId();
		$params["authkey"] = $this->session->getAuthKey();
		
		return self::sendRequest($method, $params);
	}
	
	/**
	 * Enables or disables the logging of all requests/responses to the PHP error log (disabled by default).
	 * @param boolean $logMessage true to enable, false to disable
	 */
	public static function setLogMessages($logMessages){
		self::$logMessages = $logMessages;
	}
	
	/**
	 * Enables or disables flood protection (disabled by default).&nbsp;
	 * This is to prevent the library from sending too many requests and breaking HAPI usage rules (max of 3 requests/second, 30 requests/minute).&nbsp;
	 * The file "flood.lock" must be writable by the web server process for this to work.
	 * @param boolean $floodProtection true to enable, false to disable
	 */
	public static function setFloodProtection($floodProtection){
		self::$floodProtection = $floodProtection;
	}
}