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
	private $battleReports;
	
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
}