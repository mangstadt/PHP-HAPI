<?php
namespace HAPI;

/**
 * IsMsg class (used for the "ismsg" HAPI method).
 * @package HAPI
 * @author Mike Angstadt [github.com/mangstadt]
 */
class IsMsg{
	private $msg;
	private $report;
	
	public function isMsg(){
		return $this->msg;
	}

	public function setMsg($msg){
		$this->msg = $msg;
	}

	public function isReport(){
		return $this->report;
	}

	public function setReport($report){
		$this->report = $report;
	}
}