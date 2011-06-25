<?php
/*
 * Use the Parser objects to parse the alliance, event, planet, and player data files.
 * @author Mike Angstadt [github.com/mangstadt]
 */

//require_once __DIR__ . '/PHP-HAPI.phar';
require_once __DIR__ . '/../lib/index.php';

use HAPI\Parsers\AllianceParser;

$parser = new AllianceParser(__DIR__ . '/Hyperiums6-20110617-alliances.txt.gz'); //accepts gzipped and decompressed files
$alliance = $parser->next();
while ($alliance != null){
	$tag = $alliance->getTag();
	$name = $alliance->getName();
	$pres = $alliance->getPresident();
	$planets = $alliance->getNumPlanets();
	echo "[$tag] $name - $planets planets under the command of $pres.\n";
	$alliance = $parser->next();
}