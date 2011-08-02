<?php
namespace HAPI;

/**
 * Represents a Hyperiums game (used for the "games" HAPI method).
 * @package HAPI
 * @author github.com/mangstadt
 */
class Game{
	const STATE_NOT_RUNNING_CLOSED = -1;
	const STATE_RUNNING_CLOSED = 0;
	const STATE_RUNNING_OPEN = 1;
	const STATE_NOT_RUNNING_OPEN_REGISTRATION = 2;

	/**
	 * The game name.
	 * @var string
	 */
	private $name;
	
	/**
	 * The game state (see Game::STATE_* constants).
	 * @var integer
	 */
	private $state;
	
	/**
	 * The game description.
	 * @var string
	 */
	private $description;
	
	/**
	 * The game length.
	 * @var integer
	 * @deprecated use $maxEndDate instead
	 */
	private $length;
	
	/**
	 * The date the game will end or null if it has no end date (timestamp).
	 * @var integer
	 */
	private $maxEndDate;
	private $peec;
	
	/**
	 * The max number of planets each player can have.
	 * @var integer
	 */
	private $maxPlanets;
	
	/**
	 * The amount of cash each player starts with.
	 * @var integer
	 */
	private $initCash;
	
	/**
	 * The max number of planets each player can have, including the free ones that they get.
	 * @var unknown_type
	 */
	private $maxOfferedPlanets;
	
	/**
	 * The number of days before the player gets his first free planet.
	 * @var integer
	 */
	private $nextPlanetDelay;
	
	/**
	 * Gets the game name.
	 * @return string the game name
	 */
	public function getName(){
		return $this->name;
	}

	/**
	 * Sets the game name.
	 * @param string $name the game name
	 */
	public function setName($name){
		$this->name = $name;
	}

	/**
	 * Gets the game state.
	 * @return integer the game state (see Game::STATE_* constants)
	 */
	public function getState(){
		return $this->state;
	}

	/**
	 * Sets the game state.
	 * @param integer $state the game state (see Game::STATE_* constants)
	 */
	public function setState($state){
		$this->state = $state;
	}

	/**
	 * Gets the game description.
	 * @return string the game description
	 */
	public function getDescription(){
		return $this->description;
	}

	/**
	 * Sets the game description.
	 * @param string $description the game description
	 */
	public function setDescription($description){
		$this->description = $description;
	}

	/**
	 * Gets the game length.
	 * @deprecated use getMaxEndDate() instead
	 * @return integer the game length
	 */
	public function getLength(){
		return $this->length;
	}

	/**
	 * Sets the game length.
	 * @deprecated use setMaxEndDate() instead
	 * @param integer $length the game length
	 */
	public function setLength($length){
		$this->length = $length;
	}

	/**
	 * Gets the date the game will end.
	 * @return integer the date the game will end (timestamp) or null if it has no end date
	 */
	public function getMaxEndDate(){
		return $this->maxEndDate;
	}

	/**
	 * Sets the date the game will end.
	 * @param integer $maxEndDate the date the game will end (timestamp) or null if it has no end date
	 */
	public function setMaxEndDate($maxEndDate){
		$this->maxEndDate = $maxEndDate;
	}

	public function isPeec(){
		return $this->peec;
	}

	public function setPeec($peec){
		$this->peec = $peec;
	}

	/**
	 * Gets the max number of planets each player can have.
	 * @return integer the max number of planets
	 */
	public function getMaxPlanets(){
		return $this->maxPlanets;
	}

	/**
	 * Sets the max number of planets each player can have.
	 * @param integer $maxPlanets the max number of planets
	 */
	public function setMaxPlanets($maxPlanets){
		$this->maxPlanets = $maxPlanets;
	}

	/**
	 * Gets the amount of cash each player starts with.
	 * @return integer the starting cash
	 */
	public function getInitCash(){
		return $this->initCash;
	}

	/**
	 * Sets the amount of cash each player starts with.
	 * @param integer $initCash the starting cash
	 */
	public function setInitCash($initCash){
		$this->initCash = $initCash;
	}

	/**
	 * Gets the max number of planets each player can have, including the free ones they get.
	 * @return integer the max number of planets
	 */
	public function getMaxOfferedPlanets(){
		return $this->maxOfferedPlanets;
	}

	/**
	 * Sets the max number of planets each player can have, including the free ones they get.
	 * @param integer $maxOfferedPlanets the max number of planets
	 */
	public function setMaxOfferedPlanets($maxOfferedPlanets){
		$this->maxOfferedPlanets = $maxOfferedPlanets;
	}

	/**
	 * Gets the number of days before the player gets his first free planet.
	 * @return integer the number of days before the player gets his first free planet
	 */
	public function getNextPlanetDelay(){
		return $this->nextPlanetDelay;
	}

	/**
	 * Sets the number of days before the player gets his first free planet.
	 * @param integer $nextPlanetDelay the number of days before the player gets his first free planet
	 */
	public function setNextPlanetDelay($nextPlanetDelay){
		$this->nextPlanetDelay = $nextPlanetDelay;
	}
}