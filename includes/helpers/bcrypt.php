<?php

if (!function_exists('bcrypt')){
   function bcrypt($password){
      return password_hash($password, PASSWORD_BCRYPT);
   }
}

if (!function_exists('hash_check')){
   function hash_check($password, $hash){
      return password_verify($password, $hash);
   }
}