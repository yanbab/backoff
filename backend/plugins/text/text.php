<?php
//
// Text Plugin
//

class textPlugin extends Plugin {
    
    const description = 'Text line';  
    

      
    function getHtml($field, $value) {
    	if(!$field['attributes']['size']) {
            $field['attributes']['size'] = 42;
        }
        return parent::getHtml($field,$value);
    }
  

}
