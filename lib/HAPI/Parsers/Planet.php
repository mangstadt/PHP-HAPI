<?php
namespace HAPI\Parsers;

/**
 * Represents a planet from the data file.
 * @author Mike Angstadt [github.com/mangstadt]
 * @package HAPI/Parsers
 */
class Planet{
	private $id;
	private $name;
	
	/**
	 * The planet's government system (see HAPI::GOV_*)
	 * @var integer
	 */
	private $govSystem;
	
	private $x;
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
	
	private $activity;
	private $publicTag;
	private $civLevel;
	private $size;
	
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getName(){
		return $this->name;
	}

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

	public function getX(){
		return $this->x;
	}

	public function setX($x){
		$this->x = $x;
	}

	public function getY(){
		return $this->y;
	}

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

	public function getActivity(){
		return $this->activity;
	}

	public function setActivity($activity){
		$this->activity = $activity;
	}

	public function getPublicTag(){
		return $this->publicTag;
	}

	public function setPublicTag($publicTag){
		$this->publicTag = $publicTag;
	}

	public function getCivLevel(){
		return $this->civLevel;
	}

	public function setCivLevel($civLevel){
		$this->civLevel = $civLevel;
	}

	public function getSize(){
		return $this->size;
	}

	public function setSize($size){
		$this->size = $size;
	}
}