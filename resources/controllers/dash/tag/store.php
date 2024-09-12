<?php

$data = valid([
   'name' => 'required',
   'description' => 'required'],
   [
   'name' => trans('tag.name'),
   'description' => trans('tag.description'),
   ]
);

$data['slug'] = slug($data['name']);

$is_created = create_item('tags', $data);

if ($is_created){
   redirect(aurl('tags'));
}