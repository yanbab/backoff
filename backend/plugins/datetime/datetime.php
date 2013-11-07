<?php
//
// Date plugin
//

require_once(PLUGINS_PATH . 'date/date.php');

class datetimePlugin extends datePlugin {

  const description = "Date and time picker";

  function preUpdateHook($field,$value) {
    $h = $_POST[Plugin::prefix . $field[id] . '_h'];
    $m = $_POST[Plugin::prefix . $field[id] . '_m'];
    $s = $_POST[Plugin::prefix . $field[id] . '_s'];
    
    
    //echo $_POST[Plugin::prefix . $field[id]];
    
    $_POST[Plugin::prefix . $field[id]] .= " $h:$m:$s";
    //print_r($_POST[Plugin::prefix . $field[id]]);
    
    
  }
  
  
  function getHtml($field,$value) {
    
    $date = parent::getHtml($field,$value);
    
    $h = substr($value,11,2);
    $m = substr($value,14,2);
    $s = substr($value,17,2);
    
    $field = Plugin::prefix . $field[id];
    
    $date .= " &nbsp; &nbsp; 
      <input name='$field" . "_h'" . " value='$h' size='2'> h 
      <input name='$field" . "_m'" . " value='$m' size='2'> 
      <input type='hidden' name='$field" . "_s'" . " value='$s' size='2'> 
      
    ";
    
    return   $date;
    
  }

  function prepForDisplay($field,$value) {

    $date = parent::prepForDisplay($field,$value);
    if($date!='-') {
        $date .= date(" H:i",strtotime($value));
    }
    return   $date;
  }

  
}
