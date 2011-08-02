<?php
namespace HAPI\Parsers;

/**
 * Represents a planet from the data file.
 * @author Mike Angstadt [github.com/mangstadt]
 * @package HAPI/Parsers
 */
class Planet{
	/**
	 * The planet ID.
	 * @var integer
	 */
	private $id;
	
	/**
	 * The planet name.
	 * @var string
	 */
	private $name;
	
	/**
	 * The planet's government system (see HAPI::GOV_*)
	 * @var integer
	 */
	private $govSystem;
	
	/**
	 * The planet's x-coordinate.
	 * @var integer
	 */
	private $x;
	
	/**
	 * The planet's y-coordinate.
	 * @var integer
	 */
	private $y;
	
	/**
	 * The planet's race (see HAPI::RACE_*).
	 * @var integer
	 */
	private $race;
	
	/**
	 * The planet's production type (see HAPI::PROD_TYPE_*).
	 * @var integer
	 */
	private $prodType;
	
	/**
	 * The planet's activity.
	 * @var integer
	 */
	private $activity;
	
	/**
	 * The planet's public tag or null if it has no public tag.
	 * @var string
	 */
	private $publicTag;
	
	/**
	 * The planet's civilization level.
	 * @var integer
	 */
	private $civLevel;
	
	/**
	 * The planet's size.
	 * @var integer
	 */
	private $size;
	
	/**
	 * Gets the planet ID.
	 * @return integer the planet ID
	 */
	public function getId(){
		return $this->id;
	}

	/**
	 * Sets the planet ID.
	 * @param integer $id the planet ID
	 */
	public function setId($id){
		$this->id = $id;
	}

	/**
	 * Gets the planet name.
	 * @return string the planet name
	 */
	public function getName(){
		return $this->name;
	}

	/**
	 * Sets the planet name.
	 * @param string $name the planet name
	 */
	public function setName($name){
		$this->name = $name;
	}
	
	/**
	 * Gets the planet's government system.
	 * @return integer the planet's government system (see HAPI::GOV_*)
	 */
	public function getGovSystem(){
		return $this->govSystem;
	}

	/**
	 * Sets the planet's government system.
	 * @param integer $govSystem the planet's government system (see HAPI::GOV_*)
	 */
	public function setGovSystem($govSystem){
		$this->govSystem = $govSystem;
	}

	/**
	 * Gets the planet's x-coordinate.
	 * @return integer the planet's x-coordinate
	 */
	public function getX(){
		return $this->x;
	}

	/**
	 * Sets the planet's x-coordinate.
	 * @param integer $x the planet's x-coordinate
	 */
	public function setX($x){
		$this->x = $x;
	}

	/**
	 * Gets the planet's y-coordinate.
	 * @return integer the planet's y-coordinate
	 */
	public function getY(){
		return $this->y;
	}

	/**
	 * Sets the planet's y-coordinate.
	 * @param integer $y the planet's y-coordinate
	 */
	public function setY($y){
		$this->y = $y;
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

	/**
	 * Gets the planet's activity.
	 * @return integer the planet's activity.
	 */
	public function getActivity(){
		return $this->activity;
	}

	/**
	 * Sets the planet's activity.
	 * @param integer $activty the planet's activity.
	 */
	public function setActivity($activity){
		$this->activity = $activity;
	}

	/**
	 * Gets the planet's public alliance tag.
	 * @return string the public tag or null if it doesn't have one
	 */
	public function getPublicTag(){
		return $this->publicTag;
	}

	/**
	 * Sets the planet's public alliance tag.
	 * @param string $publicTag the public tag or null if it doesn't have one
	 */
	public function setPublicTag($publicTag){
		$this->publicTag = $publicTag;
	}

	/**
	 * Gets the planet's civilization level.
	 * @return integer the planet's civ level
	 */
	public function getCivLevel(){
		return $this->civLevel;
	}

	/**
	 * Sets the planet's civilization level.
	 * @param integer $civLevel the planet's civ level
	 */
	public function setCivLevel($civLevel){
		$this->civLevel = $civLevel;
	}

	/**
	 * Gets the planet's size.
	 * @return integer the planet's size
	 */
	public function getSize(){
		return $this->size;
	}

	/**
	 * Sets the planet's size.
	 * @param integer $size the planet's size
	 */
	public function setSize($size){
		$this->size = $size;
	}
}