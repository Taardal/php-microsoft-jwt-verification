<?php 

require_once "src/autoload_classes.php";
require_once "src/globals.php";

$version = $_GET["version"];
require_once "src/" . $version . ".php";

?>