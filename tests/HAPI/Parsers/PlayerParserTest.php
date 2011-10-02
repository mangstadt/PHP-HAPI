<?php
namespace HAPI\Parsers;

require_once __DIR__ . '/../../index.php';

/**
 * Tests the PlayerParser class.
 * @author Mike Angstadt [github.com/mangstadt]
 * @package HAPI/Parsers
 */
class PlayerParserTest extends ParserTest{
	/**
	 * Tests what happens when there are no entries in the file.
	 */
	public function testNoEntries(){
		$contents = <<<CONTENTS
# Generated: 2011-09-28 07:05:01
#> name - influ.rank - influ.rank/SC - influ.score - hyp.rank - IDR rank - IDR score - IDR rank/SC - SC - City/country
CONTENTS;
		$file = $this->createFile($contents);
		$parser = new PlayerParser($file);
		$player = $parser->next();
		$this->assertNull($player);
	}
	
	/**
	 * Tests to make sure it parses each entry correctly.
	 */
	public function testNext(){
		$contents = <<<CONTENTS
# Generated: 2011-09-28 07:05:01
#> name - influ.rank - influ.rank/SC - influ.score - hyp.rank - IDR rank - IDR score - IDR rank/SC - SC - City/country
Dusty 197 192 10963722 3 179 874993 179 0 Missoula, Montana, USA
Kepler 157 157 15616191 4 212 562853 211 15 
CONTENTS;
		$file = $this->createFile($contents);
		$parser = new PlayerParser($file);
		
		$player = $parser->next();
		$this->assertEquals("Dusty", $player->getName());
		$this->assertEquals(197, $player->getInfluenceRank());
		$this->assertEquals(192, $player->getInfluenceRankSC());
		$this->assertEquals(10963722, $player->getInfluenceScore());
		$this->assertEquals(3, $player->getHypRank());
		$this->assertEquals(179, $player->getIDRRank());
		$this->assertEquals(874993, $player->getIDRScore());
		$this->assertEquals(179, $player->getIDRRankSC());
		$this->assertEquals(null, $player->getSC());
		$this->assertEquals("Missoula, Montana, USA", $player->getLocation());
		
		$player = $parser->next();
		$this->assertEquals("Kepler", $player->getName());
		$this->assertEquals(157, $player->getInfluenceRank());
		$this->assertEquals(157, $player->getInfluenceRankSC());
		$this->assertEquals(15616191, $player->getInfluenceScore());
		$this->assertEquals(4, $player->getHypRank());
		$this->assertEquals(212, $player->getIDRRank());
		$this->assertEquals(562853, $player->getIDRScore());
		$this->assertEquals(211, $player->getIDRRankSC());
		$this->assertEquals(15, $player->getSC());
		$this->assertEquals(null, $player->getLocation());
		
		$player = $parser->next();
		$this->assertNull($player);
	}
}