<?php
namespace HAPI;

/**
 * Represents a trading relation (used for the "getplanetinfo" HAPI method).
 * @package HAPI
 * @author Mike Angstadt [github.com/mangstadt]
 */
class Trade{
	const TRANS_TYPE_NORMAL = 0;
	const TRANS_TYPE_HYPERGATE = 1;
	const TRANS_TYPE_TELEPORT = 2;
	
	/**
	 * The trade ID.
	 * @var integer
	 */
	private $id;
	
	/**
	 * The name of the trading planet.
	 * @var string
	 */
	private $planetName;
	
	/**
	 * The public alliance tag of the trading planet.
	 * @var string
	 */
	private $planetTag;
	
	/**
	 * The distance to the trading planet.
	 * @var integer
	 */
	private $planetDistance;
	
	/**
	 * The x-coordinate of the trading planet.
	 * @var integer
	 */
	private $planetX;
	
	/**
	 * The y-coordinate of the trading planet.
	 * @var integer
	 */
	private $planetY;
	
	/**
	 * The race of the trading planet (see HAPI::RACE_* constants).
	 * @var integer
	 */
	private $planetRace;
	
	/**
	 * The activity of the trading planet.
	 * @var integer
	 */
	private $planetActivity;
	
	/**
	 * The income earned from each exploitation in the trading relation.
	 * @var integer
	 */
	private $income;
	
	/**
	 * The number of exploitations in the trade.
	 * @var integer
	 */
	private $capacity;
	
	/**
	 * The transport type (see Trade::TRANS_TYPE_* constants).
	 * @var integer
	 */
	private $transportType;

	/**
	 * @var boolean
	 */
	private $pending;
	
	/**
	 * @var boolean
	 */
	private $accepted;
	
	/**
	 * @var boolean
	 */
	private $requestor;
	
	/**
	 * The upkeep cost for each exploitation in the trading relation.
	 * @var integer
	 */
	private $upkeep;
	
	/**
	 * The production type (see HAPI::PROD_TYPE_*).
	 * @var integer
	 */
	private $prodType;
	
	/**
	 * True if the trading relation is blockaded, false if not.
	 * @var boolean
	 */
	private $blockaded;
	
	/**
	 * Gets the trade ID.
	 * @return integer the trade ID
	 */
	public function getId(){
		return $this->id;
	}

	/**
	 * Sets the trade ID.
	 * @param integer $id the trade ID
	 */
	public function setId($id){
		$this->id = $id;
	}

	/**
	 * Gets the trading planet's name.
	 * @return string the trading planet's name
	 */
	public function getPlanetName(){
		return $this->planetName;
	}

	/**
	 * Sets the trading planet's name.
	 * @param string $planetName the trading planet's name
	 */
	public function setPlanetName($planetName){
		$this->planetName = $planetName;
	}

	/**
	 * Gets the public alliance tag of the trading planet.
	 * @return string the alliance tag or null if the planet doesn't have one
	 */
	public function getPlanetTag(){
		return $this->planetTag;
	}

	/**
	 * Sets the public alliance tag of the trading planet.
	 * @param string $planetTag the alliance tag or null if the planet doesn't have one
	 */
	public function setPlanetTag($planetTag){
		$this->planetTag = $planetTag;
	}

	/**
	 * Gets the distance to the trading planet.
	 * @return integer the distance
	 */
	public function getPlanetDistance(){
		return $this->planetDistance;
	}

	/**
	 * Sets the distance to the trading planet.
	 * @param integer $planetDistance the distance
	 */
	public function setPlanetDistance($planetDistance){
		$this->planetDistance = $planetDistance;
	}

	/**
	 * Gets the x-coordinate of the trading planet.
	 * @return integer the x-coordinate
	 */
	public function getPlanetX(){
		return $this->planetX;
	}

	/**
	 * Sets the x-coordinate of the trading planet.
	 * @param integer $planetX the x-coordinate
	 */
	public function setPlanetX($planetX){
		$this->planetX = $planetX;
	}

	/**
	 * Gets the y-coordinate of the trading planet.
	 * @return integer the y-coordinate
	 */
	public function getPlanetY(){
		return $this->planetY;
	}

	/**
	 * Sets the y-coordinate of the trading planet.
	 * @param integer $planetY the y-coordinate
	 */
	public function setPlanetY($planetY){
		$this->planetY = $planetY;
	}

	/**
	 * Gets the race of the trading planet.
	 * @return integer the race (see HAPI::RACE_* constants)
	 */
	public function getPlanetRace(){
		return $this->planetRace;
	}

	/**
	 * Sets the race of the trading planet.
	 * @param integer $planetRace the race (see HAPI::RACE_* constants)
	 */
	public function setPlanetRace($planetRace){
		$this->planetRace = $planetRace;
	}

	/**
	 * Gets the activity of the trading planet.
	 * @return integer the activity
	 */
	public function getPlanetActivity(){
		return $this->planetActivity;
	}

	/**
	 * Sets the activity of the trading planet.
	 * @param integer $planetActivity the activity
	 */
	public function setPlanetActivity($planetActivity){
		$this->planetActivity = $planetActivity;
	}

	/**
	 * Gets the income earned from each exploitation in the trading relation.
	 * @return integer the income earned from each exploitation
	 */
	public function getIncome(){
		return $this->income;
	}

	/**
	 * Sets the income earned from each exploitation in the trading relation.
	 * @param integer $income the income earned from each exploitation
	 */
	public function setIncome($income){
		$this->income = $income;
	}

	/**
	 * Gets the number of exploitations in the trading relation.
	 * @return integer the number of exploitations
	 */
	public function getCapacity(){
		return $this->capacity;
	}

	/**
	 * Sets the number of exploitations in the trading relation.
	 * @param integer $capacity the number of exploitations
	 */
	public function setCapacity($capacity){
		$this->capacity = $capacity;
	}

	/**
	 * Gets the transport type (see Trade::TRANS_TYPE_* constants).
	 * @return integer the transport type
	 */
	public function getTransportType(){
		return $this->transportType;
	}

	/**
	 * Sets the transport type (see Trade::TRANS_TYPE_* constants).
	 * @param integer $transportType the transport type
	 */
	public function setTransportType($transportType){
		$this->transportType = $transportType;
	}

	/**
	 * @return boolean
	 */
	public function isPending(){
		return $this->pending;
	}

	/**
	 * @param boolean $pending
	 */
	public function setPending($pending){
		$this->pending = $pending;
	}

	/**
	 * @return boolean
	 */
	public function isAccepted(){
		return $this->accepted;
	}

	/**
	 * @param boolean $accepted
	 */
	public function setAccepted($accepted){
		$this->accepted = $accepted;
	}

	/**
	 * @return boolean
	 */
	public function isRequestor(){
		return $this->requestor;
	}

	/**
	 * @param boolean $requestor
	 */
	public function setRequestor($requestor){
		$this->requestor = $requestor;
	}

	/**
	 * Gets the upkeep cost of each exploitation in the trading relation.
	 * @return integer the upkeep cost
	 */
	public function getUpkeep(){
		return $this->upkeep;
	}

	/**
	 * Sets the upkeep cost of each exploitation in the trading relation.
	 * @param integer $upkeep the upkeep cost
	 */
	public function setUpkeep($upkeep){
		$this->upkeep = $upkeep;
	}

	/**
	 * Gets the production type.
	 * @return integer the production type (see HAPI::PROD_TYPE_*)
	 */
	public function getProdType(){
		return $this->prodType;
	}

	/**
	 * Sets the production type.
	 * @param integer $prodType the production type (see HAPI::PROD_TYPE_*)
	 */
	public function setProdType($prodType){
		$this->prodType = $prodType;
	}

	/**
	 * Gets whether the trade is being blockaded.
	 * @return boolean true if it is blockaded, false if not
	 */
	public function isBlockaded(){
		return $this->blockaded;
	}

	/**
	 * Sets whether the trade is being blockaded.
	 * @param boolean $blockaded true if it is blockaded, false if not
	 */
	public function setBlockaded($blockaded){
		$this->blockaded = $blockaded;
	}
}