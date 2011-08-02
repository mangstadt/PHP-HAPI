<?php
namespace HAPI\Parsers;

/**
 * Represents an alliance from the data file.
 * @author Mike Angstadt [github.com/mangstadt]
 * @package HAPI/Parsers
 */
class Alliance{
	/**
	 * The alliance tag.
	 * @var string
	 */
	private $tag;
	
	/**
	 * The alliance name.
	 * @var string
	 */
	private $name;
	
	/**
	 * The alliance description.
	 * @var string
	 */
	private $description;
	
	/**
	 * The player name of the alliance president.
	 * @var string
	 */
	private $president;
	
	/**
	 * The average x-coordinate of all planets that are in the alliance.
	 * @var integer
	 */
	private $avgCoordX;
	
	/**
	 * The average y-coordinate of all planets that are in the alliance.
	 * @var integer
	 */
	private $avgCoordY;
	
	/**
	 * The number of planets in the alliance.
	 * @var integer
	 */
	private $numPlanets;
	
	/**
	 * The alliance's total influence.
	 * @var integer
	 */
	private $totalInfluence;
	
	/**
	 * Gets the alliance tag.
	 * @return string the alliance tag
	 */
	public function getTag(){
		return $this->tag;
	}

	/**
	 * Sets the alliance tag.
	 * @param string $tag the alliance tag
	 */
	public function setTag($tag){
		$this->tag = $tag;
	}

	/**
	 * Gets the alliance name.
	 * @return string the alliance name
	 */
	public function getName(){
		return $this->name;
	}

	/**
	 * Sets the alliance name.
	 * @param string $name the alliance name
	 */
	public function setName($name){
		$this->name = $name;
	}

	/**
	 * Gets the alliance description.
	 * @return string the alliance description
	 */
	public function getDescription(){
		return $this->description;
	}

	/**
	 * Sets the alliance description.
	 * @param string $description the alliance description
	 */
	public function setDescription($description){
		$this->description = $description;
	}

	/**
	 * Gets the alliance president.
	 * @return string the alliance president
	 */
	public function getPresident(){
		return $this->president;
	}

	/**
	 * Sets the alliance president.
	 * @param string $president the alliance president
	 */
	public function setPresident($president){
		$this->president = $president;
	}

	/**
	 * Gets the average x-coordinate of all the planets in the alliance.
	 * @return integer the average x-coordinate
	 */
	public function getAvgCoordX(){
		return $this->avgCoordX;
	}

	/**
	 * Sets the average x-coordinate of all the planets in the alliance.
	 * @param integer $avgCoordX the average x-coordinate
	 */
	public function setAvgCoordX($avgCoordX){
		$this->avgCoordX = $avgCoordX;
	}

	/**
	 * Gets the average y-coordinate of all the planets in the alliance.
	 * @return integer the average y-coordinate
	 */
	public function getAvgCoordY(){
		return $this->avgCoordY;
	}

	/**
	 * Sets the average y-coordinate of all the planets in the alliance.
	 * @param integer $avgCoordY the average y-coordinate
	 */
	public function setAvgCoordY($avgCoordY){
		$this->avgCoordY = $avgCoordY;
	}

	/**
	 * Gets the number of planets in the alliance.
	 * @return integer the number of planets in the alliance
	 */
	public function getNumPlanets(){
		return $this->numPlanets;
	}

	/**
	 * Sets the number of planets in the alliance.
	 * @param integer $numPlanets the number of planets in the alliance
	 */
	public function setNumPlanets($numPlanets){
		$this->numPlanets = $numPlanets;
	}

	/**
	 * Gets the total influence score of the alliance.
	 * @return integer the total influence
	 */
	public function getTotalInfluence(){
		return $this->totalInfluence;
	}

	/**
	 * Sets the total influence score of the alliance.
	 * @param integer $totalInfluence the total influence
	 */
	public function setTotalInfluence($totalInfluence){
		$this->totalInfluence = $totalInfluence;
	}
}