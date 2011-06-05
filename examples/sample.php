<?php
namespace HAPI;

require_once dirname(__FILE__) .  '/../lib/HAPI/bootstrap.php';

//static HAPI methods don't require authentication
var_dump(HAPI::getAllGames());

//creating a connection from a new session
$hapi = HAPI::connectNewSession("Hyperiums6", "mangst", "3a2c9b49812a626c72");

//once you've created a session, you can re-use the session so that you don't have to authenticate every time you create a new HAPI object
$session = $hapi->getSession();
$_SESSION['hapi_session'] = $session;
$hapi = HAPI::connectExistingSession($_SESSION['hapi_session']);

//then, simply call the methods from the HAPI class
foreach ($hapi->getMovingFleets() as $mf){
	$name = $mf->getName();
	if ($name == null){
		$name = "no name";
	}
	$from = $mf->getFrom();
	$to = $mf->getTo();
	$action = $mf->isDefending() ? "defend" : "attack";
	$eta = $mf->getDistance();
	
	echo "Fleet \"$name\" is moving from $from to $to and will $action it. ETA $eta hours.\n";
}
