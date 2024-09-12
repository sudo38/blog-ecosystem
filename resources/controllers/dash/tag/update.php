<?php

$exp = explode('/' ,segment());
$id = end($exp);

$data = valid([
   'name' => 'required',
   'description' => 'required'],
   [
   'name' => trans('tag.name'),
   'description' => trans('tag.description'),
   ]
);

$data['slug'] = slug($data['name']);
$is_updated = update_item('tags', $data, 'id='.$id);

if ($is_updated){
   redirect(aurl('tags'));
}