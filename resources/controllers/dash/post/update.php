<?php

$data = valid([
   'title' => 'required',
   'description' => 'required',
   'content' => 'required',
   'image' => 'image',
   'category_id' => 'required',
   'tag_id' => 'required'],
   [
   'title' => trans('post.title'),
   'description' => trans('post.description'),
   'content' => trans('post.content'),
   'image' => trans('post.image'),
   'category_id' => trans('post.category'),
   'tag_id' => trans('post.tag_id'),
   ]
);


if (!empty($data['image']['name'])){
   delete_file($post->image);
   $data['image'] = store_file($data['image'], 'posts/'.file_extension($data['image']));
   
} else {
   $data['image'] = $post->image;
}

$data['user_id'] = auth(ADMIN)['id'];
$data['updated_at'] = date('Y-m-d H:i:s');

$is_updated = update_item('posts', $data, 'id='.request('id'));

if ($is_updated){
   redirect(aurl('posts'));
}