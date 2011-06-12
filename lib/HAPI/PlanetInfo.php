<?php
namespace HAPI;

/**
 * Contains various information on a planet (used for the "getplanetinfo" HAPI method).
 * @author Mike Angstadt [github.com/mangstadt]
 */
class PlanetInfo{
	const NEXUS_TYPE_NONE = 0;
	const NEXUS_TYPE_ADMIN = 1;
	const NEXUS_TYPE_SATEL = 2;
	
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
	 * The planet's production type (see HAPI::PROD_TYPE_*).
	 * @var integer
	 */
	private $prodType;
	
	private $tax;
	private $numExploits;
	private $numExploitsInPipe;
	private $activity;
	private $population;
	
	/**
	 * The planet's race (see HAPI::RACE_*).
	 * @var integer
	 */
	private $race;
	
	private $nrj;
	private $nrjMax;
	private $purifying;
	private $paranoidMode;
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
	private $numFactories;
	private $civLevel;
	private $defBonus;
	
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

	public function getNumExploits(){
		return $this->numExploits;
	}

	public function setNumExploits($numExploits){
		$this->numExploits = $numExploits;
	}

	public function getNumExploitsInPipe(){
		return $this->numExploitsInPipe;
	}

	public function setNumExploitsInPipe($numExploitsInPipe){
		$this->numExploitsInPipe = $numExploitsInPipe;
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

	public function getNrj(){
		return $this->njr;
	}

	public function setNrj($nrj){
		$this->nrj = $nrj;
	}

	public function getNrjMax(){
		return $this->nrjMax;
	}

	public function setNrjMax($nrjMax){
		$this->nrjMax = $nrjMax;
	}

	public function isPurifying(){
		return $this->purifying;
	}

	public function setPurifying($purifying){
		$this->purifying = $purifying;
	}

	public function isParanoidMode(){
		return $this->paranoidMode;
	}

	public function setParanoidMode($paranoidMode){
		$this->paranoidMode = $paranoidMode;
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

	public function getNumFactories(){
		return $this->numFactories;
	}

	public function setNumFactories($numFactories){
		$this->numFactories = $numFactories;
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