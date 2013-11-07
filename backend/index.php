<?php 
//
// Backoff Main Controller
//

include '../config.php';

define('LIBRARY_PATH', dirname(__FILE__) . '/library/');
define('SITE_PATH', '../');
define('PLUGINS_PATH', 'plugins/');
define('VERSION', '0.1');
define('DEBUG', true);

// error handling
error_reporting(E_ALL ^ E_NOTICE);
set_error_handler(function(){});

session_start();

// Load & cache Schema file

if($_SESSION['_SCHEMA_CACHE_TIME'] != filemtime('config/config.schema.yml')||isset($_GET['reload'])) {
    require LIBRARY_PATH . '/spyc.php';
    $_SCHEMA =  Spyc::YAMLLoad('config/config.schema.yml');
    $_SESSION['_SCHEMA'] = $_SCHEMA;
    $_SESSION['_SCHEMA_CACHE_TIME'] = filemtime('config/config.schema.yml');
}
$_SCHEMA = $_SESSION['_SCHEMA'];

// Library
require LIBRARY_PATH . '/db.php';
require LIBRARY_PATH . '/url.php';
require LIBRARY_PATH . '/settings.php';
require LIBRARY_PATH . '/lang.php';
require LIBRARY_PATH . '/log.php';
require LIBRARY_PATH . '/plugin.php';

// Plugins

plugin_load(plugin_list());

// Routing

$module = url_segment(1);

if(!$module) {
  $module = 'welcome';
}

if(!file_exists("modules/$module/$module.php")) {
  $module = '404';
}

if(!$_SESSION['auth']) {
  $module = 'login';
}

$module_controller = "modules/$module/$module" . ".php"; 
$module_view = "modules/$module/$module" . "_view.php"; // to be included by index module

//$module_standalone = $_GET['module_standalone'];

include $module_controller;

if($module_standalone) {
    include $module_view;
} else {
  include 'modules/index/index.php';
  include 'modules/index/index_view.php';
}
// Remember last page

//$_SESSION[last_uri] = $_SERVER['REQUEST_URI'];


