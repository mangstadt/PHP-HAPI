<?php
namespace HAPI\Parsers;

/**
 * Parses the event data file.
 * @author Mike Angstadt [github.com/mangstadt]
 * @package HAPI/Parsers
 */
class EventParser extends Parser{
	/**
	 * Constructs a new event data file parser object.
	 * @param string $file the *absolute* path to the event data file
	 * @throws Exception if the file doesn't exist or is empty
	 */
	public function __construct($file){
		parent::__construct($file);
	}
	
	/**
	 * Gets the next event entry from the file.
	 * @return Event the event entry or null if there are no more
	 */
	//override
	public function next(){
		$event = null;
		
		$line = $this->nextLine();
		if ($line != null){
			preg_match("/^(.*?) (.*?) (\\d{4}-\\d{2}-\\d{2} \\d{2}:\\d{2}:\\d{2}) (.*)\$/", $line, $matches);
			$event = new Event();
			$i = 1;
			$event->setPlanetId($matches[$i++]);
			$event->setPlanetName($matches[$i++]);
			$event->setDate(strtotime($matches[$i++]));
			$event->setDescription($matches[$i++]);
		}
		
		return $event;
	}
}