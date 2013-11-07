<?php
require_once LIBRARY_PATH . 'paging.php';

$page = url_segment(2);
$action= url_segment(3);

$schema = $_SCHEMA['pages'][$page];
$table = $_SCHEMA['pages'][$page]['table'];
$fields = $_SCHEMA['pages'][$page]['fields'];

// store field names in an array
$fields_names = array();
foreach ($fields as $fieldname => $field) {
    if($field['id']) {
        $fieldname = $field['id'];
    }
    $fields_names[] = $fieldname;
}

// 404 if no schema
if(!$_SCHEMA['pages'][$page]) {
  url_redirect('/404/');
}

//
// Construct query
//

$SELECT = '';
$SELECT_sep = '';
foreach ($fields_names as $fieldname) {
    $SELECT .= $SELECT_sep . $fieldname;
    $SELECT_sep = ', ';
}
$SELECT = '*';

$query = "SELECT $SELECT FROM `$table` ";
$WHERE = " WHERE 1 ";

//
// SEARCH
//

if (isset( $_GET['search'] )) {
  $search = $_GET['search'];
  $WHERE .= " AND ( ";
  foreach ($fields_names as $fieldname) {
      $WHERE .= "$WHERE_sep `$fieldname` LIKE '%$search%'";
      $WHERE_sep = " OR ";
  }
  $WHERE .= " OR id='$search') ";
}

//
// Advanced search
//

$operators = array (
    '%like%' => 'contains',
    '%notlike%' => 'do not contains',
    '=' =>  'equal',
    '!=' => 'different',
    'like%' => 'begin with',
    'notlike%' => 'do not begin with',
    '%like' => 'end with',
    '%notlike' => 'do not end with',
    '<' => 'is lesser than',
    '>' => 'is greater than',
);

if (isset( $_GET['adv_search'] )) {
    $adv_search = $_GET['adv_search'];
    foreach ($adv_search['id'] as $cur_id => $cur_value) {
        $f_id = $adv_search['id'][$cur_id];
        $f_operator = $adv_search['operator'][$cur_id];
        $f_value = $adv_search['value'][$cur_id];
        $f_operation = 'AND';
        switch($f_operator) {
            case '%like%':
                $WHERE .= " $f_operation `$f_id` LIKE '%$f_value%'";
                break;
            case '%notlike%':
                $WHERE .= " $f_operation `$f_id` NOT LIKE '%$f_value%'";
                break;
            case 'like%':
                $WHERE .= " $f_operation `$f_id` LIKE '$f_value%'";
            case 'notlike%':
                $WHERE .= " $f_operation `$f_id` NOT LIKE '$f_value%'";
                break;
            case '%like':
                $WHERE .= " $f_operation `$f_id` LIKE '%$f_value'";
                break;
            case '%notlike':
                $WHERE .= " $f_operation `$f_id` NOT LIKE '%$f_value'";
                break;
            default:
                $WHERE .= " $f_operation `$f_id` $f_operator '$f_value'";
                break;
        }
    }
}

//
// WHERE clause
//

if(isset($schema['where'])) {
  $WHERE .= " AND " . $schema['where'];
}

//
// ORDER clause
//

if(isset($_GET['order'])) {
    $ORDER =  " ORDER BY `$_GET[order]`";
    if($_GET['direction']) {
        $ORDER .= " $_GET[direction] ";
    }
} elseif($_SCHEMA['pages'][$page]['order']) {
        //$ORDER = " ORDER BY `$_SCHEMA[pages][$page][order]`";
        $ORDER = " ORDER BY `" . $_SCHEMA['pages'][$page]['order'] . "`";
}

//
// PAGING & LIMIT clause
//

$cur_page=1;
if(isset($_GET['page'])) {
  $cur_page = $_GET['page'];
};

($_CONFIG['results']) ?  $per_page = $_CONFIG['results'] : $per_page = 10;

$query = db_query ("SELECT $SELECT FROM $table $WHERE");
$total = db_num_rows($query);
$htmlPager = paging(url_site("/list/$page/?search=$_GET[search]&order=$_GET[order]&direction=$_GET[direction]&query=$_GET[query]&page="),$total,$per_page,$cur_page);
$start = $per_page * ($cur_page -1) + 1;
$end = min($per_page * ($cur_page) ,$total);

$limit_start = ($cur_page - 1) * $per_page;
$limit_end =  $per_page ;
$LIMIT = " LIMIT $limit_start, $limit_end";


//
// Remember order, search & page
//

$args = array ('search', 'order','direction','page') ;
$arg_separator = '?';
foreach ($args as $arg) {
  $url_append .= $arg_separator . $arg . '=' . $_GET[$arg]; 
  $arg_separator = '&';
}
$url_append = "?search=$_GET[search]&order=$_GET[order]&direction=$_GET[direction]&page=$_GET[page]";

//
// Action
//
   
if($action) {
    $records = array();
    if($_POST['select_all_search']) {
      $query = db_query ("SELECT id FROM `$table` $WHERE $ORDER");
      
      
      
      while($result = db_fetch($query)) {
        $records[] = $result[id];
      }
    } else if(is_array($_POST['checked_id'])) {
      $records = $_POST['checked_id'];
    }

  include "modules/actions/$action.php";
  
}

//
// VIEW results
//

$query = db_query ("SELECT $SELECT FROM `$table` $WHERE $ORDER $LIMIT");
if($query) {
  $lines = array();
  while($result = db_fetch($query)) {
    $lines[] = $result;
  }
} else {
  $error = db_error();
}

