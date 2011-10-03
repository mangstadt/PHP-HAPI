<?php
namespace HAPI\Parsers;

require_once __DIR__ . '/../../index.php';

/**
* Tests the EventParser class.
* @author Mike Angstadt [github.com/mangstadt]
* @package HAPI/Parsers
*/
class EventParserTest extends ParserTest{
	/**
	 * Tests what happens when there are no entries in the file.
	 */
	public function testNoEntries(){
		$contents = <<<CONTENTS
# Generated: 2011-09-28 07:05:01
#> planet ID - planet name - event date - event descr.
CONTENTS;
		$file = $this->createFile($contents);
		$parser = new EventParser($file);
		$event = $parser->next();
		$this->assertNull($event);
		$parser->close();
	}
	
	/**
	 * Tests to make sure it parses each entry correctly.
	 */
	public function testNext(){
		$contents = <<<CONTENTS
# Generated: 2011-09-28 07:05:01
#> planet ID - planet name - event date - event descr.
4123 Steelers_rule 2011-09-20 06:54:03 End of battle.
1557 Schnappi 2011-09-20 11:35:18 The government system has changed to Democratic.
CONTENTS;
		$file = $this->createFile($contents);
		$parser = new EventParser($file);
		
		$event = $parser->next();
		$this->assertEquals("4123", $event->getPlanetId());
		$this->assertEquals("Steelers_rule", $event->getPlanetName());
		$this->assertEquals(strtotime("2011-09-20 06:54:03"), $event->getDate());
		$this->assertEquals("End of battle.", $event->getDescription());
		
		$event = $parser->next();
		$this->assertEquals("1557", $event->getPlanetId());
		$this->assertEquals("Schnappi", $event->getPlanetName());
		$this->assertEquals(strtotime("2011-09-20 11:35:18"), $event->getDate());
		$this->assertEquals("The government system has changed to Democratic.", $event->getDescription());
		
		$event = $parser->next();
		$this->assertNull($event);
		
		$parser->close();
	}
}