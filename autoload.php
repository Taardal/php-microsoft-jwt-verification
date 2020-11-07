<?php

spl_autoload_register(function ($classname) {
	$filepath = str_replace("\\", DIRECTORY_SEPARATOR, $classname) . ".php";
	if (file_exists($filepath)) {
		require_once $filepath; 
		return true;
	}
	return false;
});

?>