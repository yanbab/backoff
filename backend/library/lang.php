<?php
//
// iI18n function
//


  // Include language files
  
  

  if(file_exists('lang/lang_' . $_CONFIG['lang'] . '.php')) {
    include 'lang/lang_' . $_CONFIG['lang'] . '.php';
  }

  if(file_exists('config/config.schema_' . $_CONFIG['lang'] . '.php')) {
    include 'config/config.schema_' . $_CONFIG['lang'] . '.php';
  }

  $module = url_segment(1);
  if(file_exists($module . '/lang/lang_' . $_CONFIG['lang'] . '.php')) {
    include $module . '/lang/lang_' . $_CONFIG['lang'] . '.php';
  }

// Lang function

function lang($message='') {
  // Returns translated message
  global $_LANG;
  if ($_LANG[$message]) {
    return $_LANG[$message];
  } else {
    return $message;
  }
}
