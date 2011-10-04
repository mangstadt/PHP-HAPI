# Overview

PHP-HAPI is a PHP library that allows you to easily query the [Hyperiums](http://www.hyperiums.com) API (HAPI).

[Hyperiums](http://www.hyperiums.com) is a massively multiplayer, online strategy game that you play from your web browser.

PHP-HAPI supports HAPI version 0.1.8.

For more information on HAPI, check out the [official HAPI specs](http://www.hyperiums.com/HAPI_specs.html) or the [HAPI Developer Reference Manual](https://github.com/downloads/mangstadt/PHP-HAPI/hapi-reference-manual.pdf) that I wrote.

# Requirements

PHP-HAPI requires PHP 5.3 or above.

Requires phar-util (https://github.com/koto/phar-util) to build the Phar file.

Requires phpdocumentor (http://www.phpdoc.org/) to build the API documentation.

# Features

## Complete API coverage

Supports all HAPI requests defined in the [official HAPI specs](http://www.hyperiums.com/HAPI_specs.html).
Responses are unmarshalled into plain, getter/setter objects.

```php
<?php
require_once 'PHP-HAPI.phar';
use HAPI\HAPI;

foreach (HAPI::getGames() as $game){
	$name = $game->getName();
	$description = $game->getDescription();
	echo "$name: $description\n";
}
```

## Flood protection

Request frequency is monitored using file locking to adhere to HAPI usage rules and prevent the user from being locked out.
One request is sent at most every two seconds per authenticated player.
This means that two request for two different players can be sent at the same time, but two requests for the same player must be sent at least two seconds apart.

To enable, specify the absolute path to a *writeable* directory in either the constructor or setFloodProtection() method of the HAPI class.
The lock files will be saved to this directory.

```php
<?php
require_once 'PHP-HAPI.phar';
use HAPI\HAPI;

$hapi = new HAPI("Hyperiums6", "mangst", "4e3b88extauthkey8d834", __DIR__ . "/locks");
$messages = $hapi->getNewMessages();
//waits 2 seconds
$messages = $hapi->getNewMessages();
```

## Logging

All HAPI requests and responses can optionally be logged to either the PHP error log or a file of your choice (or both).
Use the HAPI::setLogToFile() and HAPI::setLogToPHPErrorLog() methods to enable logging.

```php
<?php
require_once 'PHP-HAPI.phar';
use HAPI\HAPI;

HAPI::setLogToPHPErrorLog(true);
$games = HAPI::getGames();
HAPI::setLogToFile(__DIR__ . '/hapi-log.txt');
$games = HAPI::getGames();
```

## Data file parsing

PHP-HAPI comes with an API that makes it easy to parse the data out of the downloaded data files.
All four data files (alliance, event, planet, player) are supported.

```php
<?php
require_once 'PHP-HAPI.phar';
use HAPI\Parsers\AllianceParser;

$parser = new AllianceParser(__DIR__ . '/Hyperiums6-20110617-alliances.txt.gz');
while ($alliance = $parser->next()){
	$tag = $alliance->getTag();
	$name = $alliance->getName();
	$pres = $alliance->getPresident();
	$planets = $alliance->getNumPlanets();
	echo "[$tag] $name - $planets planets under the command of $pres.\n";
}
```

# Code Sample

```php
<?php
require_once 'PHP-HAPI.phar';
use HAPI\HAPI;
use HAPI\Game;

//static methods in HAPI class don't require authentication
foreach (HAPI::getGames() as $game){
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
	echo "$name: $description -- $state\n";
}

//authenticate with HAPI by creating a new object
try{
	$hapi = new HAPI("Hyperiums6", "mangst", "4e3b88extauthkey8d834", __DIR__ . "/locks");
} catch (Exception $e){
	//an exception is thrown if authentication fails
	die("Error authenticating: " . $e->getMessage());
}

//HAPI object can be saved to session
$_SESSION['hapi'] = $hapi;

//get the player's moving fleets
try{
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
```

[Click here](https://github.com/mangstadt/PHP-HAPI/tree/master/examples) for more examples.

# Changelog

**v0.4.0** - Aug 03 2011

 * Renamed many methods with simpler, more descriptive names.  For example:
   * HAPI::getAllGames > getGames
   * Exploitation#getNumExploits > getExploits
   * FleetsInfo#getNrj > getEnergy
 * Download methods now check to make sure the specified file can be written to *before* making the actual download request.
 * Added PHPDocs to undocumented methods. 
 * Removed the ability to disable cache detection (there should be no reason to disable it).
 * Boolean response parameters are now unmarshalled as actual boolean variables instead of the strings "0" and "1".

**v0.3.3** - Jul 30 2011

 * Added the ability to log requests/responses to a log file of your choice instead of just the PHP error log. 

**v0.3.2**

 * Fixed bug in HAPI constructor where the flood lock directory wasn't being properly initialized.

**v0.3.1**

 * Alliance descriptions from the alliance data file are now HTML-decoded, as they can contain HTML-encode characters.
 * Fix bug in PlayerParser where a field was being treated as a date, when it shouldn't have been. 
 
**v0.3.0**

 * Added functionality that parses the alliance, event, planet, and player data files.
 * Added player name to HAPISession object.

**v0.2.0**

 * Added cache detection--checks to see if a response has come from a cache and does not contain up-to-date information (uses "failsafe" parameter).

**v0.1.1**

 * Fixed bug where HAPI::getPlanetInfo() was returning each planet twice if no planet name was specified.
 * Fixed bug where HAPI::getPlanetInfo() was not unmarshalling "government cooldown days" parameter.

**v0.1.0**

 * First version.
