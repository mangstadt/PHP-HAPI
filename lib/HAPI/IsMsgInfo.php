<?php
namespace HAPI;

/**
 * IsMsgInfo class (used for the "ismsginfo" HAPI method).
 * @package HAPI
 * @author Mike Angstadt [github.com/mangstadt]
 */
class IsMsgInfo{
	/**
	 * True if there are unread player/planet messages, false if not.
	 * @var boolean
	 */
	private $messages;
	
	/**
	 * True if there are unread non-personal planet messages, false if not.
	 * @var boolean
	 */
	private $planetMessages;
	
	/**
	 * True if there are unread battle reports, false if not.
	 * @var boolean
	 */
	private $battleReports;
	
	/**
	 * True if there are unread fleet messages, false if not.
	 * @var boolean
	 */
	private $military;
	
	/**
	 * True if there are unread trading messages, false if not.
	 * @var boolean
	 */
	private $trading;
	
	/**
	 * True if there are unread infiltration messages, false if not.
	 * @var boolean
	 */
	private $infiltration;
	
	/**
	 * True if there are unread planet control messages, false if not.
	 * @var boolean
	 */
	private $planetControl;
	
	/**
	 * Gets whether there are any unread player/planet messages.
	 * @return boolean true if there are, false if not
	 */
	public function hasMessages(){
		return $this->messages;
	}

	/**
	 * Sets whether there are any unread player/planet messages.
	 * @param boolean $messages true if there are, false if not
	 */
	public function setMessages($messages){
		$this->messages = $messages;
	}

	/**
	 * Gets whether there are any unread non-personal planet messages.
	 * @return boolean true if there are, false if not
	 */
	public function hasPlanetMessages(){
		return $this->planetMessages;
	}
	
	/**
	 * Sets whether there are any unread non-personal planet messages.
	 * @param boolean $planetMessages true if there are, false if not
	 */
	public function setPlanetMessages($planetMessages){
		$this->planetMessages = $planetMessages;
	}

	/**
	 * Gets whether there are any unread battle reports.
	 * @return boolean true if there are, false if not
	 */
	public function hasBattleReports(){
		return $this->battleReports;
	}

	/**
	 * Sets whether there are any unread battle reports.
	 * @param boolean $battleReports true if there are, false if not
	 */
	public function setBattleReports($battleReports){
		$this->battleReports = $battleReports;
	}

	/**
	 * Gets whether there are any unread fleet messages.
	 * @return boolean true if there are, false if not
	 */
	public function hasMilitary(){
		return $this->military;
	}

	/**
	 * Sets whether there are any unread fleet messages.
	 * @param boolean $military true if there are, false if not
	 */
	public function setMilitary($military){
		$this->military = $military;
	}

	/**
	 * Gets whether there are any unread trading messages.
	 * @return boolean true if there are, false if not
	 */
	public function hasTrading(){
		return $this->trading;
	}

	/**
	 * Sets whether there are any unread trading messages.
	 * @param boolean $trading true if there are, false if not
	 */
	public function setTrading($trading){
		$this->trading = $trading;
	}

	/**
	 * Gets whether there are any unread infiltration messages.
	 * @return boolean true if there are, false if not
	 */
	public function hasInfiltration(){
		return $this->infiltration;
	}

	/**
	 * Sets whether there are any unread infiltration messages.
	 * @param boolean $infiltration true if there are, false if not
	 */
	public function setInfiltration($infiltration){
		$this->infiltration = $infiltration;
	}

	/**
	 * Gets whether there are any unread planet control messages.
	 * @return boolean true if there are, false if not
	 */
	public function hasPlanetControl(){
		return $this->planetControl;
	}

	/**
	 * Sets whether there are any unread planet control messages.
	 * @param boolean $planetControl true if there are, false if not
	 */
	public function setPlanetControl($planetControl){
		$this->planetControl = $planetControl;
	}
}