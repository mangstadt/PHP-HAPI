<?php
namespace HAPI\Parsers;

/**
 * Represents a player from the data file.
 * @author Mike Angstadt [github.com/mangstadt]
 * @package HAPI/Parsers
 */
class Player{
	const RANK_ENSIGN = 0;
	const RANK_LIEUTENANT = 1;
	const RANK_LIEUTENANT_COMMANDER = 2;
	const RANK_COMMANDER = 3;
	const RANK_CAPTAIN = 4;
	const RANK_FLEET_CAPTAIN = 5;
	const RANK_COMMODORE = 6;
	const RANK_REAR_ADMIRAL = 7;
	const RANK_VICE_ADMIRAL = 8;
	const RANK_ADMIRAL = 9;
	const RANK_FLEET_ADMIRAL = 10;
	
	/**
	 * The player's name.
	 * @var string
	 */
	private $name;
	
	/**
	 * The player's influence rank
	 * @var integer
	 */
	private $influenceRank;
	
	/**
	 * The player's super cluster influence rank.
	 * @var integer
	 */
	private $influenceRankSC;
	
	/**
	 * The player's influence score.
	 * @var integer
	 */
	private $influenceScore;
	
	/**
	 * The player's rank (see Player::RANK_*).
	 * @var integer
	 */
	private $hypRank;
	
	/**
	 * The player's inflicted damage rank or null if the player made it private.
	 * @var integer
	 */
	private $idrRank;
	
	/**
	 * The player's inflicted damage score or null if the player made it private.
	 * @var integer
	 */
	private $idrScore;
	
	/**
	 * The player's super cluster inflicted damage rank or null if the player made it private.
	 * @var integer
	 */
	private $idrRankSC;
	
	/**
	 * The protected super cluster the player is playing in or null if the player is not in a protected super cluster.
	 * @var unknown_type
	 */
	private $sc;
	
	/**
	 * Where the player lives in real life.
	 * @var integer
	 */
	private $location;
	
	/**
	 * Gets the player's name.
	 * @return string the player's name
	 */
	public function getName(){
		return $this->name;
	}

	/**
	 * Sets the player's name.
	 * @param string $name the player's name
	 */
	public function setName($name){
		$this->name = $name;
	}

	/**
	 * Gets the player's influence rank.
	 * @return integer the player's influence rank
	 */
	public function getInfluenceRank(){
		return $this->influenceRank;
	}

	/**
	 * Sets the player's influence rank.
	 * @param integer $influenceRank the player's influence rank
	 */
	public function setInfluenceRank($influenceRank){
		$this->influenceRank = $influenceRank;
	}
	
	/**
	 * Gets the player's super cluster influence rank.
	 * @return integer the player's super cluster influence rank
	 */
	public function getInfluenceRankSC(){
		return $this->influenceRankSC;
	}

	/**
	 * Sets the player's super cluster influence rank.
	 * @param integer $influenceRankSC the player's super cluster influence rank
	 */
	public function setInfluenceRankSC($influenceRankSC){
		$this->influenceRankSC = $influenceRankSC;
	}

	/**
	 * Gets the player's influence score.
	 * @return integer the player's influence score
	 */
	public function getInfluenceScore(){
		return $this->influenceScore;
	}

	/**
	 * Sets the player's influence score.
	 * @param integer $influenceScore the player's influence score
	 */
	public function setInfluenceScore($influenceScore){
		$this->influenceScore = $influenceScore;
	}

	/**
	 * Gets the player's rank (see Player::RANK_*).
	 * @return integer the player's rank
	 */
	public function getHypRank(){
		return $this->hypRank;
	}

	/**
	 * Sets the player's rank (see Player::RANK_*).
	 * @param integer $hypRank the player's rank
	 */
	public function setHypRank($hypRank){
		$this->hypRank = $hypRank;
	}

	/**
	 * Gets the player's inflicted damage rank.
	 * @return integer the player's inflicted damage rank or null if the player made it private
	 */
	public function getIDRRank(){
		return $this->idrRank;
	}

	/**
	 * Sets the player's inflicted damage rank.
	 * @param integer $idrRank the player's inflicted damage rank or null if the player made it private
	 */
	public function setIDRRank($idrRank){
		$this->idrRank = $idrRank;
	}

	/**
	 * Gets the player's inflicted damage score.
	 * @return integer the player's inflicted damage score or null if the player made it private
	 */
	public function getIDRScore(){
		return $this->idrScore;
	}

	/**
	 * Sets the player's inflicted damage score.
	 * @param integer $idrScore the player's inflicted damage score or null if the player made it private
	 */
	public function setIDRScore($idrScore){
		$this->idrScore = $idrScore;
	}

	/**
	 * Gets the player's super cluster inflicted damage rank.
	 * @return integer the player's super cluster inflicted damage rank or null if the player made it private
	 */
	public function getIDRRankSC(){
		return $this->idrRankSC;
	}

	/**
	 * Sets the player's super cluster inflicted damage rank.
	 * @param integer $idrRankSC the player's super cluster inflicted damage rank or null if the player made it private
	 */
	public function setIDRRankSC($idrRankSC){
		$this->idrRankSC = $idrRankSC;
	}

	/**
	 * Gets the protected super cluster the player is playing in.
	 * @return integer the protected super cluster or null if the player is not playing in one
	 */
	public function getSC(){
		return $this->sc;
	}

	/**
	 * Sets the protected super cluster the player is playing in.
	 * @param integer $sc the protected super cluster or null if the player is not playing in one
	 */
	public function setSC($sc){
		$this->sc = $sc;
	}

	/**
	 * Gets where the player lives in real life.
	 * @return string the player's location
	 */
	public function getLocation(){
		return $this->location;
	}

	/**
	 * Sets where the player lives in real life.
	 * @param string $location the player's location
	 */
	public function setLocation($location){
		$this->location = $location;
	}
}