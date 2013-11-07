<?php
//
// Password plugin
//

// FIXME : encryption support

class passwordPlugin extends Plugin {

    const description = 'Password';

    function prepForDisplay($field,$value) {
        $value = parent::prepForDisplay($field,$value);
        return '****';
        //return str_repeat('*',min(10,strlen($value)));
    }

}