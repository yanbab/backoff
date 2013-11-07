<?php
// Check

$tests = array (
	"files/ must be writable" => function() { return is_writable('../../files/'); }
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
