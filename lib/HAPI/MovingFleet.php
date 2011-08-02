<?php
namespace HAPI;

/**
 * Represents a moving fleet (used for the "getmovingfleets" HAPI method).
 * @package HAPI
 * @author Mike Angstadt [github.com/mangstadt]
 */
class MovingFleet{
	/**
	 * The fleet ID.
	 * @var integer
	 */
	private $id;
	
	/**
	 * The fleet name or null if it has no name.
	 * @var string
	 */
	private $name;
	
	/**
	 * The planet the fleet is coming from.
	 * @var string
	 */
	private $from;
	
	/**
	 * The planet the fleet is traveling to.
	 * @var string
	 */
	private $to;
	
	/**
	 * The distance the fleet has left to travel.
	 * @var integer
	 */
	private $distance;
	
	private $delay;
	
	/**
	 * True if the fleet will defend the planet on arrival, false if it will attack it.
	 * @var boolean
	 */
	private $defending;
	
	/**
	 * True if the fleet is set to auto drop its carried armies on arrival, false if not.
	 * @var boolean
	 */
	private $autoDropping;
	
	/**
	 * True if the fleet is camouflaged, false if not.
	 * @var boolean
	 */
	private $camouflaged;
	
	/**
	 * True if the fleet is set to bomb the planet on arrival, false if not.
	 * @var boolean
	 */
	private $bombing;
	
	/**
	 * The fleet's race (see HAPI::RACE_*).
	 * @var integer
	 */
	private $race;
	
	/**
	 * The number of scouts in the fleet.
	 * @var integer
	 */
	private $scouts;
	
	/**
	 * The number of cruisers in the fleet.
	 * @var integer
	 */
	private $cruisers;
	
	/**
	 * The number of bombers in the fleet.
	 * @var integer
	 */
	private $bombers;
	
	/**
	 * The number of destroyers in the fleet.
	 * @var integer
	 */
	private $destroyers;
	
	/**
	 * The number of carried armies in the fleet.
	 * @var integer
	 */
	private $armies;
	
	/**
	 * Gets the fleet ID.
	 * @return integer the fleet ID
	 */
	public function getId(){
		return $this->id;
	}

	/**
	 * Sets the fleet ID.
	 * @param integer $id the fleet ID
	 */
	public function setId($id){
		$this->id = $id;
	}

	/**
	 * Gets the fleet name.
	 * @return string the fleet name or null if it has no name
	 */
	public function getName(){
		return $this->name;
	}

	/**
	 * Sets the fleet name.
	 * @param string $name the fleet name or null if it has no name
	 */
	public function setName($name){
		$this->name = $name;
	}

	/**
	 * Gets the planet the fleet is coming from.
	 * @return string the planet name
	 */
	public function getFrom(){
		return $this->from;
	}

	/**
	 * Sets the planet the fleet is coming from.
	 * @param string $from the planet name
	 */
	public function setFrom($from){
		$this->from = $from;
	}

	/**
	 * Gets the planet the fleet is traveling to.
	 * @return string the planet name
	 */
	public function getTo(){
		return $this->to;
	}

	/**
	 * Sets the planet the fleet is traveling to.
	 * @param string $to the planet name
	 */
	public function setTo($to){
		$this->to = $to;
	}

	/**
	 * Gets the distance the fleet has left to travel.
	 * @return integer the remaining distance
	 */
	public function getDistance(){
		return $this->distance;
	}

	/**
	 * Sets the distance the fleet has left to travel.
	 * @param integer $distance the remaining distance
	 */
	public function setDistance($distance){
		$this->distance = $distance;
	}

	public function getDelay(){
		return $this->delay;
	}

	public function setDelay($delay){
		$this->delay = $delay;
	}

	/**
	 * Gets whether the fleet is ordered to defend or attack the planet on arrival.
	 * @return boolean true if it will defend, false if it will attack
	 */
	public function isDefending(){
		return $this->defending;
	}

	/**
	 * Sets whether the fleet is ordered to defend or attack the planet on arrival.
	 * @param boolean $defending true if it will defend, false if it will attack
	 */
	public function setDefending($defending){
		$this->defending = $defending;
	}

	/**
	 * Gets whether the fleet is ordered to auto drop its carried armies on arrival.
	 * @return boolean true if it will auto drop, false if not
	 */
	public function isAutoDropping(){
		return $this->autoDropping;
	}

	/**
	 * Sets whether the fleet is ordered to auto drop its carried armies on arrival.
	 * @param boolean $autoDropping true if it will auto drop, false if not
	 */
	public function setAutoDropping($autoDropping){
		$this->autoDropping = $autoDropping;
	}

	/**
	 * Gets whether the fleet is camouflaged or not.
	 * @return boolean true if it is camouflaged, false if not
	 */
	public function isCamouflaged(){
		return $this->camouflaged;
	}

	/**
	 * Sets whether the fleet is camouflaged or not.
	 * @param boolean $camouflaged true if it is camouflaged, false if not
	 */
	public function setCamouflaged($camouflaged){
		$this->camouflaged = $camouflaged;
	}

	/**
	 * Gets whether the fleet is ordered to bomb the planet on arrival.
	 * @return boolean true if it will bomb the planet, false if not
	 */
	public function isBombing(){
		return $this->bombing;
	}

	/**
	 * Sets whether the fleet is ordered to bomb the planet on arrival.
	 * @param boolean $bombing true if it will bomb the planet, false if not
	 */
	public function setBombing($bombing){
		$this->bombing = $bombing;
	}

	/**
	 * Gets the fleet's race.
	 * @return integer the fleet's race (see HAPI::RACE_*)
	 */
	public function getRace(){
		return $this->race;
	}

	/**
	 * Sets the fleet's race.
	 * @param integer $race the fleet's race (see HAPI::RACE_*)
	 */
	public function setRace($race){
		$this->race = $race;
	}

	/**
	 * Gets the number of scouts in the fleet.
	 * @return integer the number of scouts
	 */
	public function getScouts(){
		return $this->scouts;
	}

	/**
	 * Sets the number of scouts in the fleet.
	 * @param integer $scouts the number of scouts
	 */
	public function setScouts($scouts){
		$this->scouts = $scouts;
	}

	/**
	 * Gets the number of cruisers in the fleet.
	 * @return integer the number of cruisers
	 */
	public function getCruisers(){
		return $this->cruisers;
	}

	/**
	 * Sets the number of cruisers in the fleet.
	 * @param integer $cruisers the number of cruisers
	 */
	public function setCruisers($cruisers){
		$this->cruisers = $cruisers;
	}

	/**
	 * Gets the number of bombers in the fleet.
	 * @return integer the number of bombers
	 */
	public function getBombers(){
		return $this->bombers;
	}

	/**
	 * Sets the number of bombers in the fleet.
	 * @param integer $bombers the number of bombers
	 */
	public function setBombers($bombers){
		$this->bombers = $bombers;
	}

	/**
	 * Gets the number of destroyers in the fleet.
	 * @return integer the number of destroyers
	 */
	public function getDestroyers(){
		return $this->destroyers;
	}

	/**
	 * Sets the number of destroyers in the fleet.
	 * @param integer $destroyers the number of destroyers
	 */
	public function setDestroyers($destroyers){
		$this->destroyers = $destroyers;
	}

	/**
	 * Gets the number of carried armies in the fleet.
	 * @return integer the number of carried armies
	 */
	public function getArmies(){
		return $this->armies;
	}

	/**
	 * Sets the number of carried armies in the fleet.
	 * @param integer $armies the number of carried armies
	 */
	public function setArmies($armies){
		$this->armies = $armies;
	}
}