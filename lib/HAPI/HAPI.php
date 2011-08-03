<?php
namespace HAPI;

use \Exception;

/**
 * The interface for interacting with the Hyperiums API (HAPI).&nbsp;
 * Compatable with HAPI v0.1.8.
 * @package HAPI
 * @author Mike Angstadt [github.com/mangstadt]
 * @version 0.3.3
 */
class HAPI{
	/**
	 * The URL to the HAPI web service.
	 * @var string
	 */
	const URL = 'http://www.hyperiums.com/servlet/HAPI';
	
	/**
	 * One request can be sent every 2 seconds without breaking HAPI query limits.&nbsp;
	 * HAPI allows a max of 3 requests per second and 30 requests per minute.
	 * @var integer
	 */
	const SECONDS_PER_REQUEST = 2;
	
	const RACE_HUMAN = 0;
	const RACE_AZTERK = 1;
	const RACE_XILLOR = 2;
	
	const PROD_TYPE_ARGO = 0;
	const PROD_TYPE_MINERO = 1;
	const PROD_TYPE_TECHNO = 2;
	
	const GOV_DICT = 0;
	const GOV_AUTH = 1;
	const GOV_DEMO = 2;
	const GOV_HYP = 3;
	
	const RANK_ENSIGN = 0;
	const RANK_LIEUTENANT = 1;
	const RANK_LIEUTENANT_COMMANDER = 2;
	const RANK_COMMANDER = 3;
	const RANK_CAPTAIN = 4;
	const RANK_FLEET_CAPTAIN = 5;
	const RANK_COMMODORE = 6;
	const RANK_REAR_ADMIRAL = 7;
	const RANK_VICE_ADMIRAL = 8;
	const RANK_ADMIRAL = 9;
	const RANK_FLEET_ADMIRAL = 10;
	
	/**
	 * True to log all requests/responses, false not to.
	 * @var boolean
	 */
	private static $logFile;
	
	/**
	 * The absolute path to the lock directory that is used for flood protection or null to disable flood protection.&nbsp;
	 * This directory's permissions must allow PHP to write to it.
	 * @var string
	 */
	private $floodLockDir;

	/**
	 * The HAPI session.
	 * @var HAPISession
	 */
	private $session;
	
	/**
	 * Creates a new HAPI connection.
	 * @param string $gameName the game to connect to
	 * @param string $username the username
	 * @param string $hapiKey the external authentication key (login to Hyperiums and go to "Preferences &gt; Authentication" to generate one)
	 * @param string $floodLockDir (optional) the *absolute* path to the directory where the lock files will be stored (one file per user) or null to disable flood protection (defaults to null).  The directory must be writable by the web server process.
	 * @throws Exception if there was a problem authenticating or the authentication failed
	 */
	public function __construct($gameName, $username, $hapiKey, $floodLockDir = null){
		$this->setFloodProtection($floodLockDir);
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

		$session = new HAPISession($respParams["gameid"], $respParams["playerid"], $respParams["playername"], $respParams["authkey"], strtotime($respParams["servertime"]));
		return $session;
	}
	
	/**
	 * Gets a list of all games.
	 * @throws Exception if there was a problem making the request
	 * @return array(Game) all games
	 */
	public static function getGames(){
		$response = self::sendRequest("games");
		
		//parse the game information from the response
		$games = array();
		for ($i = 0; isset($response["game$i"]); $i++){
			$game = new Game();
			$game->setName($response["game$i"]);
			$game->setState($response["state$i"]);
			$game->setDescription($response["descr$i"]);
			$game->setLength($response["length$i"]);
			$maxEndDate = $response["maxenddate$i"];
			if ($maxEndDate == "null"){
				$maxEndDate = null;
			} else {
				$maxEndDate = strtotime($maxEndDate);
			}
			$game->setMaxEndDate($maxEndDate);
			$game->setPeec($response["ispeec$i"]);
			$game->setMaxPlanets($response["maxplanets$i"]);
			$game->setInitCash($response["initcash$i"]);
			$game->setMaxOfferedPlanets($response["maxofferedplanets$i"]);
			$game->setNextPlanetDelay($response["nextplanetdelay$i"]);
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
	 * @param string $file the *absolute* path to where the file should be saved to.  The file name should end with ".txt.gz".  If a file already exists at this location, it will be overwritten.
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
	 * @param string $file the *absolute* path to where the file should be saved to.  The file name should end with ".txt.gz".  If a file already exists at this location, it will be overwritten.
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
	 * @param string $file the *absolute* path to where the file should be saved to.  The file name should end with ".txt.gz".  If a file already exists at this location, it will be overwritten.
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
	 * @param string $file the *absolute* path to where the file should be saved to.  The file name should end with ".txt.gz".  If a file already exists at this location, it will be overwritten.
	 * @throws Exception if you have already downloaded the file today or there was a problem saving the file to disk
	 */
	public static function downloadPlanets($username, $password, $gameName, $file){
		self::download("planets", $username, $password, $gameName, $file);
	}
	
	/**
	 * Downloads one of the daily-generated lists.&nbsp;
	 * Each list is gzipped and can only be downloaded once per day.
	 * @param string $type the type of data file to download
	 * @param string $username the account username
	 * @param string $password the account password
	 * @param string $gameName the game name
	 * @param string $file the *absolute* path to where the file should be saved to.  The file name should end with ".txt.gz".  If a file already exists at this location, it will be overwritten.
	 * @throws Exception if you have already downloaded the file today or there was a problem saving the file to disk
	 */
	private static function download($type, $username, $password, $gameName, $file){
		//create non-existant directories
		$dir = dirname($file);
		if ($dir != "." && !file_exists($dir)){
			$result = mkdir($dir, 0774, true);
			if ($result === false){
				throw new Exception("Cannot create non-existant directories: $dir");
			}
		}
		
		//check to make sure the file can be created/written to before downloading
		$result = touch($file);
		if ($result === false){
			throw new \Exception("Cannot write to the specified location: $file");
		}
		
		//send request
		$params = array(
			"game"=>$gameName,
			"player"=>$username,
			"passwd"=>$password,
			"filetype"=>$type
		);
		$response = self::sendRequest("download", $params, null, true);
		
		//save response to file
		$result = file_put_contents($file, $response);
		if ($result === false){
			throw new Exception("Could not write the data file to disk after it was downloaded: $file");
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
		$response = $this->sendAuthRequest("getmovingfleets");
		
		$movingFleets = array();
		for ($i = 0; isset($response["fleetid$i"]); $i++){
			$movingFleet = new MovingFleet();
			$movingFleet->setId($response["fleetid$i"]);
			$movingFleet->setName($response["fname$i"]);
			$movingFleet->setFrom($response["from$i"]);
			$movingFleet->setTo($response["to$i"]);
			$movingFleet->setDistance($response["dist$i"]);
			$movingFleet->setDelay($response["delay$i"]);
			$movingFleet->setDefending(self::bool($response["defend$i"]));
			$movingFleet->setAutoDropping(self::bool($response["autodrop$i"]));
			$movingFleet->setCamouflaged(self::bool($response["camouf$i"]));
			$movingFleet->setBombing(self::bool($response["bombing$i"]));
			$movingFleet->setRace($response["race$i"]);
			$movingFleet->setBombers($response["nbbomb$i"]);
			$movingFleet->setDestroyers($response["nbdest$i"]);
			$movingFleet->setCruisers($response["nbcrui$i"]);
			$movingFleet->setScouts($response["nbscou$i"]);
			$movingFleet->setArmies($response["nbarm$i"]);
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
		$response = $this->sendAuthRequest("getexploitations");
		
		$exploitations = array();
		for ($i = 0; isset($response["planet$i"]); $i++){
			$exploitation = new Exploitation();
			$exploitation->setPlanetName($response["planet$i"]);
			$exploitation->setPlanetId($response["planetid$i"]);
			$exploitation->setExploits($response["nbexp$i"]);
			$exploitation->setInPipe($response["inpipe$i"]);
			$exploitation->setToBeDemolished($response["tobedem$i"]);
			$exploitation->setOnSale($response["nbonsale$i"]);
			$exploitation->setSellPrice($response["sellprice$i"]);
			$exploitation->setRentability($response["rentability$i"]);
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
		$planetInfos = array();

		$params = array();
		$params["planet"] = ($planetName == null) ? "*" : $planetName;
		
		//get general info
		$params["data"] = "general";
		$response = $this->sendAuthRequest("getplanetinfo", $params);
		
		//if the planet is foreign, then indexes aren't appended to the parameters and different info is returned
		if (isset($response["planet"])){
			$planetInfo = new PlanetInfo();
			$planetInfo->setForeign(true);
			$planetInfo->setName($response["planet"]);
			$planetInfo->setStasis(self::bool($response["stasis"]));
			$planetInfo->setBattle(self::bool($response["battle"]));
			$planetInfo->setBlockaded(self::bool($response["blockade"]));
			$planetInfo->setVacation(self::bool($response["vacation"]));
			$planetInfo->setHypergate(self::bool($response["hypergate"]));
			$planetInfo->setNeutral(self::bool(@$response["isneutral"])); //only appears if the planet is neutral?
			$planetInfo->setDefBonus(@$response["defbonus"]); //only appears if there's a battle?
			return $planetInfo;
		}
		
		for ($i = 0; isset($response["planet$i"]); $i++){
			$planetInfo = new PlanetInfo();
			$planetInfo->setForeign(false);
			$planetInfo->setName($response["planet$i"]);
			$planetInfo->setX($response["x$i"]);
			$planetInfo->setY($response["y$i"]);
			$planetInfo->setSize($response["size$i"]);
			$planetInfo->setOrbit($response["orbit$i"]);
			$planetInfo->setGovernment($response["gov$i"]);
			$planetInfo->setGovernmentCooldown($response["govd$i"]);
			$planetInfo->setProdType($response["ptype$i"]);
			$planetInfo->setTax($response["tax$i"]);
			$planetInfo->setExploits($response["exploits$i"]);
			$planetInfo->setExploitsInPipe($response["expinpipe$i"]);
			$planetInfo->setActivity($response["activity$i"]);
			$planetInfo->setPopulation($response["pop$i"]);
			$planetInfo->setRace($response["race$i"]);
			$planetInfo->setEnergy($response["nrj$i"]);
			$planetInfo->setEnergyMax($response["nrjmax$i"]);
			$planetInfo->setPurifying(self::bool($response["purif$i"]));
			$planetInfo->setParanoid(self::bool($response["parano$i"]));
			$planetInfo->setBlockaded(self::bool($response["block$i"]));
			$planetInfo->setBlackHole(self::bool($response["bhole$i"]));
			$planetInfo->setStasis(self::bool($response["stasis$i"]));
			$planetInfo->setNexusType($response["nexus$i"]);
			$planetInfo->setNexusBuildTimeLeft(@$response["nxbuild$i"]); //left out the planet does not have a nexus
			$planetInfo->setNexusBuildTimeTotal(@$response["nxbtot$i"]); //left out the planet does not have a nexus
			$planetInfo->setEcomark($response["ecomark$i"]);
			$planetInfo->setId($response["planetid$i"]);
			$planetInfo->setPublicTag($response["publictag$i"]);
			$planetInfo->setFactories($response["factories$i"]);
			$planetInfo->setCivLevel($response["civlevel$i"]);
			$planetInfo->setDefBonus($response["defbonus$i"]);
			$planetInfos[] = $planetInfo;
		}

		//get trading info
		$params["data"] = "trading";
		$response = $this->sendAuthRequest("getplanetinfo", $params);
		for ($i = 0; isset($response["planet$i"]) && $i < count($planetInfos); $i++){
			$planetInfo = $planetInfos[$i];
			
			$trades = array();
			//note: parse_str() replaces dots in parameter names with underscores (example: "tid0.0" becomes "tid0_0")
			for ($j = 0; isset($response["tid{$i}_$j"]); $j++){
				$trade = new Trade();
				$trade->setId($response["tid{$i}_$j"]);
				$trade->setPlanetName($response["toplanet{$i}_$j"]);
				$trade->setPlanetTag($response["tag{$i}_$j"]); //blank if the planet does not have a public tag
				$trade->setPlanetDistance($response["dist{$i}_$j"]);
				$trade->setPlanetX($response["x{$i}_$j"]);
				$trade->setPlanetY($response["y{$i}_$j"]);
				$trade->setPlanetRace($response["race{$i}_$j"]);
				$trade->setPlanetActivity($response["activity{$i}_$j"]);
				$trade->setIncome($response["incomeBT{$i}_$j"]);
				$trade->setCapacity($response["capacity{$i}_$j"]);
				$trade->setTransportType($response["transtype{$i}_$j"]);
				$trade->setPending(self::bool($response["ispending{$i}_$j"]));
				$trade->setAccepted(self::bool($response["isaccepted{$i}_$j"]));
				$trade->setRequestor(self::bool($response["isrequestor{$i}_$j"]));
				$trade->setUpkeep($response["upkeep{$i}_$j"]);
				$trade->setProdType($response["prodtype{$i}_$j"]);
				$trade->setBlockaded(self::bool($response["isblockade{$i}_$j"]));
				$trades[] = $trade;
			}
			$planetInfo->setTrades($trades);
		}
		
		//get infiltration info
		$params["data"] = "infiltr";
		$response = $this->sendAuthRequest("getplanetinfo", $params);
		for ($i = 0; isset($response["planet$i"]) && $i < count($planetInfos); $i++){
			$planetInfo = $planetInfos[$i];
			
			$infiltrations = array();
			//note: parse_str() replaces dots in parameter names with underscores (example: "tid0.0" becomes "tid0_0")
			for ($j = 0; isset($response["infid{$i}_$j"]); $j++){
				$infil = new Infiltration();
				$infil->setId($response["infid{$i}_$j"]);
				$infil->setPlanetName($response["planetname{$i}_$j"]);
				$infil->setPlanetTag(@$response["planettag{$i}_$j"]); //not included if planet does not have a public tag
				$infil->setPlanetX($response["x{$i}_$j"]);
				$infil->setPlanetY($response["y{$i}_$j"]);
				$infil->setLevel($response["level{$i}_$j"]);
				$infil->setSecurity($response["security{$i}_$j"]);
				$infil->setGrowing(self::bool($response["growing{$i}_$j"]));
				$infil->setCaptive($response["captive{$i}_$j"]);
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
		$response = $this->sendAuthRequest("getfleetsinfo", $params);
		for ($i = 0; isset($response["planet$i"]); $i++){
			$fleetsInfo = new FleetsInfo();
			$fleetsInfo->setForeign(false);
			$fleetsInfo->setPlanetName($response["planet$i"]);
			$fleetsInfo->setStasis(self::bool($response["stasis$i"]));
			$fleetsInfo->setVacation(self::bool($response["vacation$i"]));
			$fleetsInfo->setEnergy($response["nrj$i"]);
			$fleetsInfo->setEnergyMax($response["nrjmax$i"]);
			$fleets = array();
			for ($j = 0; isset($response["fleetid{$i}_$j"]); $j++){
				$fleet = new Fleet();
				$fleet->setId($response["fleetid{$i}_$j"]);
				
				//if a fleet is never named, "null" will be returned
				//if a fleet is named, but its name is later removed, an empty string will be returned
				$name = $response["fname{$i}_$j"];
				if ($name == "null"){
					$name = "";
				}
				
				$fleet->setName($name);
				$fleet->setSellPrice($response["sellprice{$i}_$j"]);
				$fleet->setRace($response["frace{$i}_$j"]);
				$fleet->setOwner($response["owner{$i}_$j"]);
				$fleet->setDefending(self::bool($response["defend{$i}_$j"]));
				$fleet->setCamouflaged(self::bool($response["camouf{$i}_$j"]));
				$fleet->setBombing(self::bool($response["bombing{$i}_$j"]));
				$fleet->setAutoDropping(self::bool($response["autodrop{$i}_$j"]));
				$fleet->setDelay($response["delay{$i}_$j"]);
				
				//note: army groups and fleet groups are separate, so if there are any ground armies in a fleet, there won't be any ships, and vice versa.
				
				$fleet->setGroundArmies(@$response["garmies{$i}_$j"]);
				
				$fleet->setScouts(@$response["scou{$i}_$j"]);
				$fleet->setCruisers(@$response["crui{$i}_$j"]);
				$fleet->setBombers(@$response["bomb{$i}_$j"]);
				$fleet->setDestroyers(@$response["dest{$i}_$j"]);
				$fleet->setCarriedArmies(@$response["carmies{$i}_$j"]);
				
				$fleets[] = $fleet;
			}
			$fleetsInfo->setFleets($fleets);
			$fleetsInfos[] = $fleetsInfo;
		}
		
		//foreign planets
		$params["data"] = "foreign_planets";
		$response = $this->sendAuthRequest("getfleetsinfo", $params);
		for ($i = 0; isset($response["planet$i"]); $i++){
			$fleetsInfo = new FleetsInfo();
			$fleetsInfo->setForeign(true);
			$fleetsInfo->setPlanetName($response["planet$i"]);
			$fleetsInfo->setStasis(self::bool($response["stasis$i"]));
			$fleetsInfo->setVacation(self::bool($response["vacation$i"]));
			$fleets = array();
			for ($j = 0; isset($response["fleetid{$i}_$j"]); $j++){
				$fleet = new Fleet();
				$fleet->setId($response["fleetid{$i}_$j"]);
				$fleet->setName(@$response["fname{$i}_$j"]);
				$fleet->setSellPrice($response["sellprice{$i}_$j"]);
				$fleet->setRace($response["frace{$i}_$j"]);
				$fleet->setOwner($response["owner{$i}_$j"]);
				$fleet->setDefending(self::bool($response["defend{$i}_$j"]));
				$fleet->setCamouflaged(self::bool($response["camouf{$i}_$j"]));
				$fleet->setBombing(self::bool(@$response["bombing{$i}_$j"]));
				$fleet->setAutoDropping(self::bool(@$response["autodrop{$i}_$j"]));
				$fleet->setDelay(@$response["delay{$i}_$j"]);
				
				//note: army groups and fleet groups are separate, so if there are any ground armies in a fleet, there won't be any ships, and vice versa.
				
				$fleet->setGroundArmies(@$response["garmies{$i}_$j"]);
				
				$fleet->setScouts(@$response["scou{$i}_$j"]);
				$fleet->setCruisers(@$response["crui{$i}_$j"]);
				$fleet->setBombers(@$response["bomb{$i}_$j"]);
				$fleet->setDestroyers(@$response["dest{$i}_$j"]);
				$fleet->setCarriedArmies(@$response["carmies{$i}_$j"]);
				
				$fleets[] = $fleet;
			}
			$fleetsInfo->setFleets($fleets);
			$fleetsInfos[] = $fleetsInfo;
		}
		
		return $fleetsInfos;
	}
	/**
	 * Gets a list of all planets that belong to an alliance.&nbsp;
	 * <br>A max of 50 planets are returned in each response.&nbsp; Use the $start parameter to specify what index in the list it should start on.
	 * @param string $tag the alliance tag (without brackets, case-insensitive)
	 * @param integer $start (optional) the list index that it should start on (defaults to the beginning of the list, first element is "0")
	 * @throws Exception if there was a problem making the request
	 * @return array(AlliancePlanet) the alliance planets
	 */
	public function getAlliancePlanets($tag, $start = 0){
		$alliancePlanets = array();
		
		$params = array(
			"tag"=>$tag,
			"start"=>$start
		);
		$response = $this->sendAuthRequest("getallianceplanets", $params);
		$num = $response["nb"];
		for ($i = 0; $i < $num; $i++){
			$alliancePlanet = new AlliancePlanet();
			$alliancePlanet->setName($response["planet$i"]);
			$alliancePlanet->setOwner($response["owner$i"]);
			$alliancePlanet->setX($response["x$i"]);
			$alliancePlanet->setY($response["y$i"]);
			$alliancePlanet->setProdType($response["prodtype$i"]);
			$alliancePlanet->setRace($response["race$i"]);
			$alliancePlanet->setActivity($response["activity$i"]);
			$alliancePlanet->setPublicTag(@$response["publictag$i"]); //not included if planet does not have a public tag
			$alliancePlanet->setPublicTagId(@$response["ptagid$i"]); //not included if planet does not have a public tag
			$alliancePlanets[] = $alliancePlanet;
		}
		return $alliancePlanets;
	}
	
	/**
	 * Determines whether the player has new messages or not.
	 * @throws Exception if there was a problem making the request
	 * @return IsMsg the response
	 */
	public function getIsMsg(){
		$response = $this->sendAuthRequest("ismsg");
		
		$isMsg = new IsMsg();
		$isMsg->setMessages(self::bool($response["ismsg"]));
		$isMsg->setBattleReports(self::bool($response["isreport"]));
		return $isMsg;
	}
	
	/**
	 * Determines whether the player has new messages or not.
	 * @throws Exception if there was a problem making the request
	 * @return IsMsgInfo the response
	 */
	public function getIsMsgInfo(){
		$response = $this->sendAuthRequest("ismsginfo");
		
		$isMsgInfo = new IsMsgInfo();
		$isMsgInfo->setMessages(self::bool($response["ismsg"]));
		$isMsgInfo->setPlanetMessages(self::bool($response["isplanet"]));
		$isMsgInfo->setBattleReports(self::bool($response["isreport"]));
		$isMsgInfo->setMilitary(self::bool($response["ismilit"]));
		$isMsgInfo->setTrading(self::bool($response["istrading"]));
		$isMsgInfo->setInfiltration(self::bool($response["isinfiltr"]));
		$isMsgInfo->setPlanetControl(self::bool($response["iscontrol"]));
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
		
		/*
		 * The response for this method groups the messages in a particular way.
		 * The player messages come first (messages that are directly addressed to the player).
		 * The planet messages come next (messages that are addressed to one of the player's planets).
		 * The planet messages are grouped by planet.
		 * The way to determine what planet a group of planet messages is addressed to, is by using these parameters: "planet0=Fayette&planetstart0=2".
		 * The messages whose indexes are >= the value of "planetstartN" are for the planet specified in the "planetN" parameter, up until the message whose index is specified in "planetstart(n+1)".
		 * These parameters make up their own "list" apart from the list of messages, so, for example, "planet0" doesn't mean this parameter belongs to the message at index 0.
		 */
		$response = $this->sendAuthRequest("getnewmsg");
		$num = $response["nbmsg"];
		if ($num > 0){
			$cur = 0;
			$curRecipient = null;
			$nextIndex = @$response["planetstart$cur"];
			if ($nextIndex === null){
				$nextIndex = -1;
			}
			for ($i = 0; $i < $num; $i++){
				if ($i == $nextIndex){
					$curRecipient = $response["planet$cur"];
					$cur++;
					$nextIndex = @$response["planetstart$cur"];
				}
				
				$message = new Message();
				$message->setDate(strtotime($response["date$i"]));
				$message->setType($response["type$i"]);
				$message->setMessage($response["msg$i"]);
				$message->setSubject($response["subj$i"]);
				$sender = $response["sender$i"];
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
	 * Gets old player messages sorted by date descending (newest messgaes first).
	 * @param integer $start the message to start on ("0" for the most recent message)
	 * @param integer $max the max number of messages to return
	 * @throws Exception if there was a problem making the request
	 * @return array(Message) the messages
	 */
	public function getOldPlayerMessages($start, $max){
		$messages = array();
		
		$params = array(
			"startmsg"=>$start,
			"maxmsg"=>$max
		);
		$response = $this->sendAuthRequest("getoldpersomsg", $params);
		$num = $response["nbmsg"];
		for ($i = 0; $i < $num; $i++){
			$message = new Message();
			$message->setDate(strtotime($response["date$i"]));
			$message->setType(Message::TYPE_PERSONAL);
			$message->setMessage($response["msg$i"]);
			$message->setSubject($response["subj$i"]);
			$sender = $response["sender$i"];
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
	 * @param integer $start the message to start on ("0" for the most recent message)
	 * @param integer $max the max number of messages to return
	 * @param string $planetName (optional) the planet to retrieve the messages of or null to get messages from all planets (defaults to null)
	 * @throws Exception if there was a problem making the request
	 * @return array(Message) the messages
	 */
	public function getOldPlanetMessages($start, $max, $planetName = null){
		$messages = array();

		$params = array(
			"startmsg"=>$start,
			"maxmsg"=>$max,
			"planet"=>($planetName == null) ? "*" : $planetName
		);
		$response = $this->sendAuthRequest("getoldplanetmsg", $params);
		$num = $response["nbmsg"];
		for ($i = 0; $i < $num; $i++){
			$message = new Message();
			$message->setDate(strtotime($response["date$i"]));
			$message->setType($response["type$i"]);
			$message->setMessage($response["msg$i"]);
			$message->setSubject($response["subj$i"]);
			$sender = $response["sender$i"];
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
		$response = $this->sendAuthRequest("version");
		return $response["version"];
	}
	
	/**
	 * Logs you out of the current HAPI session.
	 * @throws Exception if there was a problem making the request
	 */
	public function logout(){
		$response = $this->sendAuthRequest("logout");
		$status = $response["status"];
		if ($status != "ok"){
			throw new Exception("Logout failure.  Status code: $status");
		}
	}
	
	/**
	 * Gets info on a particular player.
	 * @param string $playerName (optional) the name of the player (defaults to the name of the currently authenticated player)
	 * @throws Exception if there was a problem making the request
	 * @return PlayerInfo the info on the player
	 */
	public function getPlayerInfo($playerName = null){
		$params = array();
		if ($playerName != null){
			$params["targetplayer"] = $playerName;
		}
		$response = $this->sendAuthRequest("getplayerinfo", $params);
		
		$playerInfo = new PlayerInfo();
		$playerInfo->setName($response["name"]);
		$playerInfo->setHypRank($response["hyprank"]);
		$playerInfo->setInfluenceRank($response["rankinf"]);
		$playerInfo->setInfluenceScore($response["scoreinf"]);
		if ($playerName == null){
			//these parameters only appear if you are asking for information about yourself
			$playerInfo->setCash($response["cash"]);
			$playerInfo->setFinancialRank($response["rankfin"]);
			$playerInfo->setFinancialScore($response["scorefin"]);
			$playerInfo->setMilitaryRank($response["rankpow"]);
			$playerInfo->setMilitaryScore($response["scorepow"]);
			$playerInfo->setPlanets($response["nbplanets"]);
			$playerInfo->setLastIncome($response["lastincome"]);
		}
		return $playerInfo;
	}
	
	/**
	 * Sends a HAPI request.
	 * @param string $method the method to call
	 * @param array(string=>string) $params (optional) additional parameters to add to the request
	 * @param string $floodLockFile (optional) the *absolute* path to the lock file or null to not use flood protection.  The lock file is an empty file that must be writable by the web server process.
	 * @param boolean $rawResponse (optional) true to return the raw response, false to parse the response as a query string and return an assoc array (default is false)
	 * @throws Exception if there was a problem sending the request or an error response was returned
	 * @return array(string=>string)|string the response
	 */
	protected static function sendRequest($method, array $params = array(), $floodLockFile = null, $rawResponse = false){
		//build request URL
		$params["request"] = $method;
		$reqFailsafe = time();
		$params["failsafe"] = $reqFailsafe;
		$url = self::URL . "?" . http_build_query($params);

		if ($floodLockFile != null){
			$fp = fopen($floodLockFile, "r");
			flock($fp, LOCK_EX);
			clearstatcache();
			$t = fileatime($floodLockFile);
			$diff = time() - $t;
			if ($diff >= 0 && $diff < self::SECONDS_PER_REQUEST){
				//pause if a request was made recently
				sleep(self::SECONDS_PER_REQUEST-$diff);
			}
		}
		
		//make the request
		$response = file_get_contents($url);
		
		if ($floodLockFile != null){
			//update the last-modified time and unlock
			touch($floodLockFile);
			flock($fp, LOCK_UN);
		}
		
		$failed = $response === false; //problem sending the request?
		
		if (self::$logFile != null){
			//log the request and response
			
			$m = ($method == null) ? "<no method name>" : $method;
			
			if ($failed){
				$r = "<request failed>";
			} else if ($rawResponse && strlen($response) > 200){
				$r = substr($response, 0, 200) . "...snipped";
			} else {
				$r = $response;
			}
			
			$msg = "HAPI request: $m\n  url: $url\n  response: $r\n";
			if (self::$logFile == 'php_error_log'){
				error_log($msg);
			} else {
				$now = date('Y-m-d H:i:s');
				$fp = fopen(self::$logFile, 'a');
				flock($fp, LOCK_EX);
				fwrite($fp, "$now: $msg");
				flock($fp, LOCK_UN);
				fclose($fp);
			}
		}
		
		//problem sending request?
		if ($failed){
			throw new Exception("Problem sending the request.");
		}
		
		if ($rawResponse){
			//only return the raw response if it is not an error response
			$sub = substr($response, 0, 5);
			if ($sub != "error"){
				return $response;
			}
		}

		//URL-encode ampersands for parse_str()
		$response = str_replace("[:&:]", urlencode("&"), $response);
		
		//parse the query string into an assoc array
		parse_str($response, $respParams);
		
		//throw an exception if the response is from a cache
		$respFailsafe = @$respParams["failsafe"];
		if ($respFailsafe != $reqFailsafe){
			throw new Exception("A different failsafe value was returned in the response.  Response does not contain up-to-date information.");
		}
		
		//check for errors in the response
		$error = @$respParams["error"];
		if ($error !== null){
			throw new Exception($error);
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
		
		//get the path to the lock file
		$lockFile = null;
		if ($this->floodLockDir != null){
			$lockFile = $this->floodLockDir . "/" . $this->session->getPlayerId();
			if (!file_exists($lockFile)){
				//create the lock file if it doesn't exist
				$success = touch($lockFile, time()-self::SECONDS_PER_REQUEST, time()-self::SECONDS_PER_REQUEST);
				if (!$success){
					throw new Exception("Could not create lock file \"$lockFile\" for flood protection. Make sure it's parent directory is writable by PHP.");
				}
			}  
		}
		
		return self::sendRequest($method, $params, $lockFile);
	}
	
	/**
	 * Sets the file where all requests/responses will be logged (logging is disabled by default).
	 * @param string $logFile the *absolute* path to the log file, "php_error_log" to write to the PHP error log, or null to disable logging
	 */
	public static function setLogFile($logFile){
		self::$logFile = $logFile;
	}
	
	/**
	 * Enables or disables flood protection (disabled by default).&nbsp;
	 * This is to prevent the library from sending too many requests and breaking HAPI usage rules (max of 3 requests/second, 30 requests/minute).
	 * @param string $lockDir the *absolute* path to the directory where the lock files will be stored (one file per user) or null to disable flood protection.  The directory must be writable by the web server process.
	 * @throws Exception if the lock directory isn't a directory, isn't writable, or can't be created
	 */
	public function setFloodProtection($lockDir){
		if ($lockDir != null){
			if (file_exists($lockDir)){
				//make sure it's a directory
				if (!is_dir($lockDir)){
					throw new Exception("Cannot enable flood protection.  The lock directory is not a directory: \"$lockDir\"");
				}
				
				//make sure the lock direcotry is writable
				if (!is_writable($lockDir)){
					throw new Exception("Cannot enable flood protection. The file permissions of the lock directory do not allow PHP to write to it: \"$lockDir\"");
				}
			} else {
				//create the lock directory if it doesn't exist
				$success = mkdir($lockDir, 0774, true);
				if (!$success){
					throw new Exception("Could not create lock directory \"$lockDir\". Check to make sure that it's an absolute path and that it's writable by PHP.");
				}
			}
		}
		$this->floodLockDir = $lockDir;
	}
	
	/**
	 * Converts a response parameter to a boolean.
	 * @param string $value the parameter value
	 * @return boolean the boolean value or null if the parameter is null
	 */
	private static function bool($value){
		if ($value === null){
			return null;
		}
		return $value == "1";
	}
}