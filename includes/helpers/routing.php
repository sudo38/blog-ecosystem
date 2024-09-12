<?php

define('DASH', 'dash');
$routes = [];

if (!function_exists('segment')){
   function segment(){
      $segment = ltrim($_SERVER['REQUEST_URI'], '/');
      $clean_segment = explode('?', $segment)[0];
      return !empty($clean_segment) ? $clean_segment : null;
   }
}

if (!function_exists('route_get')){
   function route_get($segment, $view=null){
      global $routes;

      if(!in_array($segment, ['/', ''])){
         $segment = '/'.ltrim($segment, '/');
      }
      $segment = preg_replace('/\{([a-zA-Z0-9_-]+)\}/', '([a-zA-Z0-9_-]+)', $segment);

      $routes['GET'][] = [
         'segment' => $segment,
         'view' => $view
      ];
   }
}


if (!function_exists('route_post')){
   function route_post($segment, $view=null){
      global $routes;

      if(!in_array($segment, ['/', ''])){
         $segment = '/'.ltrim($segment, '/');
      }
      $segment = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_]+)', $segment);

      $routes['POST'][] = [
         'segment' => $segment,
         'view' => $view
      ];
   }
}

if (!function_exists('get')){
   function get($segment, $view=null){
      return [
         'funcName' => 'route_get',
         'funcArgs' => func_get_args()
      ];
   }
}

if (!function_exists('post')){
   function post($segment, $view=null){
      return [
         'funcName' => 'route_post',
         'funcArgs' => func_get_args()
      ];
   }
}

if (!function_exists('run')){
   function run(){
      global $routes;

      $GET_ROUTES = isset($routes['GET']) ? $routes['GET'] : [];
      $POST_ROUTES = isset($routes['POST']) ? $routes['POST'] : [];

      $page_found = false;
      foreach($GET_ROUTES as $GET_ROUTE){
         if (preg_match('#^'.$GET_ROUTE['segment'].'$#', '/'.segment(), $matches)) {
            array_shift($matches);
            controller($GET_ROUTE['view'], $matches);
            $page_found = true;
            break;
         }
      }
      
      if (!$page_found){
         $page_found = false;
         $page_view = null;

         foreach($POST_ROUTES as $POST_ROUTE){
            if (preg_match('#^'.$POST_ROUTE['segment'].'$#', '/'.segment(), $matches)) {
               array_shift($matches);
               $page_view = $POST_ROUTE['view'];
               $page_found = true;
               break;
            }
         }

         if (!$page_found){
            header('HTTP/1.1 404 Not Found');
            view('errors.404');
            exit();

         } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            controller($page_view);

         } else {
            header('HTTP/1.1 405 Method Not Allowed');
            header('Allow: POST');
            view('errors.405');
            exit();
         }
      }
   }
}


if (!function_exists('route_group')){
   function route_group($params, $methods) {
      $prefix = $params['prefix'];
      foreach ($methods as $method){
         $a = explode('/', $method['funcArgs'][0]);

         $arg1 = $prefix.'/';
         foreach ($a as $b) {
            $arg1 .= $b.'/';
         }

         $arg1 = rtrim($arg1, '/');
         $arg2 = $prefix.'.'.$method['funcArgs'][1];
         $method_name = $method['funcName'];

         call_user_func($method_name, $arg1, $arg2);
      }
   }
}

if (!function_exists('url')){
   function url($segment){
      $url = (isset($_SESSION['HTTPS']) && $_SESSION['HTTPS'] == 'on') ? 'https://' : 'http://';
      $url .= $_SERVER['HTTP_HOST'];

      if(!in_array($segment, ['/', ''])){
         $url .= '/'.ltrim($segment, '/');
      }
      return $url;
   }
}

if (!function_exists('aurl')){
   function aurl($segment){
      $aurl = (isset($_SESSION['HTTPS']) && $_SESSION['HTTPS'] == 'on') ? 'https://' : 'http://';
      $aurl .= $_SERVER['HTTP_HOST'];
      if(in_array($segment, ['/', ''])){
         $aurl .= '/'.DASH;
      }else {
         $aurl .= '/'.DASH.'/'.ltrim($segment, '/');
      }
      return $aurl;
   }
}


if (!function_exists('redirect')){
   function redirect($path){
      $path_parse = parse_url($path);

      if (isset($path_parse['scheme']) && isset($path_parse['host'])){
         header('Location: '.$path);
      } else {
         header('Location: '.url($path));
      }
      exit();
   }
}

if (!function_exists('back')){
   function back(){
      header('Location: '.$_SERVER['HTTP_REFERER']);
      exit();
   }
}