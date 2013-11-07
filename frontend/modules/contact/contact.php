<?php
//
// Simple contact form module
//

require (LIBRARY_PATH . 'mail.php');

if(isset($_POST['contact'])) {

    // form validation
    $error_message = '';
	if(!$_POST['message']) { 
		$error_message = "empty message";
	}	
	if(!email::is_valid($_POST['email'])) {
		$error_message = "invalid email";
	} 	
	if(!$_POST['nom']) { 
		$error_message = "enter your name";
	}

    // validation ok, send email        
	if(!$error_message ){
        $options = array(
            'to'        => $_CONFIG['email_from'],
            'to_name'   => $_CONFIG['email_from_name'],
            'from'      => $_POST['email'],
            'from_name' => $_POST['nom'],
            'subject'   => '[contact ' . $config['site_title'] . ']' . $_POST['nom'] ,
            'html'      => stripslashes(str_replace("\n","<br />\n",$_POST['message'])),
            'text'      => stripslashes($_POST['message'])
        );

        email::send($options);

        // record in db
    	$from    = "$_POST[nom] <$_POST[email]>\r\n";
    	$to      = $_CONFIG['email_from'];
    	$subject = "Contact site web";
    	$message = mysql_real_escape_string(stripslashes($_POST['message']));
		db_query("INSERT INTO contacts (`from`,`to`,`subject`, `message`, `date`) VALUES ('$from','$to','$subject','$message', NOW())");
		$form_ok = true;
	}
    
}

