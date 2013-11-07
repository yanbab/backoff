<?php
//
// Simple newsletter module
//


function email_is_valid($str)   {
    return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}

function email_subscribe($email) {
    $exists = mysql_fetch_assoc(mysql_query("SELECT * FROM newsletter_emails WHERE email = '$email'"));
    if ($exists) {
        // subscribe again
        mysql_query("UPDATE newsletter_emails SET active = '1' WHERE email = '$email'");
    } else {
        // insert
        mysql_query("INSERT INTO newsletter_emails (email,date,active) VALUES ('$email', NOW(), 1)");
    }
}

function email_unsubscribe($email) {
    mysql_query("UPDATE newsletter_emails SET active = '0' WHERE email = '$email'");
}

$state = '';
if(isset($_POST['action'])) {
  switch ($_POST['action']) {

      case ('unsubscribe') :
          email_unsubscribe($_POST['email']);
          $state = 'unsubscribe_ok';
      break;

      case ('subscribe') :
          if(email_is_valid($_POST['email'])) {
            email_subscribe($_POST['email']);
            $state = 'subscribe_ok';
          } else {
            $state = 'subscribe_fail';    
          }
      break;

  }
}

if(isset($_GET['view'])) {
  $view =  db_get("SELECT * FROM newsletter_letters WHERE id = '$path[3]'");
  echo $view[0]['body_html'];
  exit();
}


$lettres =  db_get("SELECT newsletter_letters.* FROM newsletter_campains , newsletter_letters WHERE newsletter_letters.id = newsletter_campains.id_letter  ORDER BY id DESC");
