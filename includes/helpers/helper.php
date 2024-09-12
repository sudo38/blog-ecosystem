<?php

if (!function_exists('slug')){
   function slug($str){
      $slug = strtolower($str);
      $slug = preg_replace('/[^a-z0-9-]+/', ' ', $slug);
      $slug = preg_replace('/\s+/', '-', $slug);
      $slug = preg_replace('/-+/', '-', $slug);
      $slug = trim($slug, '-');

      return $slug;
   }
}

if(!function_exists('get_title')){
   function get_title(){
      return isset($title) ? ' - '.$title : '';
   }
}

if(!function_exists('invalid')){
   function invalid($input){
      return isset(${$input}) ? 'is-invalid' : '';
   }
}

if (!function_exists('asset')){
   function asset($segment){
      return url('assets/'.$segment);
   }
}

if (!function_exists('setup')) {
   function setup() {
      $setup = new stdClass();

      if (session_has('locale') && session('locale') == 'ar') {
         $setup->lang = session('locale');
         $setup->dir = 'rtl';
      } else {
         $setup->lang = 'en';
         $setup->dir = 'ltr';
      }

      return $setup;
   }
}


if (!function_exists('dd')){
   function dd($p){
      echo '<pre>';
      print_r($p);
      echo '</pre>';
   }
}


if (!function_exists('unique_id')){
   function unique_id($str){

   }
}

if (!function_exists('clear_url')){
   function clear_url(){
      $query = isset($_SERVER['QUERY_STRING']);
      $query = $query ? '?'.$query : '';

      $url = (isset($_SESSION['HTTPS']) && $_SESSION['HTTPS'] == 'on') ? 'https://' : 'http://';
      $url .= $_SERVER['HTTP_HOST'];

      $target_url = $url.segment();
      $current_url = $target_url.$query;
      
      if ($current_url !== $target_url) {
         redirect($target_url);
      }
   }
}

if (!function_exists('subtitle')){
   function subtitle($value, $table, $col, $route, $redirect, $prefix='admin/'){
      $row = get_items($table, $col, $value);
      if (!$row){
         redirect($redirect);
      } else {
         $html = '<span style="font-size: 25px">
                        ( <a href="'.url($prefix.$route.$row->$col).'">'.$row->name.'</a> )
                  </span>';
         return $html;
      }
   }
}

if(!function_exists('posts_related_tag')){
   function posts_related_tag($tags_table, $key){
      $fetch_posts_related_tag = fetch_items($tags_table, '
         tags.id AS tag_id,
         tags.name AS tag_name,
         GROUP_CONCAT(posts.id SEPARATOR ", ") AS posts_id', '
         JOIN post_tag ON post_tag.tag_id = tags.id
         JOIN posts ON posts.id = post_tag.post_id
         GROUP BY tags.id, tags.name'
      );

      $tag_info = find_by_id($fetch_posts_related_tag, $key, request($key));
      $posts_id = explode(', ', $tag_info['posts_id']);

      return $posts_id;
   }
}


if(!function_exists('tags_related_post')){
   function tags_related_post($posts_table, $post_id){
      $fetch_tags_related_post = fetch_items($posts_table, '
      posts.id AS post_id,
      posts.title AS post_title,
      GROUP_CONCAT(tags.id SEPARATOR ", ") AS tags_id,
      GROUP_CONCAT(tags.name SEPARATOR ", ") AS tags_name', '
      JOIN post_tag ON posts.id = post_tag.post_id
      JOIN tags ON post_tag.tag_id = tags.id
      GROUP BY posts.id, posts.title'
      );

      $tags_info = find_by_id($fetch_tags_related_post, 'post_id', $post_id);
      $tags_id = array_values(explode(', ', $tags_info['tags_id']));
      $tags_name = array_values(explode(', ', $tags_info['tags_name']));
      $tags = zip($tags_id, $tags_name);

      return $tags;
   }
}


if (!function_exists('format_date')){
   function format_date($date, $format='%B %d'){
      setlocale(LC_TIME, 'en_EN.UTF-8');
      $date = new DateTime($date);
      $date = strftime($format, $date->getTimestamp());
      return  ucfirst($date);
   }
}


if(!function_exists('zip')){
   function zip($arr1, $arr2) {
      $zippedArray = [];
      $length = min(count($arr1), count($arr2));
   
      for ($i = 0; $i < $length; $i++) {
         $zippedArray[$arr1[$i]] = $arr2[$i];
      }
   
      return $zippedArray;
   }
}


if(!function_exists('find_by_id')){
   function find_by_id($array, $id_str, $id) {
      foreach ($array as $element) {
         if ($element[$id_str] == $id) {
               return $element;
         }
      }
   }
}

