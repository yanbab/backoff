<?php

$page = url_segment(2);
$table = $_SCHEMA['pages'][$page]['table'];
$schema = $_SCHEMA['pages'][$page];
$id = url_segment(3);
if(!$_SCHEMA['pages'][$table]) {
  // FIXME : include 404 module
  url_redirect('/404/');
}
$fields = $_SCHEMA['pages'][$page]['fields'];


switch($_POST['action']) {

  case 'create' :
      // Create new record
      db_query("INSERT INTO $table (id) VALUES ('');");
      $new_id = db_insert_id();
      // Set default values
      foreach($fields as $field) {
      	if ($field['default']) {
      		// FIXME : pb with quote (no quote because when default = 'now()')
      		db_query("UPDATE $table SET $field[id]='$field[default]' WHERE id='$new_id'");
      	}
      }
      url_redirect("/edit/$page/$new_id");
    break;
    
  case 'update' : 

    $query = "UPDATE $table SET ";
    foreach($fields as $field) {
      $value = call_user_func(array("field_" . $field['type'], prepare),$field,$_POST[$field['id']]);
      $query .= $query_sep . $field['id'] . "='" . $value . "'";
      $query_sep = ', ';
    }
    $query .= " WHERE id='$_POST[id]'";
    db_query($query);
    // FIXME : remember page state
    url_redirect("/list/$page/");
  break;
  case 'delete' : 
    db_query("DELETE FROM $table WHERE id='$_POST[id]'");
    url_redirect("/list/$page/");
} 



$query = db_query ("SELECT * FROM " . $table . " WHERE id= '$id'");
$line = db_fetch($query);

$action = 'update';




