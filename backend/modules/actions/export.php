<?php

$primary_key = 'id';
$nb = 0;  

$sep = "";
$where = "";
foreach($records as $id) {
  $where .= "$sep $primary_key='$id'";  
  $sep = " OR ";
  $nb++;
}  
if($where) $where = " WHERE $where";

// FIXME : order, search, etc
$query = "SELECT * FROM $table $where";

$result = db_query($query);
$count = db_num_rows($result);
//$fields= db_num_fields($result);
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


$message="
<p><strong>Export de $nb éléments</strong></p>

<textarea wrap=off id=\"export_field\" style=\"width : 80%;height : 10em; border : solid black 1px;font-size:10px;\">$data</textarea>
<div class=\"description\">Pour récuperer les données, <br>copiez-collez le contenu de ce champ texte dans votre tableur.</div>
<script type=\"text/javascript\">
  document.getElementById('export_field').select();
</script>
";







