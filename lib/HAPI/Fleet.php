<?php
namespace HAPI;

/**
 * Represents a fleet (used for the "getfleetsinfo" HAPI method).
 * @package HAPI
 * @author Mike Angstadt [github.com/mangstadt]
 */
class Fleet{
	/**
	 * The fleet ID.
	 * @var integer
	 */
	private $id;
	
	/**
	 * The fleet name or null if the fleet has no name.
	 * @var string
	 */
	private $name;
	
	/**
	 * The sell price of the fleet or 0 if the fleet is not for sale.
	 * @var integer
	 */
	private $sellPrice;
	
	/**
	 * The fleet's race (see HAPI::RACE_*).
	 * @var integer
	 */
	private $race;
	
	/**
	 * The fleet's owner.
	 * @var string
	 */
	private $owner;
	
	/**
	 * True if the fleet is defending, false if it is attacking.
	 * @var boolean
	 */
	private $defending;
	
	/**
	 * Whether the fleet is camouflaged or not
	 * @var boolean
	 */
	private $camouflaged;
	
	/**
	 * Whether the fleet is bombing or not.
	 * @var boolean
	 */
	private $bombing;
	
	/**
	 * Whether the fleet is set to auto drop its carried armies or not.
	 * @var boolean
	 */
	private $autoDropping;
	
	/**
	 * The number of hours before the fleet can leave the planet.
	 * @var integer
	 */
	private $delay;
	
	/**
	 * The number of ground armies in the fleet.
	 * @var integer
	 */
	private $groundArmies;
	
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
	private $carriedArmies;
	
	/**
	 * Gets the fleet's ID.
	 * @return integer the fleet's ID
	 */
	public function getId(){
		return $this->id;
	}

	/**
	 * Sets the fleet's ID.
	 * @param integer $fleetId the fleet's ID
	 */
	public function setId($id){
		$this->id = $id;
	}

	/**
	 * Gets the fleet's name.
	 * @return string the fleet's name or null if it has no name
	 */
	public function getName(){
		return $this->name;
	}

	/**
	 * Sets the fleet's name.
	 * @param string $name the fleet's name or null if it has no name
	 */
	public function setName($name){
		$this->name = $name;
	}

	/**
	 * Gets the fleet's sell price.
	 * @return integer the fleet's sell price or 0 if it is not for sale.
	 */
	public function getSellPrice(){
		return $this->sellPrice;
	}

	/**
	 * Sets the fleet's sell price.
	 * @param integer $sellPrice the fleet's sell price or 0 if it is not for sale.
	 */
	public function setSellPrice($sellPrice){
		$this->sellPrice = $sellPrice;
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
	 * Gets the fleet's owner.
	 * @return string the fleet's owner
	 */
	public function getOwner(){
		return $this->owner;
	}

	/**
	 * Sets the fleet's owner.
	 * @param string $owner the fleet's owner
	 */
	public function setOwner($owner){
		$this->owner = $owner;
	}

	/**
	 * Gets whether the fleet is defending or attacking the planet.
	 * @return boolean true if it is defending, false if it is attacking
	 */
	public function isDefending(){
		return $this->defending;
	}

	/**
	 * Sets whether the fleet is defending or attacking the planet.
	 * @param boolean $defending true if it is defending, false if it is attacking
	 */
	public function setDefending($defending){
		$this->defending = $defending;
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
	 * Gets whether the fleet is bombing the planet or not.
	 * @return boolean true if it is bombing the planet, false if not
	 */
	public function isBombing(){
		return $this->bombing;
	}

	/**
	 * Sets whether the fleet is bombing the planet or not.
	 * @param boolean $bombing true if it is bombing the planet, false if not
	 */
	public function setBombing($bombing){
		$this->bombing = $bombing;
	}

	/**
	 * Gets whether the fleet is set to autodrop its carried armies or not.
	 * @return boolean true if it is set to autodrop its carried armies, false if not
	 */
	public function isAutoDropping(){
		return $this->autoDropping;
	}

	/**
	 * Sets whether the fleet is set to autodrop its carried armies or not.
	 * @param boolean $autoDropping true if it is set to autodrop its carried armies, false if not
	 */
	public function setAutoDropping($autoDropping){
		$this->autoDropping = $autoDropping;
	}

	/**
	 * Gets the number of hours before the fleet can leave the planet.
	 * @return integer the number of hours before it can leave the planet
	 */
	public function getDelay(){
		return $this->delay;
	}

	/**
	 * Sets the number of hours before the fleet can leave the planet.
	 * @param integer $delay the number of hours before it can leave the planet
	 */
	public function setDelay($delay){
		$this->delay = $delay;
	}

	/**
	 * Gets the number of ground armies in the fleet.
	 * @return integer the number of ground armies
	 */
	public function getGroundArmies(){
		return $this->groundArmies;
	}

	/**
	 * Sets the number of ground armies in the fleet.
	 * @param integer $groundArmies the number of ground armies
	 */
	public function setGroundArmies($groundArmies){
		$this->groundArmies = $groundArmies;
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
	public function getCarriedArmies(){
		return $this->carriedArmies;
	}

	/**
	 * Sets the number of carried armies in the fleet.
	 * @param integer $carriedArmies the number of carried armies
	 */
	public function setCarriedArmies($carriedArmies){
		$this->carriedArmies = $carriedArmies;
	}
}