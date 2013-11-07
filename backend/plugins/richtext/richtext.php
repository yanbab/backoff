<?php
//
// Richtext Editor
// Uses FCKEditor
//

include_once(PLUGINS_PATH . "richtext/fckeditor/fckeditor.php");

class richtextPlugin extends Plugin {

    const description = "Rich text";  

    function getHtml($field,$value='') {
        global $_CONFIG;

        if($field['description']) {
          //  $desc= '<label class="description" for="' . $field[id] . '"> '  . $field['description'] . '</label>';
        }

	
        $oFCKeditor = new FCKeditor(Plugin::prefix . $field['id']);
        $oFCKeditor->Config['CustomConfigurationsPath'] = url_base() . 'plugins/richtext/richtext.config.php' ;
        $oFCKeditor->BasePath = url_base() .PLUGINS_PATH . "richtext/fckeditor/";


        // Some config 

        $oFCKeditor->Config['EnterMode'] = 'br';
        $oFCKeditor->Config['ShiftEnterMode'] = 'p';
        $oFCKeditor->Config['BaseHref'] = "http://" . $_SERVER['SERVER_NAME'] . url_base(). SITE_PATH ;

        // CSS
        if(!$field['options']['css']) $field['options']['css'] =  'plugins/richtext/richtext.css';
        $oFCKeditor->Config['EditorAreaCSS'] = url_base() . $field['options']['css']  ;
        // Body Id & Class
        $oFCKeditor->Config['BodyId'] = $field['options']['body_id'];
        $oFCKeditor->Config['BodyClass'] = $field['options']['body_class'];


  //      $oFCKeditor->Config['UserFilesPath'] = url_base() . SITE_PATH .  "documents/";
        // Language
        $oFCKeditor->Config['AutoDetectLanguage'] =  "false";
        $oFCKeditor->Config['DefaultLanguage'] =  $_CONFIG[lang];

        $oFCKeditor->Value =  $value;

        if(!$field['options']['width']) $field['options']['width'] = '100%';
        if(!$field['options']['height']) $field['options']['height'] = 400;
        $oFCKeditor->Width  = $field['options']['width'] ;
        $oFCKeditor->Height = $field['options']['height'] ;
        $html = $oFCKeditor->CreateHTML();
        return $html . '<br>' .  $desc;

    }


    function prepForDisplay($field,$value='') {

        //return richtextPlugin::prepForDisplayIframe($field, $value);
        if($field['format']) {
            $value = sprintf($field['format'],$value,$value,$value);
        }
        // FIXME : returns an iFrame 
        $value = '<div style="overflow:auto; max-height : 150px;min-width: 200px;">' . $value . '</div>';
        return $value;
    }
    
    function prepForDisplayIframe($field,$value='') {

        if($field['format']) {
            $value = sprintf($field['format'],$value,$value,$value);
        }
        // FIXME : returns an iFrame 
        $value = '<div style="overflow:auto; max-height : 150px;min-width: 200px;">' . $value . '</div>';
        
        $url_table = $field['record']['table'];
        $url_id = $field['record']['id'];
        $url_field = $field['id'];
        $url = url_base() . "plugins/richtext/richtext_iframe.php?table=$url_table&field=$url_field&id=$url_id";

        $value = '
            <iframe
                style="width:100%; height:150px; border:0px; background:url(<?=url_base()?>modules/iframe/loading.gif) ;" 
                src="' . $url . '" />
        ';
        
        return $value;
    }
}
