<?php
function println($variable) {
    print_r($variable);
	echo("\n");
}

function printlnln($value) {
    println($value);
	echo("\n");
}

function convert_base64url_to_base64($input) {
    $padding = strlen($input) % 4;
	if ($padding > 0) {
		$input .= str_repeat("=", 4 - $padding);
	}
	return strtr($input, '-_', '+/');
}
?>