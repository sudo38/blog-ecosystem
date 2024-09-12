<?php

if (!function_exists('auth')){
   function auth($role){
      if (session_has($role)){
         return json_decode(session($role));
      }
   }
}

if (!function_exists('logout')){
   function logout($role){
      session_forget($role);
   }
}