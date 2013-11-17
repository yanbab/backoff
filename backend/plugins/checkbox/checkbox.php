<?php
//
// Checkbox plugin
//

class checkboxPlugin extends Plugin {

    const description = "Checkbox";  

    function getHtml($field,$value='') {
	    if($value) {
		    $field['attributes']['checked'] = 'checked';
	    }
	    $field['attributes']['type'] = 'checkbox';
	    $field['attributes']['name']  = $field['id'];
	    $field['attributes']['style']  .= 'float:left;margin-right : 6px;';
	    $value  = 'on';
      return parent::getHtml($field, $value);
  }
  
  function prepForDisplay($field,$value='') {   
    if($value=='1') {
    	$value = '<div class="checked">&#10004;</div>';
    }
    else {
    	$value = '<div class="unchecked">-</div>';
    }
    return '<div style="text-align:center;">' . $value. '</div>';
  }

  function prepForDB($field,$value) {
		if($value=='on') {
			return '1';
		} else {
			return '0';
		}
  }

}

