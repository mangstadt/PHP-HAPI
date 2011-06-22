<?php
namespace HAPI\Parsers;

/**
 * Represents an event from the data file.
 * @author Mike Angstadt [github.com/mangstadt]
 * @package HAPI/Parsers
 */
class Event{
	private $planetId;
	private $planetName;
	private $date;
	private $description;
	
	public function getPlanetId(){
		return $this->planetId;
	}

	public function setPlanetId($planetId){
		$this->planetId = $planetId;
	}

	public function getPlanetName(){
		return $this->planetName;
	}

	public function setPlanetName($planetName){
		$this->planetName = $planetName;
	}

	public function getDate(){
		return $this->date;
	}

	public function setDate($date){
		$this->date = $date;
	}

	public function getDescription(){
		return $this->description;
	}

	public function setDescription($description){
		$this->description = $description;
	}
}