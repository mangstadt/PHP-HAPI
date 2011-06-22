<?php
namespace HAPI\Parsers;

/**
 * Parses the planet data file.
 * @author Mike Angstadt [github.com/mangstadt]
 * @package HAPI/Parsers
 */
class PlanetParser extends Parser{
	/**
	 * Constructs a new planet data file parser object.
	 * @param string $file the *absolute* path to the planet data file
	 * @throws Exception if the file doesn't exist or is empty
	 */
	public function __construct($file){
		parent::__construct($file);
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
			$planet->setActivity($matches[$i++]);
			$tag = $matches[$i++];
			$tag = trim($tag, "[]");
			$planet->setPublicTag($tag);
			$planet->setCivLevel($matches[$i++]);
			$planet->setSize($matches[$i++]);
		}
		
		return $planet;
	}
}