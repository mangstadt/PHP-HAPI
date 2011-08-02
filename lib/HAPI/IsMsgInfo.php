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
	private $msg;
	
	/**
	 * True if there are unread non-personal planet messages, false if not.
	 * @var boolean
	 */
	private $planet;
	
	/**
	 * True if there are unread battle reports, false if not.
	 * @var boolean
	 */
	private $report;
	
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
	private $control;
	
	/**
	 * Gets whether there are any unread player/planet messages.
	 * @return boolean true if there are, false if not
	 */
	public function isMsg(){
		return $this->msg;
	}

	/**
	 * Sets whether there are any unread player/planet messages.
	 * @param boolean $msg true if there are, false if not
	 */
	public function setMsg($msg){
		$this->msg = $msg;
	}

	/**
	 * Gets whether there are any unread non-personal planet messages.
	 * @return boolean true if there are, false if not
	 */
	public function isPlanet(){
		return $this->planet;
	}
	
	/**
	 * Sets whether there are any unread non-personal planet messages.
	 * @param boolean $planet true if there are, false if not
	 */
	public function setPlanet($planet){
		$this->planet = $planet;
	}

	/**
	 * Gets whether there are any unread battle reports.
	 * @return boolean true if there are, false if not
	 */
	public function isReport(){
		return $this->report;
	}

	/**
	 * Sets whether there are any unread battle reports.
	 * @param boolean $report true if there are, false if not
	 */
	public function setReport($report){
		$this->report = $report;
	}

	/**
	 * Gets whether there are any unread fleet messages.
	 * @return boolean true if there are, false if not
	 */
	public function isMilitary(){
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
	public function isTrading(){
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
	public function isInfiltration(){
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
	public function isControl(){
		return $this->control;
	}

	/**
	 * Sets whether there are any unread planet control messages.
	 * @param boolean $infiltration true if there are, false if not
	 */
	public function setControl($control){
		$this->control = $control;
	}
}