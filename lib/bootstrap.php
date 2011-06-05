<?php
spl_autoload_register('hapi_autoload');
function hapi_autoload($class){
	$f = dirname(__FILE__) . "/$class.php";
	if (file_exists($f)){
		require_once $f;
	}
}