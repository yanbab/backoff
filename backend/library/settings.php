<?php

// load config
// uses $_COOKIE, $_CONFIG, $_SCHEMA


// FIXME : hardcoded settings
// FIXME : hardcoded cookie prefix
// FIXME : avoid function_exists

if(!function_exists('config_set')) {
  // FIXME : HACK : settings module reread this file
  function config_set($name,$value=false) {
    setcookie('backoff_' . $name,$value,time()+60*60*24*365,url_base()); // exp. 365  days
  }
}

if(isset($_POST['change_settings'])) {
  // we just changed settings
  $_CONFIG['results'] = $_POST['results'];
  $_CONFIG['lang'] = $_POST['lang'];
  $_CONFIG['theme'] = $_POST['theme'];
  $_CONFIG['size'] = $_POST['size'];
  
  $_CONFIG['login_cookie'] = $_POST['login_cookie'];
}
else {
  // default settings
  (isset($_SCHEMA['results'])) ? $_CONFIG['results'] = $_SCHEMA['results'] : $_CONFIG['results'] = 20;
  (isset($_SCHEMA['lang'])) ? $_CONFIG['lang'] = $_SCHEMA['lang'] : $_CONFIG['lang'] = 'en';
  (isset($_SCHEMA['theme'])) ? $_CONFIG['theme'] = $_SCHEMA['theme'] : $_CONFIG['theme'] = 'default';
  (isset($_SCHEMA['size'])) ? $_CONFIG['size'] = $_SCHEMA['size'] : $_CONFIG['size'] = '100';
  (isset($_SCHEMA['login_cookie'])) ? $_CONFIG['login_cookie'] = $_SCHEMA['login_cookie'] : $_CONFIG['login_cookie'] = 'on';

  // user settings
  if(isset($_COOKIE['backoff_results'])) $_CONFIG['results'] = $_COOKIE['backoff_results'];
  if(isset($_COOKIE['backoff_lang'])) $_CONFIG['lang'] = $_COOKIE['backoff_lang'];
  if(isset($_COOKIE['backoff_theme'])) $_CONFIG['theme'] = $_COOKIE['backoff_theme'];
  if(isset($_COOKIE['backoff_size'])) $_CONFIG['size'] = $_COOKIE['backoff_size'];

  if(isset($_COOKIE['backoff_login_cookie'])) $_CONFIG['login_cookie'] = $_COOKIE['backoff_login_cookie'];
  

}

// cookie auth
if(isset($_CONFIG['login_cookie'])) {
	if($_COOKIE['backoff_auth']) {
		  $check = false;
			switch ($_SCHEMA['auth']) {
				case 'db' :
				  // FIXME : this is copy/paste from login.php
				  $table = $_SCHEMA['auth_param']['table'];
				  $username_field =  $_SCHEMA['auth_param']['username'];
				  $password_field =  $_SCHEMA['auth_param']['password'];
				  if($_SCHEMA['auth_param']['admin']) {
				  	$cond = " AND " . $_SCHEMA['auth_param']['admin'] . "='1' ";
				  }
				  $query = db_query("SELECT * FROM $table WHERE $username_field = '$_COOKIE[backoff_auth]'  $cond");
				  $result = db_fetch($query);
				  if($result) {
				    $check = true;
				  }
				break;
				case 'array':
				
				  if($_SCHEMA['auth_param'][$_COOKIE[backoff_auth]] ) {
				    $check = true;
				  }
				break;
			}
			
			if($check) {
				$_SESSION['auth'] = $_COOKIE['backoff_auth']; // OK, sign in
			}
	}

}




