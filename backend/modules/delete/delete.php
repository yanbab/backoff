<?php

$page = url_segment(2);
$title = $_SCHEMA['pages'][$page]['name'];
$table = $_SCHEMA['pages'][$page]['table'];

function delete_exec($id,$table) {
  $sql = "DELETE FROM $table WHERE id='$id'";
  mysql_query($sql);
}

if(is_array($_POST[checked_id])) {
  
  foreach($_POST[checked_id] as $id) {
    //delete_exec($id,$table);
  }

} else {
  $error = "Aucun élément séléctionné";
}
?>
