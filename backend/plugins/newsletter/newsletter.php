<?php
//
// Newsletter plugin
//
//
// Schema definition :
//
// 
require_once(PLUGINS_PATH . 'checkbox/checkbox.php');


class newsletterPlugin extends checkboxPlugin {

    const description = "Newsletter";  
  
  
   function preUpdateHook($field,$value) {

    // Construct message : 
    $id_letter = $_POST[ Plugin::prefix . 'id_letter' ];
    $table_letters = $field['options']['table_letters'];

    $letter = db_fetch(db_query("SELECT * FROM $table_letters WHERE id = '$id_letter'"));

    require_once("swift-mailer/lib/swift_required.php");
    $transport = Swift_MailTransport::newInstance();
    $mailer = Swift_Mailer::newInstance($transport);


    // Looping through emails :
    $table = $field['options']['table_emails'];
    $emails = db_get("SELECT * FROM $table WHERE active='1'");
    foreach($emails as $email) {
      $message = Swift_Message::newInstance()
        ->setTo($email['email'])
        ->setSubject($letter['subject'])
        ->setBody($letter['body_html'], 'text/html')
        ->addPart($letter['body_text'], 'text/plain')
        ->setFrom(array($letter['from_email'] => $letter['from_name']))
      ;
      $result = $mailer->send($message);
      ++$cpt;
      
    }
    $_POST[ Plugin::prefix . 'sent' ] = $cpt;
    
    
    
  }
 
    function getHtml($field,$value='') {

	    $field['type'] = 'checkbox';
        $html = "<script></script>";
      return checkboxPlugin::getHtml($field) . $html;

    }
/*  
  function prepForDisplay($field,$value='') {   
        return parent::prepForDisplay($field, $value);
  }

*/
}

