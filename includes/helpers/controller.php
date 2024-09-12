<?php

if (!function_exists('controller')){
   function controller($path='', $vars=null){
      if (!empty($path)){
         $file = config('controller.path').'/'.str_replace('.', '/', $path).'.php';
         if (file_exists($file)){
            include $file;
         } else {
            echo '<h1 style="text-align: center">Controller Not Found</h1>';
         }

      }
   }
}