<?php
//require_once __DIR__ .  '/PHP-HAPI-0.1.0.phar';
require_once __DIR__ .  '/../lib/index.php';
use HAPI\HAPI;
use HAPI\Game;

//static methods in HAPI class don't require authentication
foreach (HAPI::getAllGames() as $game){
	$name = $game->getName();
	$description = $game->getDescription();
	$state = $game->getState();
	switch ($state){
		case Game::STATE_NOT_RUNNING_CLOSED:
			$state = "not running, closed";
			break;
		case Game::STATE_NOT_RUNNING_OPEN_REGISTRATION:
			$state = "not running, open for registration";
			break;
		case Game::STATE_RUNNING_CLOSED:
			$state = "running, closed to new players";
			break;
		case Game::STATE_RUNNING_OPEN:
			$state = "running, open to new players";
			break;
	}
	$initCash = number_format($game->getInitCash());
	echo "$name: $description -- $state\n";
}

//authenticate with HAPI by creating a new object
try{
	$hapi = new HAPI("Hyperiums6", "mangst", "659194d68abafc6a4");
} catch (Exception $e){
	//an exception is thrown if there is an authentication failure
	die("Error authenticating: " . $e->getMessage());
}

//you can save the HAPI object to the PHP session and re-use it later
//this makes things faster, because when you construct a new HAPI object, it sends an auth request, which you don't have to do if you've already authenticated
$_SESSION['hapi'] = $hapi;

try{
	//then, simply call the methods from the HAPI class
	$movingFleets = $hapi->getMovingFleets();
	foreach ($movingFleets as $mf){
		$from = $mf->getFrom();
		$to = $mf->getTo();
		$action = $mf->isDefending() ? "defend" : "attack";
		$eta = $mf->getDistance();
		
		$name = $mf->getName();
		if ($name == null){
			$name = "no name";
		}

		switch ($mf->getRace()){
			case HAPI::RACE_AZTERK:
				$race = 'Azterk';
				break;
			case HAPI::RACE_HUMAN:
				$race = 'Human';
				break;
			case HAPI::RACE_XILLOR:
				$race = 'Xillor';
				break;
		}
		
		echo "The $race fleet \"$name\" is moving from $from to $to and will $action it. ETA $eta hours.\n";
	}
} catch (Exception $e){
	die("Error getting moving fleets: " . $e->getMessage());
}

//flood protection prevents you from being locked out of HAPI from making requests too fast
$hapi->setFloodProtection(__DIR__ . "/flood-locks");
for ($i = 0; $i < 100; $i++){
	$hapi->getNewMessages();
}
//without flood protection, you would be locked out by now
