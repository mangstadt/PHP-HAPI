<?php
namespace HAPI\Parsers;

require_once __DIR__ . '/../../index.php';

/**
* Tests the PlanetParser class.
* @author Mike Angstadt [github.com/mangstadt]
* @package HAPI/Parsers
*/
class PlanetParserTest extends ParserTest{
	/**
	 * Tests what happens when there are no entries in the file.
	 */
	public function testNoEntries(){
		$contents = <<<CONTENTS
# Generated: 2011-09-28 07:05:01
#> ID - name - gov. system - x - y - race (0:human,1:azterk,2:xillor) - prod.type (0:agro,1:minero,2:techno) - population - public tags - civ. level - planet size
CONTENTS;
		$file = $this->createFile($contents);
		$parser = new PlanetParser($file);
		$planet = $parser->next();
		$this->assertNull($planet);
		$parser->close();
	}
	
	/**
	 * Tests to make sure it parses each entry correctly.
	 */
	public function testNext(){
		$contents = <<<CONTENTS
# Generated: 2011-09-28 07:05:01
#> ID - name - gov. system - x - y - race (0:human,1:azterk,2:xillor) - prod.type (0:agro,1:minero,2:techno) - population - public tags - civ. level - planet size
56239 flat-drop 0 -5 -486 1 2 27570 [EAGLE] 22 3
56263 World_at_War_ 2 27 -400 2 1 27851 [] 26 2
CONTENTS;
		$file = $this->createFile($contents);
		$parser = new PlanetParser($file);
		
		$planet = $parser->next();
		$this->assertEquals("56239", $planet->getId());
		$this->assertEquals("flat-drop", $planet->getName());
		$this->assertEquals(0, $planet->getGovSystem());
		$this->assertEquals(-5, $planet->getX());
		$this->assertEquals(-486, $planet->getY());
		$this->assertEquals(1, $planet->getRace());
		$this->assertEquals(2, $planet->getProdType());
		$this->assertEquals(null, $planet->getPopulation());
		$this->assertEquals(27570, $planet->getActivity());
		$this->assertEquals("EAGLE", $planet->getPublicTag());
		$this->assertEquals(22, $planet->getCivLevel());
		$this->assertEquals(3, $planet->getSize());
		
		$planet = $parser->next();
		$this->assertEquals("56263", $planet->getId());
		$this->assertEquals("World_at_War_", $planet->getName());
		$this->assertEquals(2, $planet->getGovSystem());
		$this->assertEquals(27, $planet->getX());
		$this->assertEquals(-400, $planet->getY());
		$this->assertEquals(2, $planet->getRace());
		$this->assertEquals(1, $planet->getProdType());
		$this->assertEquals(null, $planet->getPopulation());
		$this->assertEquals(27851, $planet->getActivity());
		$this->assertEquals(null, $planet->getPublicTag());
		$this->assertEquals(26, $planet->getCivLevel());
		$this->assertEquals(2, $planet->getSize());
		
		$planet = $parser->next();
		$this->assertNull($planet);
		
		$parser->close();
	}
	
	/**
	* Tests to make sure it parses each entry correctly for RLF2 data files.
	*/
	public function testNextRLF2(){
		$contents = <<<CONTENTS
# Generated: 2011-09-28 07:05:01
#> ID - name - gov. system - x - y - race (0:human,1:azterk,2:xillor) - prod.type (0:agro,1:minero,2:techno) - population - public tags - planet size
2649 Black_Crayon 3 -3 18 2 0 5410 [] 2
3751 Buddy 0 -6 -95 0 0 6745 [Tibet] 3
CONTENTS;
		$file = $this->createFile($contents);
		$parser = new PlanetParser($file, true);
	
		$planet = $parser->next();
		$this->assertEquals("2649", $planet->getId());
		$this->assertEquals("Black_Crayon", $planet->getName());
		$this->assertEquals(3, $planet->getGovSystem());
		$this->assertEquals(-3, $planet->getX());
		$this->assertEquals(18, $planet->getY());
		$this->assertEquals(2, $planet->getRace());
		$this->assertEquals(0, $planet->getProdType());
		$this->assertEquals(5410, $planet->getPopulation());
		$this->assertEquals(null, $planet->getActivity());
		$this->assertEquals(null, $planet->getPublicTag());
		$this->assertEquals(null, $planet->getCivLevel());
		$this->assertEquals(2, $planet->getSize());
	
		$planet = $parser->next();
		$this->assertEquals("3751", $planet->getId());
		$this->assertEquals("Buddy", $planet->getName());
		$this->assertEquals(0, $planet->getGovSystem());
		$this->assertEquals(-6, $planet->getX());
		$this->assertEquals(-95, $planet->getY());
		$this->assertEquals(0, $planet->getRace());
		$this->assertEquals(0, $planet->getProdType());
		$this->assertEquals(6745, $planet->getPopulation());
		$this->assertEquals(null, $planet->getActivity());
		$this->assertEquals("Tibet", $planet->getPublicTag());
		$this->assertEquals(null, $planet->getCivLevel());
		$this->assertEquals(3, $planet->getSize());
	
		$planet = $parser->next();
		$this->assertNull($planet);
	
		$parser->close();
	}
}