<?php

require_once LIBRARY_PATH . 'validation.php';

$page   = url_segment(2);
$id     = url_segment(3);
$schema = $_SCHEMA['pages'][$page];
$table  = $_SCHEMA['pages'][$page]['table'];
$fields = $_SCHEMA['pages'][$page]['fields'];
$title  = $_SCHEMA['pages'][$table]['name'];

if(!$_SCHEMA['pages'][$page]) {
  // FIXME : include 404 module
  url_redirect('/404/');
}

switch($_POST['action']) {

  case 'update' : 
  
    // Validation
    
    $errors = array();
    foreach($fields as $fieldname => $field) {
    	if(!Validation::run($field['rules'], $_POST[Plugin::prefix . $fieldname])) {
    	  if(!$field['rules_msg']) {
    	    $field['rules_msg'] = lang("This field is not valid");
    	  }
    	  $errors[$fieldname] = $field['rules_msg'];
    	}
    }
    if($errors) {
      $message = lang("Please correct the form error(s)");
      break;
    }
    
    // New record
    
    if(!$_POST['id']) {
      // INSERT NEW RECORD
      $sql= "INSERT INTO $table (id) VALUES ('');";
      db_query($sql);
      log_write("INSERT (" . substr($sql,0,20). "...)");
      $_POST['id'] = db_insert_id();
    }
    
    // Update Record
    
    // PreUpdateHook
    foreach($fields as $fieldname => $field) {
      call_user_func(array( $field['type'] . "Plugin", preUpdateHook),$field,$_POST[$fieldname]);
    }
    $query = "UPDATE $table SET ";
    // prep for db
    foreach($fields as $fieldname => $field) {
      $value = call_user_func(array( $field['type']. "Plugin", prepForDB),$field,$_POST[Plugin::prefix . $fieldname]);
      $query .= $query_sep . "`$fieldname`" . "='" . $value . "'";
      $query_sep = ', ';
    }
    $query .= " WHERE id='$_POST[id]'";
    db_query($query);
    log_write("UPDATE (" . substr($sql,0,20). ")");
    //echo "<pre>";
    //print_r($_POST);
    //echo $query;exit();
    if(!$errors) 
    url_redirect("/list/$page/?$_SERVER[QUERY_STRING]");
  break;
  
  // Delete record : 
  
  case 'delete' : 
    $sql = "DELETE FROM $table WHERE id='$_POST[id]'";
    db_query($sql);
    log_write("DELETE ($sql)");
    url_redirect("/list/$page/?$_SERVER[QUERY_STRING]");
}

// Load data

$query = db_query ("SELECT * FROM " . $table . " WHERE id= '$id'");
$line = db_fetch($query);
$action = 'update';
// DEFAULT VALUES

// it's an insert, fill with default values :
if(!$line) {
  
  $line = array();
  foreach($schema[fields] as $f) {
      $line[$f[id]] = $f['value'];
  }
}

// There is a validation error, fill with submitted values :
if(is_array($errors)) {
    foreach($schema[fields] as $f) {
        $line[$f[id]] = stripslashes($_POST[Plugin::prefix . $f[id]]);
    } 
}
