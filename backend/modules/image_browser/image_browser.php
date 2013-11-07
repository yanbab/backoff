<?php
/**
 * Image Browser.
 */
$module_standalone = true;

$url = str_replace('..','',$_GET[folder]);
$folder = "../" . $url . "/";

// Error management
$error = '';
//if(!is_writable($folder)) $error = "Folder '$_GET[folder]' is not writable";
if(!file_exists($folder)) $error = "Folder '$_GET[folder]' do not exist";
if($error) {
  echo "<b>Error : </b> $error";
  exit();
}

$max_width = 200;


// Move uploaded file :

$filename = basename($_FILES['userfile']['name']);
// Clean a string for use as filename with underscore :
if(function_exists('mb_convert_encoding')) { 
  $filename  = strtr(mb_convert_encoding($filename,'ASCII'), ' ,;:?*#!§$%&/(){}<>=`´|\\\'"', '____________________________'); 
}
@move_uploaded_file($_FILES['userfile']['tmp_name'], $folder . $filename );
@chmod($folder . $filename ,0666);

// Delete file :
if($_POST[file_to_delete]) {

  unlink("$folder$_POST[file_to_delete]");
}



function ls($dir,$sort='',$order='') {
  global $_dir_;
  $_dir_ = $dir;
  function cmp($a, $b)
  {
      global $_dir_;
      $a = filemtime($_dir_.$a);
      $b = filemtime($_dir_.$b);
      if ($a == $b) {
          return 0;
      }
      return ($a > $b) ? -1 : 1;
  }
  
  if (is_dir($dir)) {
      if ($dh = opendir($dir)) {
          $list = array();
          while (($file = readdir($dh)) !== false) {
              if(substr($file,0,1)!='.') {
                $list[] = $file;
              }
          }
          closedir($dh);
          //asort($list);
          usort($list,cmp);
          return $list;
      }
  }
  return false;
}

$images = ls($folder,'date');


