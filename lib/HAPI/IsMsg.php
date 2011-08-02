<?php
namespace HAPI;

/**
 * IsMsg class (used for the "ismsg" HAPI method).
 * @package HAPI
 * @author Mike Angstadt [github.com/mangstadt]
 */
class IsMsg{
	/**
	 * True if there are unread player/planet messages, false if not.
	 * @var boolean
	 */
	private $messages;
	
	/**
	 * True if there are unread battle reports, false if not.
	 * @var boolean
	 */
	private $report;
	
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
}