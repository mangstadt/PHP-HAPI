<?php
namespace HAPI\Parsers;

require_once __DIR__ . '/../../index.php';

/**
* Tests the AllianceParser class.
* @author Mike Angstadt [github.com/mangstadt]
* @package HAPI/Parsers
*/
class AllianceParserTest extends ParserTest{
	/**
	 * Tests what happens when there are no entries in the file.
	 */
	public function testNoEntries(){
		$contents = <<<CONTENTS
# Generated: 2011-09-28 07:05:01
#> alliance tag - name
#> alliance description
#> president name - avg. coord x - y - nb. planets - total influence
CONTENTS;
		$file = $this->createFile($contents);
		$parser = new AllianceParser($file);
		$alliance = $parser->next();
		$this->assertNull($alliance);
		$parser->close();
	}
	
	/**
	 * Tests to make sure it parses each entry correctly.
	 */
	public function testNext(){
		$contents = <<<CONTENTS
# Generated: 2011-09-28 07:05:01
#> alliance tag - name
#> alliance description
#> president name - avg. coord x - y - nb. planets - total influence
.S/L. The Shadow Legion

Joekel -1 -43 121 787317478
Fire Death is coming for you
Thought &#34;Death&#34; was bad? now he's on fire too and after you...
Death_Ablaze 7 -9 1 8371562
CONTENTS;
		$file = $this->createFile($contents);
		$parser = new AllianceParser($file);
		
		$alliance = $parser->next();
		$this->assertEquals(".S/L.", $alliance->getTag());
		$this->assertEquals("The Shadow Legion", $alliance->getName());
		$this->assertEquals("", $alliance->getDescription());
		$this->assertEquals("Joekel", $alliance->getPresident());
		$this->assertEquals(-1, $alliance->getAvgCoordX());
		$this->assertEquals(-43, $alliance->getAvgCoordY());
		$this->assertEquals(121, $alliance->getNumPlanets());
		$this->assertEquals(787317478, $alliance->getTotalInfluence());
		
		$alliance = $parser->next();
		$this->assertEquals("Fire", $alliance->getTag());
		$this->assertEquals("Death is coming for you", $alliance->getName());
		$this->assertEquals("Thought \"Death\" was bad? now he's on fire too and after you...", $alliance->getDescription());
		$this->assertEquals("Death_Ablaze", $alliance->getPresident());
		$this->assertEquals(7, $alliance->getAvgCoordX());
		$this->assertEquals(-9, $alliance->getAvgCoordY());
		$this->assertEquals(1, $alliance->getNumPlanets());
		$this->assertEquals(8371562, $alliance->getTotalInfluence());
		
		$alliance = $parser->next();
		$this->assertNull($alliance);
		
		$parser->close();
	}
}