<?php
$page = url_segment(2);
$table = $_SCHEMA['pages'][$page]['table'];

$format = url_segment(3);

// FIXME : order, search, etc
$query = "SELECT * FROM $table";
$result = db_query($query);
$count = db_num_rows($result);
$fields= db_num_fields($result);
$data = "";


switch($format) {
  
  case 'xls':
  case 'csv':

  default : 
    // tab-delimited text for cut'n paste in excel
    $field_separator = "\t";
    $line_separator = "\n";
    $text_separator = "\"";
    
    while ($row=db_fetch($result)) {


      
      foreach($row as $element) {
        if(!is_numeric($element)) {
          $element = str_replace ($field_separator,'  ', $element );
          $element = $text_separator . $element . $text_separator;
        }
        $data .=  $element ;

        $data .= $field_separator;        
      }
      
      $data .= $line_separator;
    }
  break;

}
