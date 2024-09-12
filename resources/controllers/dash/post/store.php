<?php

$data = valid([
   'title' => 'required',
   'description' => 'required',
   'content' => 'required',
   'image' => 'image',
   'category_id' => 'required',],
   [
   'title' => trans('post.title'),
   'description' => trans('post.description'),
   'content' => trans('post.content'),
   'image' => trans('post.image'),
   'category_id' => trans('post.category'),
   ]
);

if (!empty($data['image']['tmp_name'])){
   $data['image'] = store_file($data['image'], 'posts/'.file_extension($data['image']));
} else {
   unset($data['image']);
}

$data['slug'] = slug($data['title']);
$data['user_id'] = auth(ADMIN)->id;
$data['created_at'] = date('Y-m-d H:i:s'); 
$data['updated_at'] = date('Y-m-d H:i:s');

$post = create_item('posts', $data);

if ($post['created']){

   $tags_id = [];
   $post_id = $post['row_id'];

   foreach($_POST as $request => $value){
      if(preg_match('/^tag/i', $request)){
         $tags_id[] = $value;
      }
   }
   foreach($tags_id as $tag_id){
      $tag = create_item('post_tag', [
         'post_id' => $post_id,
         'tag_id' => $tag_id
      ]);
   }
   if($tag['created']){
      redirect(aurl('posts'));
   }
}