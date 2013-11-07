<?php
$primary_key = 'id';
$nb = 0;  
foreach($records as $id) {
  $query = mysql_query("SELECT * FROM $table WHERE $primary_key ='$id'");
  while($rec = mysql_fetch_assoc($query)) {
    $sep = '';
    foreach ($rec as $key => $val) {
      if($key!=$primary_key) {
        $sql1 .= "$sep$key";
        $sql2 .= "$sep'$val'";
        $sep = ', ';
      }
    }

    //echo ("INSERT INTO $table ($sql1) VALUES ($sql2)");
    mysql_query ("INSERT INTO $table ($sql1) VALUES ($sql2)");
  }
  $nb++;
}

$message .= "$nb element(s) duplicated.";

