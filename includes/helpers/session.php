<?php

if (!function_exists('session')){
   function session(string $key, mixed $value=null){
      if ($value){
         $_SESSION[$key] = encrypt($value);
      }
      return isset($_SESSION[$key]) ? decrypt($_SESSION[$key]) : '';
   }
}

if (!function_exists('session_has')){
   function session_has(string $key){
      return isset($_SESSION[$key]);
   }
}

if (!function_exists('session_flash')){
   function session_flash(string $key, mixed $value=null){
      $session = isset($_SESSION[$key]) ? decrypt($_SESSION[$key]) : '';
      session_forget($key);
      return $session;
   }
}

if (!function_exists('session_forget')){
   function session_forget(string $key){
      if (isset($_SESSION[$key])){
         unset($_SESSION[$key]);
      }
   }
}

if (!function_exists('session_destroy')){
   function session_destroy(){
      session_destroy();
   }
}