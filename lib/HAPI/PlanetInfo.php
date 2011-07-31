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
	
	private $name;
	private $x;
	private $y;
	private $size;
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
	
	private $tax;
	private $exploits;
	private $exploitsInPipe;
	private $activity;
	private $population;
	
	/**
	 * The planet's race (see HAPI::RACE_*).
	 * @var integer
	 */
	private $race;
	
	private $energy;
	private $energyMax;
	private $purifying;
	private $paranoid;
	private $blockaded;
	private $blackHole;
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
	
	private $ecomark;
	private $id;
	private $publicTag;
	private $factories;
	private $civLevel;
	private $defBonus;
	private $hypergate;
	private $neutral;
	private $battle;
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
	
	public function getName(){
		return $this->name;
	}
	
	public function setName($name){
		$this->name = $name;
	}
	
	public function getX(){
		return $this->x;
	}

	public function setX($x){
		$this->x = $x;
	}

	public function getY(){
		return $this->y;
	}

	public function setY($y){
		$this->y = $y;
	}

	public function getSize(){
		return $this->size;
	}

	public function setSize($size){
		$this->size = $size;
	}

	public function getOrbit(){
		return $this->orbit;
	}

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

	public function getTax(){
		return $this->tax;
	}

	public function setTax($tax){
		$this->tax = $tax;
	}

	public function getExploits(){
		return $this->exploits;
	}

	public function setExploits($exploits){
		$this->exploits = $exploits;
	}

	public function getExploitsInPipe(){
		return $this->exploitsInPipe;
	}

	public function setExploitsInPipe($exploitsInPipe){
		$this->exploitsInPipe = $exploitsInPipe;
	}

	public function getActivity(){
		return $this->activity;
	}

	public function setActivity($activity){
		$this->activity = $activity;
	}

	public function getPopulation(){
		return $this->population;
	}

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

	public function getEnergy(){
		return $this->energy;
	}

	public function setEnergy($energy){
		$this->energy = $energy;
	}

	public function getEnergyMax(){
		return $this->energyMax;
	}

	public function setEnergyMax($energyMax){
		$this->energyMax = $energyMax;
	}

	public function isPurifying(){
		return $this->purifying;
	}

	public function setPurifying($purifying){
		$this->purifying = $purifying;
	}

	public function isParanoid(){
		return $this->paranoid;
	}

	public function setParanoid($paranoid){
		$this->paranoid = $paranoid;
	}

	public function isBlockaded(){
		return $this->blockaded;
	}

	public function setBlockaded($blockaded){
		$this->blockaded = $blockaded;
	}

	public function isBlackHole(){
		return $this->blackHole;
	}

	public function setBlackHole($blackHole){
		$this->blackHole = $blackHole;
	}

	public function isStasis(){
		return $this->stasis;
	}

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

	public function getEcomark(){
		return $this->ecomark;
	}

	public function setEcomark($ecomark){
		$this->ecomark = $ecomark;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function setId($id){
		$this->id = $id;
	}

	public function getPublicTag(){
		return $this->publicTag;
	}

	public function setPublicTag($publicTag){
		$this->publicTag = $publicTag;
	}

	public function getFactories(){
		return $this->factories;
	}

	public function setFactories($factories){
		$this->factories = $factories;
	}

	public function getCivLevel(){
		return $this->civLevel;
	}

	public function setCivLevel($civLevel){
		$this->civLevel = $civLevel;
	}

	public function getDefBonus(){
		return $this->defBonus;
	}

	public function setDefBonus($defBonus){
		$this->defBonus = $defBonus;
	}
	
	public function isHypergate(){
		return $this->hypergate;
	}
	
	public function setHypergate($hypergate){
		$this->hypergate = $hypergate;
	}
	
	public function isNeutral(){
		return $this->neutral;
	}
	
	public function setNeutral($neutral){
		$this->neutral = $neutral;
	}
	
	public function isBattle(){
		return $this->battle;
	}

	public function setBattle($battle){
		$this->battle = $battle;
	}

	public function isVacation(){
		return $this->vacation;
	}

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