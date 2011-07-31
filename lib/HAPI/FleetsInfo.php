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
	
	private $planetName;
	private $stasis;
	private $vacation;
	private $energy;
	private $energyMax;
	
	/**
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

	public function getPlanetName(){
		return $this->planetName;
	}

	public function setPlanetName($planetName){
		$this->planetName = $planetName;
	}

	public function isStasis(){
		return $this->stasis;
	}

	public function setStasis($stasis){
		$this->stasis = $stasis;
	}

	public function isVacation(){
		return $this->vacation;
	}

	public function setVacation($vacation){
		$this->vacation = $vacation;
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

	public function getFleets(){
		return $this->fleets;
	}

	public function setFleets($fleets){
		$this->fleets = $fleets;
	}
}