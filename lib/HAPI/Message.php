<?php
namespace HAPI;

class Message{
	const TYPE_PERSONAL = 0;
	const TYPE_MILITARY = 1;
	const TYPE_TRADING = 2;
	const TYPE_INFILTRATION = 4;
	const TYPE_PLANET_CONTROL = 8;
	const TYPE_PLANET_MESSAGE = 16;
	
	/**
	 * The date the message was received.
	 * @var integer
	 */
	private $date;
	private $type;
	private $message;
	private $subject;
	private $sender;
	
	/**
	 * The planet name or null if it was a player message.
	 * @var string
	 */
	private $recipient;
	
	/**
	 * Gets the date the message was received.
	 * @return integer the date (timestamp)
	 */
	public function getDate(){
		return $this->date;
	}

	/**
	 * Sets the date the message was received.
	 * @param integer $date the date (timestamp)
	 */
	public function setDate($date){
		$this->date = $date;
	}

	public function getType(){
		return $this->type;
	}

	public function setType($type){
		$this->type = $type;
	}

	public function getMessage(){
		return $this->message;
	}

	public function setMessage($message){
		$this->message = $message;
	}

	public function getSubject(){
		return $this->subject;
	}

	public function setSubject($subject){
		$this->subject = $subject;
	}

	public function getSender(){
		return $this->sender;
	}

	public function setSender($sender){
		$this->sender = $sender;
	}

	/**
	 * Gets the recipient of the message.
	 * @return string the planet name or null if it was a player message
	 */
	public function getRecipient(){
		return $this->recipient;
	}

	/**
	 * Sets the recipient of the message.
	 * @param string $recipient the planet name or null if it was a player message
	 */
	public function setRecipient($recipient){
		$this->recipient = $recipient;
	}
}