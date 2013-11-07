<?php
//
// Number Plugin
//
require_once(PLUGINS_PATH . 'text/text.php');

class numberPlugin extends textPlugin {
        const description = 'Number';
    function getHtml($field, $value) {
        if(!$field['attributes']['size']) {
            $field['attributes']['size'] = 5;
        }
        if(!$field['rules']) {
            $field['rules'] = 'numeric';
        }
        
	    $field['type'] = 'text';
        return parent::getHtml($field,$value);
    }
  

}
