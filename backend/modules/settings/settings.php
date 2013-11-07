<?php
//
// Settings module
// 
// Config is loaded by library/php/config.php

// FIXME : hardcoded cookie prefix
// FIXME : hardcoded settings
// FIXME : use edit module ?


// Actions


if($_POST['change_settings']) {
  config_set('results',$_POST['results']);
  config_set('lang',$_POST['lang']);
  config_set('theme',$_POST['theme']);
  config_set('size',$_POST['size']);
  
  config_set('login_cookie',$_POST['login_cookie']);
  
  include LIBRARY_PATH . "settings.php";

}



// Helpers

function ls($dir) {
  if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
      $files = array();
      while (($file = readdir($dh)) !== false) {
        if(substr($file,0,1)!='.') {
          $files[] = $file;
        }
      }
      closedir($dh);
      asort($files);
      return $files;
    }
  }
  return false;
}

function html_select($name,$values,$current) {
  $str .= "  <select name=\"$name\" id=\"$name\" onchange=\"this.form.submit();\" >\n";
  foreach($values as $key => $val) {
    ($key == $current) ? $selected = 'SELECTED' : $selected = ''; 
    $str.= "    <option value=\"$key\" $selected>$val</option>\n";
  }
  $str .= "  </select>\n";
  return $str;
}

// nb results

$results = array(
  '10' => '10',
  '20' => '20',
  '30' => '30',
  '50' => '50',
  '100' => '100',
  '1000' => '1000',
  
);

// Load languages

$languages = array();
$dir = 'lang/';
$files = ls($dir);
if($files) {
  foreach($files as $file) {
    if(!is_dir($dir . $file)) {
      // load language name
      $lang_id = substr($file,5,2);
      $_LANG['lang_name'] = '';
      include ($dir . $file);
      if(!$_LANG['lang_name']) {
        $_LANG['lang_name'] = strtoupper($lang_id);
      }
      $languages[$lang_id] = ucfirst($_LANG['lang_name']);
    }
  }
  // reload current language
  $_LANG = array();
  include 'lang/lang_' . $_CONFIG['lang'] . '.php'; // reload current language
  
}


// Load themes

$themes = array();
$dir = 'themes/';
$files = ls($dir);
if($files) {
  foreach($files as $file) {
    if(is_dir($dir . $file)) {
      $themes[$file] = ucfirst($file);
    }
  }
}

// Size 

$size = array(
  '77' => '77% (10px)',
  '85' => '85% (11px)',
  '93' => '93% (12px)',
  '100' => '100% (13px)',
  '108' => '108% (14px)',
  '116' => '116% (15px)',
  '123.1' => '123% (16px)',
  '131' => '131% (17px)',
  '138.5' => '138% (18px)',
	'153.9' => '154% (20px)',
	'182'	=> '182% (24px)',
);




