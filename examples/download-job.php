<?php
/*
 * This file will download all four of the daily-generated files from HAPI.
 * This can be run daily as a cron job.
 * @author Mike Angstadt [github.com/mangstadt]
 */

$args = new Arguments($argv);

if ($args->get("h", "help")) {
?>
Hyperiums Data File Downloader
http://www.hyperiums.com
by Mike Angstadt [github.com/mangstadt]
Downloads all four of the daily-generated Hyperiums data files.

Example:

php download-job.php --username=mangst --password=secret

Arguments:

--username=USERNAME, -u=USERNAME
    The username of your Hyperiums account.

--password=PASSWORD, -p=PASSWORD
    The password of your Hyperiums account.

--directory=PATH -d=PATH
    The directory that you want the data files to be saved to.  Non-existant
    directories will be created.  Must be an absolute path.
    (defaults to the working directory)

--help, -h
    Prints this help message.
<?php
	exit();
}

//get arguments
$errors = array();
$username = $args->get("u", "username");
if ($username == null){
	$errors[] = "You must specify a username (example: \"--username=mangst\").";
}
$password = $args->get("p", "password");
if ($password == null){
	$errors[] = "You must specify a password (example: \"--password=secret\").";
}
$directory = $args->get("d", "directory", ".");

//print errors
if (count($errors) > 0){
	foreach ($errors as $error){
		echo "$error\n";
	}
	echo "Use --help for more infos.";
	exit();
}

//require_once __DIR__ . '/PHP-HAPI.phar';
require_once __DIR__ . '/../lib/index.php';
use HAPI\HAPI;
use HAPI\HAPIException;

$games = HAPI::getGames();
$date = date("Ymd");
foreach ($games as $game){
	$name = $game->getName();
	$fileFormat = "$directory/$name-$date-%s.txt.gz";
	
	$file = sprintf($fileFormat, "alliances");
	try{
		echo "Downloading $file...";
		HAPI::downloadAlliances($username, $password, $name, $file);
		echo "done.\n";
	} catch (HAPIException $e){
		echo "failed:\n".  $e->getMessage() . "\n\n";
	}
	
	$file = sprintf($fileFormat, "events");
	try{
		echo "Downloading $file...";
		HAPI::downloadEvents($username, $password, $name, $file);
		echo "done.\n";
	} catch (HAPIException $e){
		echo "failed:\n".  $e->getMessage() . "\n\n";
	}
	
	$file = sprintf($fileFormat, "players");
	try{
		echo "Downloading $file...";
		HAPI::downloadPlayers($username, $password, $name, $file);
		echo "done.\n";
	} catch (HAPIException $e){
		echo "failed:\n".  $e->getMessage() . "\n\n";
	}
	
	$file = sprintf($fileFormat, "planets");
	try{
		echo "Downloading $file...";
		HAPI::downloadPlanets($username, $password, $name, $file);
		echo "done.\n";
	} catch (HAPIException $e){
		echo "failed:\n".  $e->getMessage() . "\n\n";
	}
}

/**
 * Parses command-line arguments.
 * @author Mike Angstadt [github.com/mangstadt]
 */
class Arguments{
	/**
	 * Assoc array of the argument names and their values.&nbsp;
	 * The value is boolean true if the argument is a flag
	 * @var array(string=>string|boolean)
	 */
	private $args = array();
	
	/**
	 * Constructs a new arguments object.
	 * @param array(string) $argv the arguments
	 */
	public function __construct($argv){
		unset($argv[0]); //ignore the PHP file name
		foreach ($argv as $arg){
			if ($arg[0] == "-"){
				$long = @$arg[1] == "-";
				$arg = ltrim($arg, "-"); //remove dashes
			} else {
				continue; //ignore args that don't start with "-"
			}
			
			$equals = strpos($arg, "=");
			if ($equals === false){
				$key = $arg;
				$value = true;
			} else {
				$key = substr($arg, 0, $equals);
				$value = ($equals == strlen($arg)-1) ? "" : substr($arg, $equals+1);
			}
			
			if ($long){
				$this->args[$key] = $value;
			} else {
				//flags can be grouped together (example: "-abc" is the same as "-a -b -c")
				for ($i = 0; $i < strlen($key); $i++){
					$this->args[$key[$i]] = $value;
				}
			}
		}
	}
	
	/**
	 * Gets an argument value.
	 * @param string $short the short version of the argument
	 * @param string $long the long version of the argument
	 * @param string $default (optional) the value to return if the argument does not exist (defaults to null)
	 * @return string|boolean the argument value, true if the argument is a flag, or the default value if the argument does not exist
	 */
	public function get($short, $long, $default = null){
		$value = @$this->args[$short];
		if ($value === null){
			$value = @$this->args[$long];
			if ($value === null){
				$value = $default;
			}
		}
		return $value;
	}
}

?>