<?php

if (!function_exists('view_image')){
    function view_image($url){
      view('action.view_image', ['image' => $url]);
    }
}

if (!function_exists('delete_record')){
   function delete_record($url){
       view('action.delete_record', ['url' => $url]);
   }
}

if (!function_exists('delete_file')){
   function delete_file($path){
      $path = config('file.upload').$path;
      if (file_exists($path)) {
         return unlink($path);
      }
   }
}