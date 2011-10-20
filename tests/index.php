<?php
require_once __DIR__ . '/../lib/index.php'; //include src files
require_once 'PHPUnit/Framework.php'; //include PHPUnit

spl_autoload_register(function ($class) {
	$path = str_replace('\\', '/', $class); //replace back-slashes with forward-slashes
	$path = __DIR__ . "/$path.php";
	if (file_exists($path)){
		require_once $path;
	}
});