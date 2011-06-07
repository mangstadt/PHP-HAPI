# Overview

PHP-HAPI is a PHP library that allows you to easily query the [Hyperiums](http://www.hyperiums.com) API (HAPI).

# Requirements

PHP-HAPI requires PHP 5.3 or above.

# Example Code

```php
require_once dirname(__FILE__) .  '/../lib/HAPI/bootstrap.php';
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
$hapi = new HAPI("Hyperiums6", "mangst", "4e3b88extauthkey8d834");

//you can save the HAPI object to the PHP session and re-use it later
//this makes things faster, as another auth request does not need to be sent 
$_SESSION['hapi'] = $hapi;

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
```
