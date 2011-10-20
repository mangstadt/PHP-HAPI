<?php
namespace HAPI\Parsers;

/**
 * Parses the alliance data file.
 * @author Mike Angstadt [github.com/mangstadt]
 * @package HAPI/Parsers
 */
class AllianceParser extends Parser{
	/**
	 * Constructs a new alliance data file parser object.
	 * @param string $file the *absolute* path to the alliance data file
	 * @throws ParserException if the file doesn't exist or is empty
	 */
	public function __construct($file){
		parent::__construct($file);
	}
	
	/**
	 * Gets the next alliance entry from the file.
	 * @return Alliance the alliance entry or null if there are no more
	 */
	//override
	public function next(){
		$alliance = null;
		
		$lines = array();
		for ($i = 0; $i < 3 && $this->hasNext(); $i++){
			$lines[] = $this->nextLine();
		}
		
		if (count($lines) == 3){
			$alliance = new Alliance();
			
			//line 1
			preg_match("/(.*?) (.*)/", $lines[0], $matches);
			$alliance->setTag($matches[1]);
			$alliance->setName($matches[2]);
			
			//line 2
			$alliance->setDescription(html_entity_decode($lines[1]));
			
			//line 3
			$i = 0;
			$split = preg_split("/ /", $lines[2]);
			$alliance->setPresident($split[$i++]);
			$alliance->setAvgCoordX($split[$i++]);
			$alliance->setAvgCoordY($split[$i++]);
			$alliance->setNumPlanets($split[$i++]);
			$alliance->setTotalInfluence($split[$i++]);
		}
		
		return $alliance;
	}
}