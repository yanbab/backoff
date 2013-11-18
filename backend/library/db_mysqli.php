<?php
//
// MySQL Database wrapper
//


// DB Connection
$_db_link = mysqli_connect(
    $_CONFIG['db']['host'],
    $_CONFIG['db']['user'],
    $_CONFIG['db']['pass'],
    $_CONFIG['db']['base']
);

if (mysqli_connect_errno($_db_link)) {
    db_error("Can't connect to database server {$_CONFIG['db']['host']}");
}

// Query
function db_query($sql) {
	global $_db_link;
    $query = mysqli_query($_db_link, $sql);

	if (mysqli_connect_errno($_db_link)) {
 	   db_error("Can't perform query");
	} else {
    	return $query;
	}
}

// Fetch a row from query
function db_fetch($query) {
    return mysqli_fetch_assoc($query);
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
    return mysqli_insert_id();
}

// Returns number of results returned by a query
function db_num_rows($result) {
    return mysqli_num_rows($result);    
}

// Error handling
function db_error($msg='') {
    global $_db_link;
    $mysql_error = '';
    if($_db_link && DEBUG) {
        $mysql_error = mysqli_error($_db_link);
    }
    if(!$_db_link) {
        $mysql_error = "No database connection";
    }
    echo "<pre>DB ERROR: $mysql_error [$msg]</pre>";
    if(!DEBUG) {
        die;
    }
}