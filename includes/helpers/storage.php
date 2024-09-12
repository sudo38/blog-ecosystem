<?php

if (!function_exists('storage')){
   function storage($path){
      if (file_exists($path)) {
         header('Content-Description: file from server');
         header('Content-Type: attachment; filename='.dirname($path));
         header('Expiers: 0');
         header('Cache-Control: must-revalidate');
         header('Pragma: public');
         header('Content-length: '.filesize($path));
         readfile($path);
      }
      exit();
   }
}

if (!function_exists('storage_url')){
   function storage_url($path){
      return url('storage'.$path);
   }
}

if (!function_exists('remove_folder')){
   function remove_folder($path){
      if (file_exists($path)) {
         return rmdir($path);
      }
   }
}

if (!function_exists('store_file')){
   function store_file($from, $to){
      if (isset($from['tmp_name'])){
         $to = '/'.ltrim($to, '/');
         $path = config('files.upload').$to;
         $exp = explode('/', $path);
         $fileName = end($exp);
         $pathWithoutFileName = str_replace($fileName, '', $path);
         if (!file_exists($pathWithoutFileName)){
            mkdir($pathWithoutFileName, 0777, true);
         }
         move_uploaded_file($from['tmp_name'], $path);
         return $to;
      }
   }
}

if (!function_exists('file_extension')){
   function file_extension($file){
      if (!empty($file['name'])){
         $fileNameExt = explode('.', $file['name']);
         $fileNameExt = end($fileNameExt);
         //$newFileName = uniqid().'.'.$fileNameExt;
         $newFileName = $file['name'];
         return $newFileName;
      }
   }
}