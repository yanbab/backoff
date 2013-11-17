<?php
//
// MySQL Database wrapper
//


// DB Connection
$_db_link = mysql_connect(
    $_CONFIG['db']['host'],
    $_CONFIG['db']['user'],
    $_CONFIG['db']['pass']
);
if(!$_db_link) {
    db_error("Can't connect to database server {$_CONFIG['db']['host']}");
}

// DB Selection
$_db_selected = mysql_select_db(
    $_CONFIG['db']['base'],
    $_db_link
);
if (!$_db_selected) {
    db_error("Can't select database '{$_CONFIG['db']['base']}', check your database configuration");
}

// Query
function db_query($sql) {
    if($query = mysql_query($sql)) {
    	return $query;
    } else {
    	db_error("Can't perform query : $sql");
    }
}

// Fetch a row from query
function db_fetch($query) {
    return mysql_fetch_array($query, MYSQL_ASSOC);
}

// Fetch all rows from query
function db_get($sql) {
    $results = db_query($sql);
    $records = array();
    while($rec=db_fetch($results)) {
            $records[]=$rec;
    }
    return $records;
}

// Returns last inserted id
function db_insert_id() {
    return mysql_insert_id();
}

// Returns number of results returned by a query
function db_num_rows($result) {
    return mysql_num_rows($result);    
}

// Error handling
function db_error($msg='') {
    global $_db_link;
    $mysql_error = '';
    if($_db_link && DEBUG) {
        $mysql_error = mysql_error($_db_link);
    }
    if(!$_db_link) {
        $mysql_error = "No database connection";
    }
    echo "<pre>DB ERROR: $mysql_error [$msg]</pre>";
    if(!DEBUG) {
        die;
    }
}