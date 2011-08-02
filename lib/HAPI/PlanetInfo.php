<?php
namespace HAPI;

/**
 * Contains various information on a planet (used for the "getplanetinfo" HAPI method).
 * @package HAPI
 * @author Mike Angstadt [github.com/mangstadt]
 */
class PlanetInfo{
	const NEXUS_TYPE_NONE = 0;
	const NEXUS_TYPE_ADMIN = 1;
	const NEXUS_TYPE_SATEL = 2;
	
	/**
	 * True if the planet is foreign, false if the player controls it.
	 * @var boolean
	 */
	private $foreign;
	
	/**
	 * The planet name.
	 * @var string
	 */
	private $name;
	
	/**
	 * The planet's x-coordinate.
	 * @var integer
	 */
	private $x;
	
	/**
	 * The planet's y-coordinate.
	 * @var integer
	 */
	private $y;
	
	/**
	 * The planet's size.
	 * @var integer
	 */
	private $size;
	
	/**
	 * The planet's orbital position in its local star system.
	 * @var integer
	 */
	private $orbit;
	
	/**
	 * The planet's government type (see HAPI::GOV_*).
	 * @var integer
	 */
	private $government;
	
	/**
	 * The number of days before the planet's government type can be changed.
	 * @var integer
	 */
	private $governmentCooldown;
	
	/**
	 * The planet's production type (see HAPI::PROD_TYPE_*).
	 * @var integer
	 */
	private $prodType;
	
	/**
	 * The planet's tax rate (0 to 100).
	 * @var integer
	 */
	private $tax;
	
	/**
	 * The planet's number of exploitations.
	 * @var integer
	 */
	private $exploits;
	
	/**
	 * The number of exploitations that are being created.
	 * @var intger
	 */
	private $exploitsInPipe;
	
	/**
	 * The planet's activity.
	 * @var integer
	 */
	private $activity;
	
	/**
	 * The planet's population in millions.
	 * @var integer
	 */
	private $population;
	
	/**
	 * The planet's race (see HAPI::RACE_*).
	 * @var integer
	 */
	private $race;
	
	/**
	 * The amount of energy the planet has.
	 * @var integer
	 */
	private $energy;
	
	/**
	 * The max amount of energy the planet can have.
	 * @var integer
	 */
	private $energyMax;
	
	/**
	 * True if the player is purifying the planet, false if not.
	 * @var boolean
	 */
	private $purifying;
	
	/**
	 * True if the planet is in paranoid mode, false if not.
	 * @var boolean
	 */
	private $paranoid;
	
	/**
	 * True if the planet is blockaded, false if not.
	 * @var boolean
	 */
	private $blockaded;
	
	/**
	 * True if the planet's system has a black hole, false if not.
	 * @var boolean
	 */
	private $blackHole;
	
	/**
	 * True if the planet is in stasis, false if not.
	 * @var unknown_type
	 */
	private $stasis;
	
	/**
	 * The nexus type (see PlanetInfo::NEXUS_TYPE_* constants).
	 * @var integer
	 */
	private $nexusType;
	
	/**
	 * The number of hours left it will take to build the nexus.&nbsp;
	 * Null if there is no completed nexus or no nexus being built.
	 * @var integer
	 */
	private $nexusBuildTimeLeft;
	
	/**
	 * The total number of hours it will take to build the nexus.&nbsp;
	 * Zero if the nexus is complete.&nbsp;
	 * Null if there is no completed nexus or no nexus being built.
	 * @var integer
	 */
	private $nexusBuildTimeTotal;
	
	/**
	 * The planet's ecomark.
	 * @var integer
	 */
	private $ecomark;
	
	/**
	 * The planet's ID
	 * @var integer
	 */
	private $id;
	
	/**
	 * The planet's public tag or null if it doesn't have one.
	 * @var string
	 */
	private $publicTag;
	
	/**
	 * The number of factories on the planet.
	 * @var integer
	 */
	private $factories;
	
	/**
	 * The civilization level of the planet.
	 * @var integer
	 */
	private $civLevel;
	
	/**
	 * The planet's defense bonus (ex: "10" for 10%)
	 * @var integer
	 */
	private $defBonus;
	
	/**
	 * True if the planet has a hypergate, false if not.
	 * @var boolean
	 */
	private $hypergate;
	
	/**
	 * True if the planet is neutral, false if not.
	 * @var boolean
	 */
	private $neutral;
	
	/**
	 * True if there is a battle happening on the planet, false if not.
	 * @var boolean
	 */
	private $battle;
	
	/**
	 * True if the planet owner is on vacation, false if not.
	 * @var boolean
	 */
	private $vacation;
	
	/**
	 * The planet's trading relations.
	 * @var array(Trade)
	 */
	private $trades = array();
	
	/**
	 * The planet's infiltrations.
	 * @var array(Infiltration)
	 */
	private $infiltrations = array();
	
	/**
	 * Gets whether the planet is foreign or not.
	 * @return boolean true if the planet is foreign, false if the player controls the planet
	 */
	public function isForeign(){
		return $this->foreign;
	}
	
	/**
	 * Sets whether the planet is foreign or not.
	 * @param boolean $foreign true if the planet is foreign, false if the player controls the planet
	 */
	public function setForeign($foreign){
		$this->foreign = $foreign;
	}
	
	/**
	 * Gets the planet name.
	 * @return string the planet name
	 */
	public function getName(){
		return $this->name;
	}
	
	/**
	 * Sets the planet name.
	 * @param string $name the planet name
	 */
	public function setName($name){
		$this->name = $name;
	}
	
	/**
	 * Gets the planet's x-coordinate.
	 * @return integer the planet's x-coordinate
	 */
	public function getX(){
		return $this->x;
	}

	/**
	 * Sets the planet's x-coordinate.
	 * @param integer $x the planet's x-coordinate
	 */
	public function setX($x){
		$this->x = $x;
	}

	/**
	 * Gets the planet's y-coordinate.
	 * @return integer the planet's y-coordinate
	 */
	public function getY(){
		return $this->y;
	}

	/**
	 * Sets the planet's y-coordinate.
	 * @param integer $y the planet's y-coordinate
	 */
	public function setY($y){
		$this->y = $y;
	}

	/**
	 * Gets the planet's size.
	 * @return integer the planet's size
	 */
	public function getSize(){
		return $this->size;
	}

	/**
	 * Sets the planet's size.
	 * @param integer $size the planet's size
	 */
	public function setSize($size){
		$this->size = $size;
	}

	/**
	 * Gets the planet's orbital position in its local star system.
	 * @return integer the orbital position
	 */
	public function getOrbit(){
		return $this->orbit;
	}

	/**
	 * Sets the planet's orbital position in its local star system.
	 * @param integer $orbit the orbital position
	 */
	public function setOrbit($orbit){
		$this->orbit = $orbit;
	}

	/**
	 * Gets the planet's government type.
	 * @return integer the planet's government type (see HAPI::GOV_*)
	 */
	public function getGovernment(){
		return $this->government;
	}

	/**
	 * Sets the planet's government type.
	 * @param integer $government the planet's government type (see HAPI::GOV_*)
	 */
	public function setGovernment($government){
		$this->government = $government;
	}
	
	/**
	 * Gets the number of days before the planet's government type can be changed.
	 * @return integer the number of days before the planet's government type can be changed.
	 */
	public function getGovernmentCooldown(){
		return $this->governmentCooldown;
	}
	
	/**
	 * Sets the number of days before the planet's government type can be changed.
	 * @param integer $governmentCooldown the number of days before the planet's government type can be changed.
	 */
	public function setGovernmentCooldown($governmentCooldown){
		$this->governmentCooldown = $governmentCooldown;
	}

	/**
	 * Gets the planet's production type.
	 * @return integer the planet's production type (see HAPI::PROD_TYPE_*)
	 */
	public function getProdType(){
		return $this->prodType;
	}

	/**
	 * Sets the planet's production type.
	 * @param integer $prodType the planet's production type (see HAPI::PROD_TYPE_*)
	 */
	public function setProdType($prodType){
		$this->prodType = $prodType;
	}

	/**
	 * Gets the planet's tax rate.
	 * @return integer the tax rate (0 to 100)
	 */
	public function getTax(){
		return $this->tax;
	}

	/**
	 * Sets the planet's tax rate.
	 * @param integer $tax the tax rate (0 to 100)
	 */
	public function setTax($tax){
		$this->tax = $tax;
	}

	/**
	 * Gets the number of exploitations the planet has.
	 * @return integer the number of exploitations
	 */
	public function getExploits(){
		return $this->exploits;
	}

	/**
	 * Sets the number of exploitations the planet has.
	 * @param integer $exploits the number of exploitations
	 */
	public function setExploits($exploits){
		$this->exploits = $exploits;
	}

	/**
	 * Gets the number of exploitations that are being created.
	 * @return integer the number of exploitations being built
	 */
	public function getExploitsInPipe(){
		return $this->exploitsInPipe;
	}

	/**
	 * Sets the number of exploitations that are being created.
	 * @param integer $exploitsInPipe the number of exploitations being built
	 */
	public function setExploitsInPipe($exploitsInPipe){
		$this->exploitsInPipe = $exploitsInPipe;
	}

	/**
	 * Gets the planet's activity.
	 * @return integer the planet's activity
	 */
	public function getActivity(){
		return $this->activity;
	}

	/**
	 * Sets the planet's activity.
	 * @param integer $activity the planet's activity
	 */
	public function setActivity($activity){
		$this->activity = $activity;
	}

	/**
	 * Gets the planet's population.
	 * @return integer the population in millions
	 */
	public function getPopulation(){
		return $this->population;
	}

	/**
	 * Sets the planet's population.
	 * @param integer $population the population in millions
	 */
	public function setPopulation($population){
		$this->population = $population;
	}

	/**
	 * Gets the planet's race.
	 * @return integer the planet's race (see HAPI::RACE_*)
	 */
	public function getRace(){
		return $this->race;
	}

	/**
	 * Sets the planet's race.
	 * @param integer $race the planet's race (see HAPI::RACE_*)
	 */
	public function setRace($race){
		$this->race = $race;
	}

	/**
	 * Gets the amount of energy the planet has.
	 * @return integer the planet's available energy
	 */
	public function getEnergy(){
		return $this->energy;
	}

	/**
	 * Sets the amount of energy the planet has.
	 * @param integer $energy the planet's available energy
	 */
	public function setEnergy($energy){
		$this->energy = $energy;
	}

	/**
	 * Gets the max amount of energy the planet can have.
	 * @return integer the planet's max energy
	 */
	public function getEnergyMax(){
		return $this->energyMax;
	}

	/**
	 * Sets the max amount of energy the planet can have.
	 * @param integer $energyMax the planet's max energy
	 */
	public function setEnergyMax($energyMax){
		$this->energyMax = $energyMax;
	}

	/**
	 * Gets whether the planet is being purified or not.
	 * @return boolean true if the planet is being purified, false if not
	 */
	public function isPurifying(){
		return $this->purifying;
	}

	/**
	 * Sets whether the planet is being purified or not.
	 * @param boolean $purifying true if the planet is being purified, false if not
	 */
	public function setPurifying($purifying){
		$this->purifying = $purifying;
	}

	/**
	 * Gets whether the planet is in paranoid mode.
	 * @return boolean true if the planet is in paranoid mode, false if not
	 */
	public function isParanoid(){
		return $this->paranoid;
	}

	/**
	 * Sets whether the planet is in paranoid mode.
	 * @param boolean $paranoid true if the planet is in paranoid mode, false if not
	 */
	public function setParanoid($paranoid){
		$this->paranoid = $paranoid;
	}

	/**
	 * Gets whether the planet is blockaded.
	 * @return boolean true if the planet is blockaded, false if not
	 */
	public function isBlockaded(){
		return $this->blockaded;
	}

	/**
	 * Sets whether the planet is blockaded.
	 * @param boolean $blockaded true if the planet is blockaded, false if not
	 */
	public function setBlockaded($blockaded){
		$this->blockaded = $blockaded;
	}

	/**
	 * Gets whether the planet's system has a black hole.
	 * @return boolean true if it does, false if not
	 */
	public function isBlackHole(){
		return $this->blackHole;
	}

	/**
	 * Sets whether the planet's system has a black hole.
	 * @param boolean $blackHole true if it does, false if not
	 */
	public function setBlackHole($blackHole){
		$this->blackHole = $blackHole;
	}

	/**
	 * Gets whether the planet is in stasis.
	 * @return boolean true if it is in stasis, false if not
	 */
	public function isStasis(){
		return $this->stasis;
	}

	/**
	 * Sets whether the planet is in stasis.
	 * @param boolean $stasis true if it is in stasis, false if not
	 */
	public function setStasis($stasis){
		$this->stasis = $stasis;
	}

	/**
	 * Gets the nexus type.
	 * @return integer the nexus type (see PlanetInfo::NEXUS_TYPE_* constants)
	 */
	public function getNexusType(){
		return $this->nexusType;
	}

	/**
	 * Sets the nexus type.
	 * @param integer $nexusType the nexus type (see PlanetInfo::NEXUS_TYPE_* constants)
	 */
	public function setNexusType($nexusType){
		$this->nexusType = $nexusType;
	}

	/**
	 * Gets the number of hours left it will take to build the nexus.
	 * @return integer the number of hours left. Null if there is no completed nexus or no nexus being built.
	 */
	public function getNexusBuildTimeLeft(){
		return $this->nexusBuildTimeLeft;
	}

	/**
	 * Sets the number of hours left it will take to build the nexus.
	 * @param integer $nexusBuildTimeLeft the number of hours left. Null if there is no completed nexus or no nexus being built.
	 */
	public function setNexusBuildTimeLeft($nexusBuildTimeLeft){
		$this->nexusBuildTimeLeft = $nexusBuildTimeLeft;
	}

	/**
	 * Gets the total number of hours it will take to build the nexus.
	 * @return integer the total number of hours. Zero if the nexus is complete. Null if there is no completed nexus or no nexus being built.
	 */
	public function getNexusBuildTimeTotal(){
		return $this->nexusBuildTimeTotal;
	}

	/**
	 * Sets the total number of hours it will take to build the nexus.
	 * @param integer $nexusBuildTimeTotal the total number of hours. Zero if the nexus is complete. Null if there is no completed nexus or no nexus being built.
	 */
	public function setNexusBuildTimeTotal($nexusBuildTimeTotal){
		$this->nexusBuildTimeTotal = $nexusBuildTimeTotal;
	}

	/**
	 * Gets the planet's ecomark.
	 * @return integer the planet's ecomark
	 */
	public function getEcomark(){
		return $this->ecomark;
	}

	/**
	 * Sets the planet's ecomark.
	 * @param integer $ecomark the planet's ecomark
	 */
	public function setEcomark($ecomark){
		$this->ecomark = $ecomark;
	}
	
	/**
	 * Gets the planet's ID.
	 * @return integer the planet's ID
	 */
	public function getId(){
		return $this->id;
	}
	
	/**
	 * Sets the planet's ID.
	 * @param integer $id the planet's ID
	 */
	public function setId($id){
		$this->id = $id;
	}

	/**
	 * Gets the planet's public alliance tag.
	 * @return string the planet's public tag or null if it doesn't have one
	 */
	public function getPublicTag(){
		return $this->publicTag;
	}

	/**
	 * Sets the planet's public alliance tag.
	 * @param string $publicTag the planet's public tag or null if it doesn't have one
	 */
	public function setPublicTag($publicTag){
		$this->publicTag = $publicTag;
	}

	/**
	 * Gets the number of factories the planet has.
	 * @return integer the number of factories
	 */
	public function getFactories(){
		return $this->factories;
	}

	/**
	 * Sets the number of factories the planet has.
	 * @param integer $factories the number of factories
	 */
	public function setFactories($factories){
		$this->factories = $factories;
	}

	/**
	 * Gets the planet's civilization level.
	 * @return integer the civ level
	 */
	public function getCivLevel(){
		return $this->civLevel;
	}

	/**
	 * Sets the planet's civilization level.
	 * @param integer $civLevel the civ level
	 */
	public function setCivLevel($civLevel){
		$this->civLevel = $civLevel;
	}

	/**
	 * Gets the planet's defense bonus.
	 * @return integer the planet's defense bonus (ex: "10" for 10%)
	 */
	public function getDefBonus(){
		return $this->defBonus;
	}

	/**
	 * Sets the planet's defense bonus.
	 * @param integer $defBonus the planet's defense bonus (ex: "10" for 10%)
	 */
	public function setDefBonus($defBonus){
		$this->defBonus = $defBonus;
	}
	
	/**
	 * Gets whether the planet has a hypergate.
	 * @return boolean true if the planet does, false if not
	 */
	public function isHypergate(){
		return $this->hypergate;
	}
	
	/**
	 * Sets whether the planet has a hypergate or not.
	 * @param boolean $hypergate true if the planet does, false if not
	 */
	public function setHypergate($hypergate){
		$this->hypergate = $hypergate;
	}
	
	/**
	 * Gets whether the planet is neutral or not.
	 * @return boolean true if it is neutral, false if not
	 */
	public function isNeutral(){
		return $this->neutral;
	}
	
	/**
	 * Sets whether the planet is neutral or not.
	 * @param boolean $neutral true if it is neutral, false if not
	 */
	public function setNeutral($neutral){
		$this->neutral = $neutral;
	}
	
	/**
	 * Gets whether a battle is happening on the planet.
	 * @return boolean true if there is a battle, false if not
	 */
	public function isBattle(){
		return $this->battle;
	}

	/**
	 * Sets whether a battle is happening on the planet.
	 * @param boolean $battle true if there is a battle, false if not
	 */
	public function setBattle($battle){
		$this->battle = $battle;
	}

	/**
	 * Gets whether the planet owner is on vacation.
	 * @return boolean true if the owner is on vacation, false if not
	 */
	public function isVacation(){
		return $this->vacation;
	}

	/**
	 * Sets whether the planet owner is on vacation.
	 * @param boolean $vacation true if the owner is on vacation, false if not
	 */
	public function setVacation($vacation){
		$this->vacation = $vacation;
	}

	/**
	 * Gets the planet's trading relations.
	 * @return array(Trade) the trading relations
	 */
	public function getTrades(){
		return $this->trades;
	}

	/**
	 * Sets the planet's trading relations.
	 * @param array(Trade) $trades the trading relations
	 */
	public function setTrades($trades){
		$this->trades = $trades;
	}
	
	/**
	 * Gets the planet's infiltrations.
	 * @return array(Infiltration) the infiltrations
	 */
	public function getInfiltrations(){
		return $this->infiltrations;
	}
	
	/**
	 * Sets the planet's infiltrations.
	 * @param array(Infiltration) $infiltrations the infiltrations
	 */
	public function setInfiltrations($infiltrations){
		$this->infiltrations = $infiltrations;
	}
}