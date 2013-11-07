<?php
//
// MySQL Database wrapper
//


// connection & db selection :

try {
    $_db_link = mysql_connect(
        $_CONFIG['db']['host'],
        $_CONFIG['db']['user'],
        $_CONFIG['db']['pass']
    );
} catch (Exception $e) {
    db_error('mysql connection failed : ' . $e->getMessage());
}

$_db_selected = mysql_select_db(
    $_CONFIG['db']['base'],
    $_db_link
);

if (!$_db_selected) {
    db_error('database selection failed');
}


function db_query($sql) {
    if($query = mysql_query($sql)) {
    	return $query;
    } else {
    	db_error($sql);
    }
}

function db_fetch($query) {
    return mysql_fetch_array($query, MYSQL_ASSOC);
}

function db_get($sql) {
    $results = db_query($sql);
    $records = array();
    while($rec=db_fetch($results)) {
            $records[]=$rec;
    }
    return $records;
}

function db_insert_id() {
    return mysql_insert_id();
}

function db_num_rows($result) {
    return mysql_num_rows($result);    
}

// function db_num_fields($result) {
//     return mysql_num_fields($result);    
// }

function db_error($msg='') {
    global $_db_link;
    $mysql_error = '';
    if($_db_link) {
        $mysql_error = mysql_error($_db_link);
    }
    echo "<pre>DB ERROR: $mysql_error [$msg]</pre>";
}



