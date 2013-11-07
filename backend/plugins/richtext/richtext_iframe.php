<?php

include('../../../config.php');

require_once('../../library/db_mysql.php');

session_start();
if(!$_SESSION['auth']) {
    exit();
}

$table = $_GET['table'];
$field = $_GET['field'];
$id = $_GET['id'];

$result = db_query("SELECT * FROM $table WHERE id='$id'");



$rec = db_fetch($result);


?>
<html>
    <head>
        <meta http-equiv="Content-Type"  content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="richtext.css" type="text/css" media="screen" />  
    </head>
    <body>

        <?= $rec[$field]?>
        
    </body>
</html>
