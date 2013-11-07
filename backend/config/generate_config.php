<?php
//
// Generates basic schema from db structure
//


$show_keys = false;


include "../../config.php";

define('LIBRARY_PATH','../library/');

require LIBRARY_PATH . 'db.php';
require LIBRARY_PATH . 'spyc.php';
$_SCHEMA = array();

$_SCHEMA['title'] = 'Admin';
$_SCHEMA['theme'] = 'default';
$_SCHEMA['lang'] =  'fr';
$_SCHEMA['auth'] =  'db';
$_SCHEMA['auth_param']['table'] =  'users';
$_SCHEMA['auth_param']['username'] =  'username';
$_SCHEMA['auth_param']['password'] =  'password';
$_SCHEMA['auth_param']['admin'] =  'admin';
$_SCHEMA['#auth'] =  'array';
$_SCHEMA['#auth_param']['#username'] =  'admin';
$_SCHEMA['#auth_param']['#password'] =  'admin';
$_SCHEMA['pages']['title']['type']= 'separator';
$_SCHEMA['pages']['title']['name']= 'Menu';
$_SCHEMA['pages']['title']['description']= '';


// table list for select plugin
$q = db_get("SHOW TABLES");

foreach($q as $t) {

  $tables[] = array_pop($t);
}

$query_table = db_query("SHOW TABLES");
while($result_table = db_fetch($query_table)) {
  $table = $result_table[0];
  //echo $table_name;
  $_SCHEMA['pages'][$table]['type'] = 'module';
  $_SCHEMA['pages'][$table]['name'] = ucfirst(str_replace('_',' ',$table));
  $_SCHEMA['pages'][$table]['table'] = $table;
  $_SCHEMA['pages'][$table]['key'] = 'id'; // fixme : get from 
  $_SCHEMA['pages'][$table]['filter'] = '';
  $_SCHEMA['pages'][$table]['order'] = '';
  $_SCHEMA['pages'][$table]['per_page'] = '';
  $_SCHEMA['pages'][$table]['description'] = '';
  $_SCHEMA['pages'][$table]['no_create'] = '';

  $query_field = db_query("SHOW COLUMNS FROM $table");
  while($result = db_fetch($query_field)) {
    
    if($result['Key']=='PRI') {
      $_SCHEMA['pages'][$table]['key'] = $result['Field']; 
    } else {

      $field['id'] = $result['Field'];
      $field['name'] = ucfirst(str_replace('_',' ',$result['Field']));
      $field['type'] = 'text';
      if($result['Type']=='text') {
        $field['type'] = 'textarea';
      }
      if($result['Type']=='tinyint(1)') {
        $field['type'] = 'checkbox';
      }
      if($result['Type']=='datetime') {
        $field['type'] = 'date';
      }
      
      if($result['Type']=='date') {
        $field['type'] = 'date';
      }      
      if($result['Field']=='color') {
        $field['type'] = 'color';
      }
            
      if($result['Field']=='email'||$result['Field']=='mail') {
       // $field['format'] = "<a href=\"mailto:%s\">%s</a>";
      }
      
      if(substr($result['Field'],0,3)=='id_') {
        // Foreign key (id_tablename)
        
        $field['name'] = ucfirst(str_replace('_',' ',substr($result['Field'],3)));
        $tname = substr($result['Field'],3);
        if(in_array($tname,$tables)) {
          $field['table']['name'] = $tname;
          $field['type'] = 'select';
        }      
        if(in_array($tname . 's',$tables)) {
          $field['table']['name'] = $tname . 's';
          $field['type'] = 'select';
        }              
        $field['table']['id'] = 'id';
        $field['table']['field'] = 'name';
//        echo " $table";
      }
      
      
      $_SCHEMA['pages'][$table]['fields'][$result['Field']] = $field;

    }
  }


}

header('Content-Type: text/plain');
if($_GET['php']) {
  echo '$_SCHEMA = ';
  echo var_export($_SCHEMA);
  echo ';';
} else {
  echo Spyc::YAMLDump($_SCHEMA);
}
