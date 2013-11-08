<?php
// Check
$frontend = '../frontend';
$tests = array (
	"files/ must be writable" => function() { return is_writable("$frontend/files/"); },
	"files/images must be writable" => function() { return is_writable("$frontend/files/images/"); },
	"php short open tags must be enabled" => function() { return ini_get('short_open_tags'); }
);

$results = array();

foreach ($tests as $name => $function) {
	echo $name;
	if($function()) {
		echo " [OK]";
	} else {
		echo " [FAILED]";
	}
}
