<?php
//
// Database wrapper
//

if( ! $_CONFIG['db']['type']) {
    $_CONFIG['db']['type'] = 'mysql';
}

require LIBRARY_PATH . 'db_' . $_CONFIG['db']['type'] . '.php';

