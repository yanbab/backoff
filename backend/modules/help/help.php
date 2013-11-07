<?php

$page = url_segment(2);
$lang = $_CONFIG[lang];

if(!$page) $page = 'index';




$help_file = "modules/help/pages/$page.php";


