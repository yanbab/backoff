<?php
//
// Number Plugin
//
require_once(PLUGINS_PATH . 'select/select.php');

class orderPlugin extends selectPlugin {
        const description = 'Order';
        
        
    function getHtml($field, $value) {
        global $table;
        
        $field['table']['name'] = $table;
        $field['table']['key'] = $field['key'];
        $f_field =  $field['table']['field']= 'title';
        $f_order =  $field['table']['order'] = $field['id'];

        return parent::getHtml($field,$value);
    }
    
    function _get_values($field) {
        $values = parent::_get_values($field);

        foreach($values as $key => $value) {
            $values[$key] = lang('after') . ' g ' . $value;
        }echo"k";
        return $values;
    }
  

}
