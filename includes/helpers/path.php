<?php

if (!function_exists('base_path')){
   function base_path(string $path){
      return getcwd()."/../$path";
   }
}

if (!function_exists('public_path')){
   function public_path(string $path){
      return getcwd()."/$path";
   }
}

if (!function_exists('config')){
   function config(string $key){
      $config = explode('.', $key);

      if (count($config) > 0){
         $result = include base_path("config/$config[0].php");
         return $result[$config[1]];
      }
   }
}