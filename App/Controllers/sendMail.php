<?php
    namespace Root\App\Controllers;
    class SendeMail{
        public static function send($NewTo,$NewSubject,$NewMessage){
            $from="sergemakasi098@gmail.com";
            $to      = $NewTo;
            $subject = $NewSubject;
            $message = $NewMessage;
            $headers = 'From: '.$from.'' . "\r\n" .
            'Reply-To: '.$from.'' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            if (mail($to, $subject, $message, $headers)) {
                return true;
            } else {
                return false;
            }
        }
    }
?>