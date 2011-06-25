<?php
namespace HAPI\Parsers;

/**
 * Parses the player data file.
 * @author Mike Angstadt [github.com/mangstadt]
 * @package HAPI/Parsers
 */
class PlayerParser extends Parser{
	/**
	 * Constructs a new player data file parser object.
	 * @param string $file the *absolute* path to the player data file
	 * @throws Exception if the file doesn't exist or is empty
	 */
	public function __construct($file){
		parent::__construct($file);
	}
	
	/**
	 * Gets the next event entry from the file.
	 * @return Player the player entry or null if there are no more
	 */
	//override
	public function next(){
		$player = null;
		
		$line = $this->nextLine();
		if ($line != null){
			preg_match("/(.*?) (.*?) (.*?) (.*?) (.*?) (.*?) (.*?) (.*?) (.*?) (.*)/", $line, $matches);
			$player = new Player();
			$i = 1;
			
			$player->setName($matches[$i++]);
			$player->setInfluenceRank($matches[$i++]);
			$player->setInfluenceRankSC($matches[$i++]);
			$player->setInfluenceScore($matches[$i++]);
			$player->setHypRank($matches[$i++]);
			
			$idr = $matches[$i++];
			if ($idr == "0"){
				//it's private
				$idr = null;
			}
			$player->setIDRRank($idr);
			
			$idr = $matches[$i++];
			if ($idr == "0"){
				//it's private
				$idr = null;
			}
			$player->setIDRScore($idr);
			
			$idr = $matches[$i++];
			if ($idr == "0"){
				//it's private
				$idr = null;
			}
			$player->setIDRRankSC($idr);
			
			$sc = $matches[$i++];
			if ($sc == "0"){
				//player is not in a SC
				$sc = null;
			}
			$player->setSC($sc);
			
			$player->setLocation($matches[$i++]);
		}
		
		return $player;
	}
}