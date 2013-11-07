<?php
//
// Select Plugin
//

/*
        params: 
          table_name: clients     # table 
          table_key: id           # table key (default to 'id')
          table_field: name       # table field to display (default to 'name')
          table_order: position   # ORDER clause 
          table_where: 'active=0' # WHERE clause to filter values
*/

require_once(PLUGINS_PATH . 'select/select.php');

class selectmultiplePlugin extends selectPlugin {
   
    const description = "Choice (multiple)";
    function getHtml($field,$value='') {
        if($field['table']['name']) {
           $field['values'] = selectPlugin::_get_values($field);
        }

        $value = selectPlugin::_html_select($field['id'],$field['values'],$value);

        if($field['description']) {
            $desc = "\n<div class=\"description\">" . $field['description'] . "</div>";
        }

        return $value . $desc;

    }


    function prepForDisplay($field,$value='') {
        if(is_array($value)) {
            // either the full record or the element value
            $value = $value[$field['id']];
        }
        if($field['params']['table_name']) {
            $field['params']['values'] = selectPlugin::_get_values($field);
        }
        $value = $field['values'][$value];

        return $value;
    }

    //
    // Private Helpers
      
    function _get_values($field) {
      
        // returns cached result

        $cached_values = "_VALUES_DB_" . $field['params']['table_name'];
        global $$cached_values;
        if($$cached_values) {
            return $$cached_values;
        }

        // Set arguments

        $table   = $field['params']['table_name'];    
        $f_id    =  $field['params']['table_key'];
        $f_field =  $field['params']['table_field'];
        $f_order =  $field['params']['table_order'];
        $f_where =  $field['params']['table_where'];

        if(!$f_id) $f_id = 'id';
        if($f_order) $f_order = "ORDER BY $f_order";
        if($f_where) $WHERE = "WHERE $f_where";


        // Perform Query

        $sql = "SELECT * FROM $table $WHERE " . $f_order;
        $result = db_query($sql);
        $values = array(''=>'');
        while($row = db_fetch($result)) {
            $values[$row[$f_id]] = $row[$f_field];
        }

        $$cached_values = $values; // Cache result

        return $values;     

    }

  
    function _html_select($name,$values,$current) {
        $str .= "  <select name=\"$name\" id=\"$name\" >\n";
        if(!$values) {
            $values = array(''=>'[undefined]'); 
        }
        foreach($values as $key => $val) {
            ($key == $current) ? $selected = 'SELECTED' : $selected = ''; 
            $str.= "    <option value=\"$key\" $selected>$val</option>\n";
        }
        $str .= "  </select>\n";
        return $str;
    }  
  
}



