<?php

if (!function_exists('sendMail')){
   function sendMail(array $mails, string $subject, string $message):bool{
      if (config('mail.protocol') == 'smtp'){
         ini_set('SMTP', config('mail.smtp_domain'));
         ini_set('smtp_port', config('mail.smtp_port'));
      }

      $headers = "MIME-Version: 1.0\r\n";
      $headers .= "Content-type: text/html;charset=UTF-8\r\n";
      $headers .= "From: ".config("mail.from_address")."\r\n";

      return mail($mails[0], $subject, $message, $headers);
   }
}

// var_dump(sendMail(['php2@mail.com'], 'test message 2', '<h1>Hello From Test2</h1>'));