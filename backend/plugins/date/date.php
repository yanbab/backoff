<?php
//
// Date plugin
//

class datePlugin extends Plugin {

  const description = "Date picker";

  function getHtml($field,$value='') {

    global $init_date_js, $_CONFIG;

    $field['type'] = '';
    $field['attributes']['size'] = '10';
    
    if(!$init_date_js) {
      // Include JS & CSS files
      $html .= '<script type="text/javascript" src="' . url_base() . 'plugins/date/datepicker/jquery-ui-datepicker-1.5.2.min.js"></script>';
      if(file_exists('plugins/date/datepicker/lang/ui.datepicker-' . $_CONFIG['lang'] . '.js')) {
          // Localisation
          $html .= '<script type="text/javascript" src="' . url_base() . 'plugins/date/datepicker/lang/ui.datepicker-' . $_CONFIG['lang'] . '.js"></script>';
      }
      $html .= '<link rel="stylesheet" href="' . url_base() . 'plugins/date/datepicker/jquery-ui-datepicker-1.5.2.css"  type="text/css" media="screen" />';
      $init_date_js = true;
    }
     
     if($value=='0000-00-00 00:00:00' or $value =='0000-00-00') {
        $value='';
     }
     
    $value = substr($value,0,10);

    
    
    $html .= parent::getHtml($field,$value);
    $image = url_base() . 'plugins/date/date.png';
    $f = Plugin::prefix . $field[id];
    $html.= "
      <script type=\"text/javascript\">
        $(function() {
          $('#$f').datepicker({
            dateFormat: 'yy-mm-dd', 
            showOn: 'both', 
            showAnim: 'fadeIn',
            speed: 'fast', 
            buttonImage:'$image', 
            buttonImageOnly: true ,
            
            changeMonth: false,
            changeYear: false
          });
        });
      </script>
    ";
    return $html;
  }
  
  function prepForDisplay($field,$value) {
    $value = parent::prepForDisplay($field,$value);
    if($value=='0000-00-00 00:00:00' or $value =='0000-00-00') {
        return '-';
     }
    return   date("d M. Y",strtotime($value));
  }

}
