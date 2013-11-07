<?php
//
// Number Plugin
//

require_once(PLUGINS_PATH . 'text/text.php');

class percentPlugin extends textPlugin {
    
    const description = 'Number';
    
    function getHtml($field, $value) {
        if(!$field['attributes']['size']) {
            $field['attributes']['size'] = 5;
        }
        if(!$field['rules']) {
            $field['rules'] = 'numeric';
        }
        
	    $field['type'] = 'text';
        return parent::getHtml($field,$value) . ' %';
    }
  
  function prepForDisplay($field,$value='') {   
    return "<div style=\"width:100px;border:solid black 1px;float:left;\"><div style=\"width:$value%;background:black;color:grey;\">&nbsp;</div></div>&nbsp;$value&nbsp;%";
  }

}
