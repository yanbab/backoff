<?php
/// Configuration file

/// Database
$_CONFIG['db']['type'] = 'mysql'; 
$_CONFIG['db']['host'] = '127.0.0.1';
$_CONFIG['db']['base'] = 'backoff';
$_CONFIG['db']['user'] = 'root';
$_CONFIG['db']['pass'] = 'admin';
//$_CONFIG['db']['prefix'] = 'bo_';

// Email
$_CONFIG['email_from_name'] = "no reply";
$_CONFIG['email_from'] = "webmaster@test.com";


// Time zone
date_default_timezone_set('UTC');
