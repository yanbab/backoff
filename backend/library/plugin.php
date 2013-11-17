<?php
//
// Plugin Class
//
// some API ideas are stolen from 
// http://codeextinguisher.pbwiki.com/Creating-your-own-Plugins
//



// Helpers

function plugin_load($plugins) {
    if(!is_array($plugins)) {
        $plugins[] = $plugins;
    }
    foreach($plugins as $plugin) {
        require_once(PLUGINS_PATH . "$plugin/$plugin.php");
    }
}

function plugin_list() {
    if (is_dir(PLUGINS_PATH)) {
        if ($dh = opendir(PLUGINS_PATH)) {
            $list = array();
            while (($file = readdir($dh)) !== false) {
                if(substr($file,0,1)!='.' && is_dir(PLUGINS_PATH . "/$file")) {
                    $list[] = $file;
                }
            }
            closedir($dh);
        }
    }
    return $list;
}


// Main Class

class Plugin {

    const prefix = 'bo_'; // needs works in edit module

    const description = 'Base plugin';

    function getHtml($field,$value='') {

        $field['attributes']['value'] = htmlspecialchars($value);

        $field['attributes']['name'] = Plugin::prefix . $field['id'];
        $field['attributes']['id'] = Plugin::prefix . $field['id'];
        if($field['type']) {
            $field['attributes']['type'] = $field['type'];
        } else {
            $field['attributes']['type'] = 'text';
        }
        $value = '<input  ' . Plugin::_getAttrString($field['attributes']) . ' >';
        if($field['format_edit']) {
            $value = sprintf($field['format_edit'],$value,$value,$value);
        }
        return $value . $desc;
    }

    function getHtmlDescription($field, $value) {
        if($field['description']) {
            $desc = '<div><label class="description" for="' .Plugin::prefix .  $field[id] . '"> '  . $field['description'] . '</label></div>';
            return $desc;
        }
    }


    function prepForDisplay($field,$value='') {
        $value = htmlspecialchars($value);
        if($field['format']) {
            $value = sprintf($field['format'],$value,$value,$value,$value);
        }
        return $value;
    }

    function prepForDB($field,$value) {

        if(get_magic_quotes_gpc()) {
            $value = stripslashes( $value );
        }
        //check if this function exists
        if(function_exists("mysql_real_escape_string")) {
            $value = mysql_real_escape_string( $value );
        }
        else {
            //for PHP version < 4.3.0 use addslashes
            $value = addslashes( $value );
        }
        return $value;
    }

    //
    // Action Hooks
    //

    function onUpdate($field) {

    }

    function onDelete($field) {
    }



    //
    // Private Helpers
    //

    function _getAttrString($attr) {
        if(is_array($attr)) {
            foreach ($attr as $key => $value) {
                $str.= " $key=\"$value\" ";
            }
            return $str;
        }
    }

} /* End of Plugin Class */ 


