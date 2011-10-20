<?php
namespace HAPI\Parsers;

/**
 * Parses a data file.
 * @author Mike Angstadt [github.com/mangstadt]
 * @package HAPI/Parsers
 */
abstract class Parser{
	/**
	 * The file pointer.
	 * @var resource
	 */
	protected $fp;
	
	/**
	 * The date the file was generated (timestamp).
	 * @var integer
	 */
	protected $dateGenerated;
	
	/**
	 * Constructs a new data file parser object.
	 * @param string $file the *absolute* path to the data file
	 * @throws ParserException if the file doesn't exist or is empty
	 */
	public function __construct($file){
		if (!file_exists($file)){
			throw new ParserException("File does not exist: $file");
		}
		
		$this->fp = gzopen($file, 'r'); //opens gzipped and uncompressed files
		
		//the first line contains the date the file was generated
		$generated = gzgets($this->fp, 4096);
		if ($generated === false){
			throw new ParserException("File is empty: $file");
		}
		if (preg_match("/\\d{4}-\\d{2}-\\d{2} \\d{2}:\\d{2}:\\d{2}/", $generated, $matches)){
			$this->dateGenerated = strtotime($matches[0]);
		}
	}
	
	/**
	 * Gets the next line in the file, ignoring comments.
	 * @return string the next line or null if EOF
	 */
	protected function nextLine(){
		if (!$this->hasNext()){
			return null;
		}
		
		while ($this->hasNext()){
			$line = gzgets($this->fp, 4096);
			$line = rtrim($line, "\n\r"); //remove the trailing newline
			if (@$line[0] == '#'){
				//skip comments
				$line = null; //set to null incase this was the last line in the file
				continue;
			} else {
				break;
			}
		}
		return $line;
	}
	
	/**
	 * Determines if there is another line in the file.
	 * @return boolean true if there is another line, false if EOF
	 */
	protected function hasNext(){
		return !gzeof($this->fp);
	}
	
	/**
	 * Gets the date the file was generated.
	 * @return integer the date the file was generated (timestamp)
	 */
	public function getDateGenerated(){
		return $this->dateGenerated;
	}
	
	/**
	 * Closes the file.
	 */
	public function close(){
		gzclose($this->fp);
	}
	
	/**
	 * Gets the next entry.
	 * @return object the next entry
	 */
	public abstract function next();
}