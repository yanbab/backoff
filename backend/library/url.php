<?php
//
// URL & Routing function
// helper for http://mysite.com/index.php/module/action/item url styles
//
// You can remove 'index.php' with a .htaccess like this one :
//
//  RewriteEngine on
//  RewriteCond $1 !^(index\.php|images|robots\.txt)
//  RewriteRule ^(.*)$ /index.php/$1 [L]
//
// In the above example, any HTTP request other than those for index.php, 
// images, and robots.txt is treated as a request for your index.php file.
//
// Another example :
//  RewriteEngine On
//  RewriteCond %{REQUEST_FILENAME} !-f
//  RewriteCond %{REQUEST_FILENAME} !-d
//  RewriteRule . index.php
//
//


function url_site($segments='') {

	// Returns your site URL
	// Segments can be optionally passed to the function as a string or an array.
	// Here is a string example:
	//  echo url_site("news/local/123");
	// The above example would return something like:
	//  http://www.your-site.com/index.php/news/local/123

	global $_CONFIG;

	$url = url_base();
	if($_CONFIG['site']['index_page']) {
		$url .= $_CONFIG['site']['index_page'] . '/';
	}
	$url .=  ltrim($segments,'/');
	return $url;
	
}

function url_base() {

	// Returns your site base URL, example :
	//  echo url_base();
	// The above example would return something like:
	//  http://www.your-site.com/
	//  or /

	$url =  dirname($_SERVER['SCRIPT_NAME']) . '/';
	return $url;

}


function url_segment($n) {

	// Permits you to retrieve a specific segment of the current url. 
	// Where n is the segment number you wish to retrieve. 
	// Segments are numbered from left to right. 
	// For example, if your full URL is this:
	//  http://www.your-site.com/index.php/news/local/metro/crime_is_up
	// The segment numbers would be this:
	//  1. news
	//  2. local
	//  3. metro
	//  4. crime_is_up
	// the function returns FALSE (boolean) if the segment does not exist.

	$segments = explode('/',$_SERVER['PATH_INFO']);
	return $segments[$n];

}


function url_redirect($segments='') {
	
	// Does a "header redirect" to the local URI specified. 
	// Segments can be optionally passed to the function as a string or an array.

	$location = url_site($segments);
	header("Location: $location");
  
}


