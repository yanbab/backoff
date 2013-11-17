<?php
//
// Simple logging helper
//

$_LOGFILE = "log/access.log";

function log_write($msg) {
  global $_LOGFILE,$_SESSION;
  if (isset($_CONFIG['site']['log']) && $_CONFIG['site']['log'] && $handle = @fopen($_LOGFILE, 'a')) {
    $date = date("Y-m-d H:i:s");
    $user = "$_SESSION[auth]";
    $ip = $_SERVER['REMOTE_ADDR'];
    $uri = $_SERVER['REQUEST_URI'];
    $line = "$date\tuser:$user\turi:$uri\tip:$ip\tmsg:$msg\n";
    fwrite ($handle, $line);
    fclose($handle);
  }
}

function log_read($nb = 1000,$start=0) {
  global $_LOGFILE,$_SESSION;
  $handle = fopen($_LOGFILE, "r");
  $array = array();
  if ($handle) {
      $cpt=1;
      while (!feof($handle)) {
        $buffer = explode("\t",fgets($handle, 4096));
        $array[] = array_merge(array($cpt),$buffer);
        ++$cpt;               
      }
      fclose($handle);
  }
  array_pop($array);
  rsort($array);
  return $array;
}


