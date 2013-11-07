<?php
//
// File api
//

$path = './';
if(isset($_GET['path'])) {
	$path = $_GET['path'];
}

class vfs {

	var $mime = array (
		'txt' => 'text/plain',
		'php' => 'text/php',
		'xml' => 'text/xml',
		'sql' => 'text/sql',
		'html'=> 'text/html',
		'css' => 'text/css',
		'js'  => 'text/js',
		'jpg' => 'image/jpeg',
		'jpeg' => 'image/jpeg',
		'gif' => 'image/gif',
		'png' => 'image/png',
		'avi' => 'video/avi',
	);

	function ls($path) {
		if (is_dir($path)) {
		    if ($dh = opendir($path)) {
		    	$f = array();
		        while (($file = readdir($dh)) !== false) {
		        	if($file == '.' || $file == '..') {
		        		// 	
		        	} else {
			            $f[] = self::info($path,$file);
			        }
		        }
		        closedir($dh);
		        return $f;
		    } else {
		    	return false;
		    }
		} else {
			return false;
		}
	}

	function info($path = './', $file = '') {
		$info = array (
        	"name" => $file,
        	"path" => $path,
        	"size" => filesize($path . $file),
        	"date" => filemtime($path . $file),
        	"type" => filetype($path . $file),
        	"hidden" => (substr($file, 0, 1) == '.') ? true : false
        );
		return $info;
	}

}

echo json_encode(vfs::ls($path));