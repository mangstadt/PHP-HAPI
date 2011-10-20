<?php
namespace HAPI\Parsers;

/**
 * Parses the planet data file.
 * @author Mike Angstadt [github.com/mangstadt]
 * @package HAPI/Parsers
 */
class PlanetParser extends Parser{
	/**
	 * True if the data file is from the RLF2 game, false if not.
	 * @var boolean
	 */
	private $rlf2;
	
	/**
	 * Constructs a new planet data file parser object.
	 * @param string $file the *absolute* path to the planet data file
	 * @param boolean $rlf2 true if the planet data file is from the RLF2 game, false if not (defaults to false).
	 * The data file from the RLF2 game is slightly different.
	 * @throws ParserException if the file doesn't exist or is empty
	 */
	public function __construct($file, $rlf2 = false){
		parent::__construct($file);
		$this->rlf2 = $rlf2;
	}
	
	/**
	 * Gets the next planet entry from the file.
	 * @return Planet the planet entry or null if there are no more
	 */
	//override
	public function next(){
		$planet = null;
		
		$line = $this->nextLine();
		if ($line != null){
			$matches = preg_split("/ /", $line);
			$planet = new Planet();
			$i = 0;
			
			$planet->setId($matches[$i++]);
			$planet->setName($matches[$i++]);
			$planet->setGovSystem($matches[$i++]);
			$planet->setX($matches[$i++]);
			$planet->setY($matches[$i++]);
			$planet->setRace($matches[$i++]);
			$planet->setProdType($matches[$i++]);
			if ($this->rlf2){
				$planet->setPopulation($matches[$i++]);
			} else {
				$planet->setActivity($matches[$i++]);
			}
			$tag = $matches[$i++];
			$tag = trim($tag, "[]");
			$planet->setPublicTag($tag);
			if (!$this->rlf2){
				$planet->setCivLevel($matches[$i++]);
			}
			$planet->setSize($matches[$i++]);
		}
		
		return $planet;
	}
}