<?php

require LIBRARY_PATH . 'class.phpmailer.php';

class email {

    const native = false;

    function is_valid($email)   {
        return email_is_valid($email);
    }

    function send($options) {
        return email_send($options, self::native);
    }

}

function email_is_valid($str) {
    return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}

function email_send($options, $native = false) {
    
    // Usage :
    //
    // $options = array(
    //   'to' => 'yanbab@gmail.com',
    //   'to_name' => 'yanou',
    //   'from' => 'contact@villaperrotte.fr',
    //   'from_name' => 'Villa Perrotte',
    //   'subject' => 'test',
    //   'text' => 'bla bla text',
    //   'html' => 'bla bla <b>html</b>'
    // );
    //
    // email::send ($options);

    if($native || !class_exists('PHPMailer')) {

        // Use native mail() function

        $to = "{$options['to_name']} <{$options['to']}>";
        $subject = $options['subject'];
        $body = $options['text'];
        $headers = "From: {$options['from_name']} <{$options['from']}>\n";
        //$headers = $headers."MIME-Version: 1.0\n"; // ajout du champ de version MIME
        //$headers = $headers."Content-type: text/plain; charset=UTF-8\n"; // ajout du type d'encodage du corps
        return mail($to, $subject, $body, $headers);
    
    } else {
    
        // use PHPMailer library

        $mail = new PHPMailer();
        $mail->CharSet = 'utf-8';
        $mail->SetFrom($options['from'], $options['from_name']);
        $mail->AddReplyTo($options['from'],$options['from_name']);
        $mail->AddAddress($options['to'], $options['to_name']);
        $mail->Subject = $options['subject'];
        $mail->AltBody = $options['text'];
        $mail->MsgHTML($options['html']);
        //$mail->AddAttachment($options['file']);
        if(!$mail->Send()) {
          //echo "Mailer Error: " . $mail->ErrorInfo;
          return false;
        } else {
          return true;
        }

    }
}

