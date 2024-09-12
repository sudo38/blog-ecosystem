<?php

$data = valid([
   'name' => 'required',
   'description' => 'required',
], [
   'name' => trans('category.name'),
   'description' => trans('category.description'),
]);

$category = get_items('categories', 'id', request('id'));
$is_updated = update_item('categories', $data, 'id='.request('id'));

if ($is_updated){
  redirect(aurl('categories'));
}