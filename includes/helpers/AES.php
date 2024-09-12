<?php

if (!function_exists('encrypt')){
   function encrypt($value){
      $cipher = config('session.encrypt_mode');
      $key = config('session.encrypt_key');
      $ivlen = openssl_cipher_iv_length($cipher);
      $iv = openssl_random_pseudo_bytes($ivlen);
      $ciphertext_row = openssl_encrypt($value, $cipher, $key, OPENSSL_RAW_DATA, $iv);
      $hmac = hash_hmac('sha256', $ciphertext_row, $key, true);
      $ciphertext = base64_encode($iv.$hmac.$ciphertext_row);
      return $ciphertext;
   }
}

if (!function_exists('decrypt')){
   function decrypt($ciphertext){
      $cipher = config('session.encrypt_mode');
      $key = config('session.encrypt_key');
      $convert = base64_decode($ciphertext);
      $ivlen = openssl_cipher_iv_length($cipher);
      $iv = substr($convert, 0, $ivlen);
      $hmac = substr($convert, $ivlen, 32);
      $ciphertext_row = substr($convert, $ivlen+32);
      $original_text = openssl_decrypt($ciphertext_row, $cipher, $key, OPENSSL_RAW_DATA, $iv);
      $calcmac = hash_hmac('sha256', $ciphertext_row, $key, true);

      if (hash_equals($hmac, $calcmac)){
         return $original_text;
      }
   }
}