<?php

$module_standalone = true; // do not load index view

if($_SESSION['auth']) {
  // FIXME : redirect to requested module
  url_redirect('/');
}



$check = false;

if(isset($_POST['username'])) {

  $error = true;
  switch ($_SCHEMA['auth']) {
    case 'db' :
      $table = $_SCHEMA['auth_param']['table'];
      $username_field =  $_SCHEMA['auth_param']['username'];
      $password_field =  $_SCHEMA['auth_param']['password'];
      if($_SCHEMA['auth_param']['admin']) {
      	$cond = " AND " . $_SCHEMA['auth_param']['admin'] . "='1' ";
      }
      if($_SCHEMA['auth_param']['encrypt']) {
        // encryption
        $_POST[password] = $_SCHEMA['auth_param']['encrypt']($_POST[password]);
      }
      $query = db_query("SELECT * FROM $table WHERE $username_field = '$_POST[username]' AND $password_field = '$_POST[password]' $cond");
   
      $result = db_fetch($query);
      if($result) {
        $check = true;
      }

    break;
    case 'array':
    
      if($_SCHEMA['auth_param'][$_POST['username']] && $_SCHEMA['auth_param'][$_POST['username']] == $_POST['password'] ) {
        $check = true;
      }
    break;
  }
  


}
if($check) {
  $_SESSION['auth'] = $_POST['username'];
  config_set('auth',$_POST['username']);
  
  log_write("LOGIN ok");
  // FIXME : redirect to requested module
  // FIXME : can't login on IE6
  url_redirect('/');
  
  exit();
} else {
      if($_POST['username']) $msg = " (" . $_POST['username'] . ")";
      if($_POST['username'])
        log_write("LOGIN failed$msg");
} 

