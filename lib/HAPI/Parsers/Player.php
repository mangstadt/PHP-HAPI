<?php
namespace HAPI\Parsers;

/**
 * Represents a player from the data file.
 * @author Mike Angstadt [github.com/mangstadt]
 * @package HAPI/Parsers
 */
class Player{
	private $name;
	private $influenceRank;
	private $influenceRankSC;
	private $influenceScore;
	
	/**
	 * The player's rank (see HAPI::RANK_*).
	 * @var integer
	 */
	private $hypRank;
	private $idrRank;
	private $idrScore;
	private $idrRankSC;
	private $sc;
	private $location;
	
	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getInfluenceRank(){
		return $this->influenceRank;
	}

	public function setInfluenceRank($influenceRank){
		$this->influenceRank = $influenceRank;
	}
	
	public function getInfluenceRankSC(){
		return $this->influenceRankSC;
	}

	public function setInfluenceRankSC($influenceRankSC){
		$this->influenceRankSC = $influenceRankSC;
	}

	public function getInfluenceScore(){
		return $this->influenceScore;
	}

	public function setInfluenceScore($influenceScore){
		$this->influenceScore = $influenceScore;
	}

	/**
	 * Gets the player's rank (see HAPI::RANK_*).
	 * @return integer the player's rank
	 */
	public function getHypRank(){
		return $this->hypRank;
	}

	/**
	 * Sets the player's rank (see HAPI::RANK_*).
	 * @param integer $hypRank the player's rank
	 */
	public function setHypRank($hypRank){
		$this->hypRank = $hypRank;
	}

	public function getIDRRank(){
		return $this->idrRank;
	}

	public function setIDRRank($idrRank){
		$this->idrRank = $idrRank;
	}

	public function getIDRScore(){
		return $this->idrScore;
	}

	public function setIDRScore($idrScore){
		$this->idrScore = $idrScore;
	}

	public function getIDRRankSC(){
		return $this->idrRankSC;
	}

	public function setIDRRankSC($idrRankSC){
		$this->idrRankSC = $idrRankSC;
	}

	public function getSC(){
		return $this->sc;
	}

	public function setSC($sc){
		$this->sc = $sc;
	}

	public function getLocation(){
		return $this->location;
	}

	public function setLocation($location){
		$this->location = $location;
	}
}