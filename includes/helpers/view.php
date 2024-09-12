<?php

if (!function_exists('view')){
   function view($path, $vars=null){
      $file = config('view.path').'/'.str_replace('.', '/', $path).'.php';
      if (file_exists($file)){
         $view = $file;
         view_engine($view, $vars);
      } else {
         echo '<h1 style="text-align: center">View Not Found</h1>';
      }
   }
}

if (!function_exists('extend')){
   function extend($path){
      $file_origin = config('view.path').'/'.str_replace('.', '/', $path).'.php';
      if (file_exists($file_origin)){
         $file_name = md5($file_origin).'.php';
         $file = base_path('storage/views/'.$file_name);
         view_engine($file_origin, null, true);
         return $file;
      } else {
         echo '<h1 style="text-align: center">View Not Found</h1>';
      }
   }
}


if (!function_exists('view_engine')){
   function view_engine($view, $vars=null, $extend=false){
      if(is_array($vars)){
         foreach ($vars as $key => $value) {
            ${$key} = $value;
         }
      }

      $file_name = md5($view).'.php';
      $to_storage = base_path('storage/views/'.$file_name);
         $file_view = file_get_contents($view);
         if ($file_view === false) {
            echo '<h1 style="text-align: center">Error loading view file</h1>';
            return;
         }
   
         $file_view = str_replace('{{', '<?=', $file_view);
         $file_view = str_replace('}}', '?>', $file_view);
         
         $file_view = str_replace('@php', '<?php', $file_view);
         $file_view = str_replace('@endphp', '?>', $file_view);
   
         $file_view = preg_replace('/@section\((.*\)*)\)/i', '<?= ${$1} ?>', $file_view);
         $file_view = preg_replace('/@invalid\((.*\)*)\)/i', '<?= invalid($1) ?>', $file_view);
         $file_view = preg_replace('/@include\((.*\)*)\)/i', '<?php view($1) ?>', $file_view);
         $file_view = preg_replace('/@extends\((.*\)*)\)/i', '<?php include extend($1) ?>', $file_view);
         $file_view = preg_replace('/@start\((.*\)*)\)/i', '<?php ob_start(); ?>', $file_view);
         $file_view = preg_replace('/@end\((.*\)*)\)/i', '<?php ${$1} = ob_get_clean(); ?>', $file_view);
         $file_view = preg_replace('/@error\((.*\)*)\)/i', '<?php if(${$1}): ?>', $file_view);
         $file_view = preg_replace('/@title\((.*\)*)\)/i', '<script> get_title($1) </script>', $file_view);
         $file_view = preg_replace('/@link\((.*\)*)\)/i', '<script> get_link($1) </script>', $file_view);
         $file_view = preg_replace('/@script\((.*\)*)\)/i', '<script> get_script($1) </script>', $file_view);
         $file_view = preg_replace('/<!-- (.*\)*) -->/i', '<?php // $1 ?>', $file_view);
         $file_view = preg_replace('/@enderror/i', '<?php endif ?>', $file_view);
         $file_view = preg_replace('/@if\((.*\)*)\)+/i', '<?php if($1): ?>', $file_view);
         $file_view = preg_replace('/@elseif\((.*\)*)\)+/i', '<?php elseif($1): ?>', $file_view);
         $file_view = preg_replace('/@else/i', '<?php else: ?>', $file_view);
         $file_view = preg_replace('/@endif/i', '<?php endif ?>', $file_view);
         $file_view = preg_replace('/@foreach\((.*?) as (.*?)\)+/i', '<?php foreach($1 as $2): ?>', $file_view);
         $file_view = preg_replace('/@endforeach/i', '<?php endforeach ?>', $file_view);
         
         file_put_contents($to_storage, $file_view);
      if($extend){
         return $to_storage;
      }else{
         include $to_storage;
      }
   }
}