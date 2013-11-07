<?php
$nb = 0;  
foreach($records as $id) {
  mysql_query("DELETE FROM $table WHERE id='$id'");
  $nb++;
}

$message .= "$nb element(s) deleted.";

