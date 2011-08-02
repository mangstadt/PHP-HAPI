<?php
namespace HAPI;

/**
 * Represents a planet that has fleets orbiting it (used for the "getfleetsinfo" HAPI method).
 * @package HAPI
 * @author Mike Angstadt [github.com/mangstadt]
 */
class FleetsInfo{
	/**
	 * True if the planet is foreign, false if the player controls it.
	 * @var boolean
	 */
	private $foreign;
	
	/**
	 * The name of the planet.
	 * @var string
	 */
	private $planetName;
	
	/**
	 * Whether the planet is in stasis or not.
	 * @var boolean
	 */
	private $stasis;
	
	/**
	 * Whether the planet owner is on vacation or not.
	 * @var boolean
	 */
	private $vacation;
	
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
	 * The fleets orbiting the planet.
	 * @var array(Fleet)
	 */
	private $fleets = array();
	
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
	 * Gets the planet's name.
	 * @return string the planet's name
	 */
	public function getPlanetName(){
		return $this->planetName;
	}

	/**
	 * Sets the planet's name.
	 * @param string $planetName the planet's name
	 * @param unknown_type $planetName
	 */
	public function setPlanetName($planetName){
		$this->planetName = $planetName;
	}

	/**
	 * Gets whether the planet is in stasis or not.
	 * @return boolean true if the planet is in stasis, false if not
	 */
	public function isStasis(){
		return $this->stasis;
	}

	/**
	 * Sets whether the planet is in stasis or not.
	 * @param boolean $stasis true if the planet is in stasis, false if not
	 */
	public function setStasis($stasis){
		$this->stasis = $stasis;
	}

	/**
	 * Gets whether the planet owner is on vacation or not.
	 * @return boolean true if the planet owner is on vacation, false if not
	 */
	public function isVacation(){
		return $this->vacation;
	}

	/**
	 * Sets whether the planet owner is on vacation or not.
	 * @param boolean $vacation true if the planet owner is on vacation, false if not
	 */
	public function setVacation($vacation){
		$this->vacation = $vacation;
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
	 * Gets the fleets that are orbiting the planet.
	 * @return array(Fleet) the orbiting fleets
	 */
	public function getFleets(){
		return $this->fleets;
	}

	/**
	 * Sets the fleets that are orbiting the planet.
	 * @param array(Fleet) $fleets the orbiting fleets
	 */
	public function setFleets($fleets){
		$this->fleets = $fleets;
	}
}