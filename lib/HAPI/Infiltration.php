<?php
namespace HAPI;

/**
 * Represents an infiltration (used for the "getplanetinfo" HAPI method).
 * @package HAPI
 * @author Mike Angstadt [github.com/mangstadt]
 */
class Infiltration{
	/**
	 * The infiltration ID.
	 * @var integer
	 */
	private $id;
	
	/**
	 * The name of the infiltrated planet.
	 * @var string
	 */
	private $planetName;
	
	/**
	 * The public alliance tag of the infiltrated planet or null if it has no tag.
	 * @var string
	 */
	private $planetTag;
	
	/**
	 * The infiltrated planet's x-coordinate.
	 * @var integer
	 */
	private $planetX;
	
	/**
	 * The infiltrated planet's y-coordinate.
	 * @var integer
	 */
	private $planetY;
	
	/**
	 * The infiltration level (0 to 100).
	 * @var integer
	 */
	private $level;
	
	/**
	 * The security level of the infiltration (0 to 100).
	 * @var integer
	 */
	private $security;
	
	/**
	 * Whether the infiltration level is growing or not.
	 * @var boolean
	 */
	private $growing;
	
	/**
	 * Whether the infiltrated planet is captive or not.
	 * @var true
	 */
	private $captive;
	
	/**
	 * Gets the infiltration ID.
	 * @return integer the infiltration ID
	 */
	public function getId(){
		return $this->id;
	}

	/**
	 * Sets the infiltration ID.
	 * @param integer $id the infiltration ID
	 */
	public function setId($id){
		$this->id = $id;
	}

	/**
	 * Gets the infiltrated planet's name.
	 * @return string the planet name
	 */
	public function getPlanetName(){
		return $this->planetName;
	}

	/**
	 * Sets the infiltrated planet's name.
	 * @param string $planetName the planet name
	 */
	public function setPlanetName($planetName){
		$this->planetName = $planetName;
	}

	/**
	 * Gets the infiltrated planet's public alliance tag.
	 * @return string the alliance tag or null if it has no public tag
	 */
	public function getPlanetTag(){
		return $this->planetTag;
	}

	/**
	 * Sets the infiltrated planet's public alliance tag.
	 * @param string $planetTag the alliance tag or null if it has no public tag
	 */
	public function setPlanetTag($planetTag){
		$this->planetTag = $planetTag;
	}

	/**
	 * Gets the infiltrated planet's x-coordinate.
	 * @return integer the planet's x-coordinate
	 */
	public function getPlanetX(){
		return $this->planetX;
	}

	/**
	 * Sets the infiltrated planet's x-coordinate.
	 * @param integer $planetX the planet's x-coordinate
	 */
	public function setPlanetX($planetX){
		$this->planetX = $planetX;
	}

	/**
	 * Gets the infiltrated planet's y-coordinate.
	 * @return integer the planet's y-coordinate
	 */
	public function getPlanetY(){
		return $this->planetY;
	}

	/**
	 * Sets the infiltrated planet's y-coordinate.
	 * @param integer $planetX the planet's y-coordinate
	 */
	public function setPlanetY($planetY){
		$this->planetY = $planetY;
	}

	/**
	 * Gets the infiltration level.
	 * @return integer the infiltration level (0 to 100)
	 */
	public function getLevel(){
		return $this->level;
	}

	/**
	 * Sets the infiltration level.
	 * @param integer $level the infiltration level (0 to 100)
	 */
	public function setLevel($level){
		$this->level = $level;
	}

	/**
	 * Gets the infiltration's security level.
	 * @return integer the security level (0 to 100)
	 */
	public function getSecurity(){
		return $this->security;
	}

	/**
	 * Sets the infiltration's security level.
	 * @param integer $security the security level (0 to 100)
	 */
	public function setSecurity($security){
		$this->security = $security;
	}

	/**
	 * Gets whether the infiltration level is growing or not.
	 * @return boolean true if the level is growing, false if not
	 */
	public function isGrowing(){
		return $this->growing;
	}

	/**
	 * Sets whether the infiltration level is growing or not.
	 * @param boolean $growing true if the level is growing, false if not
	 */
	public function setGrowing($growing){
		$this->growing = $growing;
	}

	/**
	 * Gets whether the infiltrated planet is captive or not.
	 * @return boolean true if the planet is captive, false if not
	 */
	public function isCaptive(){
		return $this->captive;
	}

	/**
	 * Sets whether the infiltrated planet is captive or not.
	 * @param boolean $captive true if the planet is captive, false if not
	 */
	public function setCaptive($captive){
		$this->captive = $captive;
	}
}