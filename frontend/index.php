<?php

require '../config.php';

define('LIBRARY_PATH', dirname(__FILE__) . '/../backend/library/');
require LIBRARY_PATH . 'db.php';

// Request
$_REQUEST =  array (
    'verb'     => strtolower($_SERVER['REQUEST_METHOD']),
    'path'     => isset($_SERVER['PATH_INFO']) ? trim($_SERVER['PATH_INFO'], '/') : '/',
    'segments' => isset($_SERVER['PATH_INFO']) ? explode('/', trim($_SERVER['PATH_INFO'], '/')) : array(''),
    'params'   => isset($_GET) ? $_GET : null
);

// Config
$config = array();
$query = db_query("SELECT * FROM config");
while($cfg = db_fetch($query)) {
    $config[$cfg['key']] = $cfg['value'];
}

// Site location
$_CONFIG['site']['url'] = dirname($_SERVER['SCRIPT_NAME']);
$_CONFIG['site']['base_url'] = $_CONFIG['site']['url'] . '/';
if($_CONFIG['site']['index_page']) {
	$_CONFIG['site']['url'] .= '/' . $_CONFIG['site']['index_page'];
}

// Pages
$pages = db_get("SELECT pages.*, pages_modules.module FROM pages, pages_modules WHERE pages.id_module = pages_modules.id ORDER BY position, id  ");
$page = db_fetch(db_query("SELECT pages.*, pages_modules.module FROM pages, pages_modules WHERE pages.id_module = pages_modules.id AND  url = '{$_REQUEST['segments'][0]}' "));
$page['view'] = "modules/{$page['module']}/{$page['module']}_view.php";

// Include module
include "modules/{$page['module']}/{$page['module']}.php";
include "index_view.php";
