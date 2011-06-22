# Overview

PHP-HAPI is a PHP library that allows you to easily query the [Hyperiums](http://www.hyperiums.com) API (HAPI).

[Hyperiums](http://www.hyperiums.com) is a massively multiplayer, online strategy game that you play from your web browser.

PHP-HAPI supports HAPI version 0.1.8.

Check outs the [official HAPI specs](http://www.hyperiums.com/HAPI_specs.html) and my [HAPI Developer Reference Manual](https://github.com/downloads/mangstadt/PHP-HAPI/hapi-reference-manual.pdf) for more details about HAPI.

# Requirements

PHP-HAPI requires PHP 5.3 or above.

Requires phar-util (https://github.com/koto/phar-util) to build the Phar file.

Requires phpdocumentor (http://www.phpdoc.org/) to build the API documentation.

# Example Code

```php
<?php
require_once 'PHP-HAPI-0.3.0.phar';
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
	$hapi = new HAPI("Hyperiums6", "mangst", "4e3b88extauthkey8d834");
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
```

[Click here](https://github.com/mangstadt/PHP-HAPI/tree/master/examples) for more examples.

# Changelog

**v0.3.0**

 * Added functionality that parses the alliance, event, planet, and player data files.
 * Added player name to HAPISession object.

**v0.2.0**

 * Added cache detection--checks to see if a response has come from a cache and does not contain up-to-date information (uses "failsafe" parameter).

**v0.1.1**

 * Fixed bug where HAPI::getPlanetInfo() was returning each planet twice if no planet name was specified.
 * Fixed bug where HAPI::getPlanetInfo() was not unmarshalling "government cooldown days" parameter.

**v0.1.0**

First version.
