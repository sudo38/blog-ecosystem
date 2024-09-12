<?php

if (!function_exists('request')){
   function request($request){
      if (isset($_REQUEST[$request])){
         return $_REQUEST[$request];
      } elseif (isset($_FILES[$request])){
         return $_FILES[$request];
      }
   }
}