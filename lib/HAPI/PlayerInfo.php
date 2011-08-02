<?php
namespace HAPI;

/**
 * Contains information on a player (used for the "getplayerinfo" HAPI method).
 * @package HAPI
 * @author Mike Angstadt [github.com/mangstadt]
 */
class PlayerInfo{
	/**
	 * The player's name.
	 * @var string
	 */
	private $name;
	
	/**
	 * The player's rank (see HAPI::RANK_* constants).
	 * @var integer
	 */
	private $hypRank;
	
	/**
	 * The player's influence ranking.
	 * @var integer
	 */
	private $rankinf;
	
	/**
	 * The player's influence score.
	 * @var integer
	 */
	private $scoreinf;
	
	/**
	 * The amount of cash the player has.&nbsp;
	 * Only included if info on the currently authenticated player is requested.
	 * @var integer
	 */
	private $cash;
	
	/**
	 * The player's financial ranking.&nbsp;
	 * Only included if info on the currently authenticated player is requested.
	 * @var integer
	 */
	private $rankfin;
	
	/**
	 * The player's financial score.&nbsp;
	 * Only included if info on the currently authenticated player is requested.
	 * @var integer
	 */
	private $scorefin;
	
	/**
	 * The player's military ranking.&nbsp;
	 * Only included if info on the currently authenticated player is requested.
	 * @var integer
	 */
	private $rankpow;
	
	/**
	 * The player's military score.&nbsp;
	 * Only included if info on the currently authenticated player is requested.
	 * @var integer
	 */
	private $scorepow;
	
	/**
	 * The number of planets the player has.&nbsp;
	 * Only included if info on the currently authenticated player is requested.
	 * @var integer
	 */
	private $planets;
	
	/**
	 * The amount of cash earned by the player last cast tick.&nbsp;
	 * Only included if info on the currently authenticated player is requested.
	 * @var integer
	 */
	private $lastIncome;
	
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
	 * Gets the player's rank.
	 * @return integer the player's rank (see HAPI::RANK_* constants)
	 */
	public function getHypRank(){
		return $this->hypRank;
	}

	/**
	 * Sets the player's rank.
	 * @param integer $hypRank the player's rank (see HAPI::RANK_* constants)
	 */
	public function setHypRank($hypRank){
		$this->hypRank = $hypRank;
	}

	/**
	 * Gets the player's influence ranking.
	 * @return integer the player's influence ranking
	 */
	public function getRankinf(){
		return $this->rankinf;
	}

	/**
	 * Sets the player's influence ranking.
	 * @param integer $rankinf the player's influence ranking
	 */
	public function setRankinf($rankinf){
		$this->rankinf = $rankinf;
	}

	/**
	 * Gets the player's influence score.
	 * @return integer the player's influence score.
	 */
	public function getScoreinf(){
		return $this->scoreinf;
	}

	/**
	 * Sets the player's influence score.
	 * @param integer $scoreinf the player's influence score.
	 */
	public function setScoreinf($scoreinf){
		$this->scoreinf = $scoreinf;
	}

	/**
	 * Gets the amount of cash the player has.
	 * @return integer the player's available cash or null if the player is not the currently authenticated player
	 */
	public function getCash(){
		return $this->cash;
	}

	/**
	 * Sets the amount of cash the player has.
	 * @param integer $cash the player's available cash or null if the player is not the currently authenticated player
	 */
	public function setCash($cash){
		$this->cash = $cash;
	}

	/**
	 * Gets the player's financial ranking.
	 * @return integer the player's financial ranking or null if the player is not the currently authenticated player
	 */
	public function getRankfin(){
		return $this->rankfin;
	}

	/**
	 * Sets the player's financial ranking.
	 * @param integer $rankfin the player's financial ranking or null if the player is not the currently authenticated player
	 */
	public function setRankfin($rankfin){
		$this->rankfin = $rankfin;
	}

	/**
	 * Gets the player's financial score.
	 * @return integer the player's financial score or null if the player is not the currently authenticated player
	 */
	public function getScorefin(){
		return $this->scorefin;
	}

	/**
	 * Sets the player's financial score.
	 * @param integer $scorefin the player's financial score or null if the player is not the currently authenticated player
	 */
	public function setScorefin($scorefin){
		$this->scorefin = $scorefin;
	}

	/**
	 * Gets the player's military ranking.
	 * @return integer the player's military ranking or null if the player is not the currently authenticated player
	 */
	public function getRankpow(){
		return $this->rankpow;
	}

	/**
	 * Sets the player's military ranking.
	 * @param integer $rankpow the player's military ranking or null if the player is not the currently authenticated player
	 */
	public function setRankpow($rankpow){
		$this->rankpow = $rankpow;
	}

	/**
	 * Gets the player's military score.
	 * @return integer the player's military score or null if the player is not the currently authenticated player
	 */
	public function getScorepow(){
		return $this->scorepow;
	}

	/**
	 * Sets the player's military score.
	 * @param integer $scorepow the player's military score or null if the player is not the currently authenticated player
	 */
	public function setScorepow($scorepow){
		$this->scorepow = $scorepow;
	}

	/**
	 * Gets the number of planets the player has.
	 * @return integer the number of planets or null if the player is not the currently authenticated player
	 */
	public function getPlanets(){
		return $this->planets;
	}

	/**
	 * Sets the number of planets the player has.
	 * @param integer $planets the number of planets or null if the player is not the currently authenticated player
	 */
	public function setPlanets($planets){
		$this->planets = $planets;
	}

	/**
	 * Gets the amount of cash the player earned last cash tick.
	 * @return integer the amount of cash (does not include lord withholdings from the Feudal system)
	 */
	public function getLastIncome(){
		return $this->lastIncome;
	}

	/**
	 * Sets the amount of cash the player earned last cash tick.
	 * @param integer $lastIncome the amount of cash or null if the player is not the currently authenticated player (does not include lord withholdings from the Feudal system)
	 */
	public function setLastIncome($lastIncome){
		$this->lastIncome = $lastIncome;
	}
}