<?php
namespace HAPI\Parsers;

/**
 * Represents an alliance from the data file.
 * @author Mike Angstadt [github.com/mangstadt]
 * @package HAPI/Parsers
 */
class Alliance{
	private $tag;
	private $name;
	private $description;
	private $president;
	private $avgCoordX;
	private $avgCoordY;
	private $numPlanets;
	private $totalInfluence;
	
	public function getTag(){
		return $this->tag;
	}

	public function setTag($tag){
		$this->tag = $tag;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getDescription(){
		return $this->description;
	}

	public function setDescription($description){
		$this->description = $description;
	}

	public function getPresident(){
		return $this->president;
	}

	public function setPresident($president){
		$this->president = $president;
	}

	public function getAvgCoordX(){
		return $this->avgCoordX;
	}

	public function setAvgCoordX($avgCoordX){
		$this->avgCoordX = $avgCoordX;
	}

	public function getAvgCoordY(){
		return $this->avgCoordY;
	}

	public function setAvgCoordY($avgCoordY){
		$this->avgCoordY = $avgCoordY;
	}

	public function getNumPlanets(){
		return $this->numPlanets;
	}

	public function setNumPlanets($numPlanets){
		$this->numPlanets = $numPlanets;
	}

	public function getTotalInfluence(){
		return $this->totalInfluence;
	}

	public function setTotalInfluence($totalInfluence){
		$this->totalInfluence = $totalInfluence;
	}
}