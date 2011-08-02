<?php
namespace HAPI\Parsers;

/**
 * Represents an event from the data file.
 * @author Mike Angstadt [github.com/mangstadt]
 * @package HAPI/Parsers
 */
class Event{
	/**
	 * The ID of the planet that the event happened on.
	 * @var integer
	 */
	private $planetId;
	
	/**
	 * The planet the event happened on.
	 * @var string
	 */
	private $planetName;
	
	/**
	 * The date of the event (timestamp)
	 * @var integer
	 */
	private $date;
	
	/**
	 * The event description.
	 * @var string
	 */
	private $description;
	
	/**
	 * Gets the ID of the planet that the event happened on.
	 * @return integer the planet ID
	 */
	public function getPlanetId(){
		return $this->planetId;
	}

	/**
	 * Sets the ID of the planet that the event happened on.
	 * @param integer $planetId the planet ID
	 */
	public function setPlanetId($planetId){
		$this->planetId = $planetId;
	}

	/**
	 * Gets the planet that the event happened on.
	 * @return string the planet name
	 */
	public function getPlanetName(){
		return $this->planetName;
	}

	/**
	 * Sets the planet that the event happened on.
	 * @param string $planetName the planet name
	 */
	public function setPlanetName($planetName){
		$this->planetName = $planetName;
	}

	/**
	 * Gets the event date.
	 * @return integer the event date (timestamp)
	 */
	public function getDate(){
		return $this->date;
	}

	/**
	 * Sets the event date.
	 * @param integer $date the event date (timestamp)
	 */
	public function setDate($date){
		$this->date = $date;
	}

	/**
	 * Gets the event description.
	 * @return string the event description
	 */
	public function getDescription(){
		return $this->description;
	}

	/**
	 * Sets the event description.
	 * @param string $description the event description
	 */
	public function setDescription($description){
		$this->description = $description;
	}
}