<?php
//
// Select Plugin
//


class selectPlugin extends Plugin {

   const description = "Choice";
    
    function getHtml($field,$value='') {

        if($field['table']['name']) {
           $field['values'] = selectPlugin::_get_values($field);
        }
        $value = selectPlugin::_html_select(Plugin::prefix . $field['id'],$field['values'],$value);

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
        if($field['table']['name']) {
            $field['values'] = selectPlugin::_get_values($field);
        }
            
        $value = $field['values'][$value];

        return $value;
    }

    //
    // Private Helpers
      
    function _get_values($field) {
      
    // returns cached result

        $cached_values = "_VALUES_DB_" . $field['table']['name'];
        global $$cached_values;
        if($$cached_values) {
            return $$cached_values;
        }

        // Set arguments

        $table = $field['table']['name'];    
        $f_id    =  $field['table']['key'];
        $f_field =  $field['table']['field'];
        $f_order =  $field['table']['order'];
        $f_where =  $field['table']['where'];

        if(!$f_id) $f_id = 'id';
        if(!$f_order) $f_order = 'id';
        if($f_where) $WHERE = "WHERE $f_where";

        // Perform Query

        $sql = "SELECT * FROM $table $WHERE ORDER BY " . $f_order;
        $result = db_query($sql);
        //$values = array(''=>'');
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



