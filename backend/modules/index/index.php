<?php

$url_base = url_base();

if($_CONFIG['site']['index_page']) {
	$url_base = dirname($url_base) . '/';
}