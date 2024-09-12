<?php

if (!function_exists('set_locale')){
   function set_locale($lang){
      session('locale', $lang);
   }
}

if (!function_exists('trans')){
   function trans($key){
      $dirArray = explode('.', $key);
      $fileName = $dirArray[0];

      if (session_has('locale')){
         $lang = session('locale');
      } else {
         $lang = config('lang.default') ? config('lang.default') : config('lang.fallback');
      }

      $file = config('lang.path')."/$lang/$fileName.php";

      if (file_exists($file)){
         $result = include $file;
         return isset($result[end($dirArray)]) ? $result[end($dirArray)] : end($dirArray).' KEY';
      }
   }
}

