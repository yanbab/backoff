<?php
class textareaPlugin extends Plugin {
    
    const description = 'Text';  
   
  function getHtml($field,$value='') {

    // FIXME : replace <div> by  <Label>
    if(!$field['attributes']['rows']) {
      $field['attributes']['rows'] = 8;
    }
    if(!$field['attributes']['cols']) {
      $field['attributes']['cols'] = 40;
    }
    return '<textarea name="' . Plugin::prefix . $field['id'] . '" id="' . $field['id']  . '" ' . parent::_getAttrString($field['attributes']) . ' >' .  htmlspecialchars( $value) . '</textarea>' . $desc;
    
  }
  
  
  function prepForDisplay($field,$value='') {

    $value = nl2br( htmlspecialchars($value));
    if($field['format']) $value = sprintf($field['format'],$value,$value,$value);
    return "<div style=\"max-height : 150px;overflow : auto;\">$value</div>";
  }
  
  
  
}

