<?php

spl_autoload_register(function ($classname) {
    $filepath = str_replace("\\", DIRECTORY_SEPARATOR, $classname) . ".php";
    $folders = ["lib", "src/classes"];    
    foreach ($folders as $folder) {
        $path = $folder . "/" . $filepath;
        if (file_exists($path)) {
            require_once $path; 
            return true;
        }
    }
	return false;
});

?>