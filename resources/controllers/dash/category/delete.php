<?php 

$category = get_items('categories', 'id', request('id'));
if (!$category){
    redirect(aurl('categories'));
}

if(!empty($category->icon)){
    delete_file($category->icon);
}

$is_deleted = delete_item('categories', 'id', request('id'));
if ($is_deleted){
    redirect(aurl('categories'));
}