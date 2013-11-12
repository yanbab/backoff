<?php
//
// Backoff Configuration file
//

/// Database
$_CONFIG['db']['type'] = 'mysql'; 
$_CONFIG['db']['host'] = '127.0.0.1';
$_CONFIG['db']['base'] = 'backoff';
$_CONFIG['db']['user'] = 'root';
$_CONFIG['db']['pass'] = 'admin';

// Email
$_CONFIG['email_from_name'] = 'no reply';
$_CONFIG['email_from'] = 'webmaster@test.com';

// URL rewriting
$_CONFIG['site']['index_page'] = 'index.php'; // leave empty if url rewriting is on

// Time zone
date_default_timezone_set('UTC');

// Short tags
ini_set('short_open_tag', 1);