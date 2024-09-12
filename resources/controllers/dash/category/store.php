<?php

$data = valid([
   'name' => 'required',
   'description' => 'required',
], [
   'name' => trans('category.name'),
   'description' => trans('category.description'),
]);


$is_created = create_item('categories', $data);

if ($is_created){
   redirect(aurl('categories'));
}