<?php
namespace HAPI\Parsers;

require_once __DIR__ . '/../../index.php';

use \Exception;

/**
 * Tests the Parser class.
 * @author Mike Angstadt [github.com/mangstadt]
 * @package HAPI/Parsers
 */
class ParserTest extends \PHPUnit_Framework_TestCase{
	private $files;
	
	/**
	 * Clears the list of created files.
	 */
	public function setUp(){
		$this->files = array();
	}
	
	/**
	 * Deletes all files that the test created.
	 */
	public function tearDown(){
		foreach ($this->files as $file){
			unlink($file);
		}
	}
	
	/**
	 * Tests what happens when the specified file does not exist.
	 */
	public function testFileDoesNotExist(){
		try{
			new ParserTestImpl('does-not-exist.txt');
			$this->fail();
		} catch (Exception $e){
			//should be thrown
		}
	}
	
	/**
	 * Tests what happens when the specified file is empty.
	 */
	public function testFileEmpty(){
		$file = $this->createFile("");
		try{
			new ParserTestImpl($file);
			$this->fail();
		} catch (Exception $e){
			//should be thrown
		}
	}
	
	public function testNextLine(){
		$contents = <<<CONTENTS
the first line is always skipped because it is expected to have the file generation date
line 1

  
#comment
line 2
CONTENTS;

		//make sure it can read both uncompressed and gzipped files
		$files = array($this->createFile($contents), $this->createFile($contents, true));
		
		foreach ($files as $file){
			$parser = new ParserTestImpl($file);
			
			$actual = $parser->nextLine();
			$expected = "line 1";
			$this->assertEquals($expected, $actual);
			
			//empty line
			$actual = $parser->nextLine();
			$expected = "";
			$this->assertEquals($expected, $actual);
			
			//line with whitespace
			$actual = $parser->nextLine();
			$expected = "  ";
			$this->assertEquals($expected, $actual);
			
			$actual = $parser->nextLine();
			$expected = "line 2";
			$this->assertEquals($expected, $actual);
			
			//EOF
			$actual = $parser->nextLine();
			$expected = null;
			$this->assertEquals($expected, $actual);
			
			$parser->close();
		}
	}
	
	public function testGetDateGenerated(){
		//the date is expected to be on the first line of the file
		$contents = <<<CONTENTS
# Generated: 2011-09-28 07:05:01
CONTENTS;
		$file = $this->createFile($contents);
		$parser = new ParserTestImpl($file);
		$actual = $parser->getDateGenerated();
		$expected = strtotime("2011-09-28 07:05:01");
		$this->assertEquals($expected, $actual);
		$parser->close();
		
		//if the date is not on the first line, it will be ignored
		$contents = <<<CONTENTS
# line 1
# Generated: 2011-09-28 07:05:01
CONTENTS;
		$file = $this->createFile($contents);
		$parser = new ParserTestImpl($file);
		$actual = $parser->getDateGenerated();
		$expected = null;
		$this->assertEquals($expected, $actual);
		$parser->close();
		
		//it shouldn't break if there is no date
		$contents = <<<CONTENTS
# line 1
# line 2
CONTENTS;
		$file = $this->createFile($contents);
		$parser = new ParserTestImpl($file);
		$actual = $parser->getDateGenerated();
		$expected = null;
		$this->assertEquals($expected, $actual);
		$parser->close();
	}
	
	public function testHasNext(){
		$contents = <<<CONTENTS
# Generated: 2011-09-28 07:05:01
line 1
CONTENTS;
		$file = $this->createFile($contents);
		$parser = new ParserTestImpl($file);
		$this->assertTrue($parser->hasNext());
		$parser->nextLine();
		$this->assertFalse($parser->hasNext());
		$parser->close();
	}
	
	/**
	 * Creates a file.
	 * @param string $contents the contents of the file
	 * @param boolean $gzipped true to compress the file, false not to
	 * @return the path to the file
	 */
	protected function createFile($contents, $gzipped = false){
		$path = tempnam(sys_get_temp_dir(), "PHP-HAPI-unittest");
		if ($gzipped){
			$fp = gzopen($path, 'w');
			gzwrite($fp, $contents);
			gzclose($fp);
		} else {
			file_put_contents($path, $contents);
		}
		$this->files[] = $path;
		return $path;
	}
}

/**
 * An implementation of the Parser class must be created because the Parser class is abstract.
 * @author Mike Angstadt [github.com/mangstadt]
 * @package HAPI/Parsers
 */
class ParserTestImpl extends Parser{
	//override
	public function next(){
		return $this->nextLine();
	}
	
	//make method public
	public function nextLine(){
		return parent::nextLine();
	}
	
	//make method public
	public function hasNext(){
		return parent::hasNext();
	}
}