<?php 

$news = get_items('news', 'id', request('id'));
if (!$news){
    redirect(aurl('news'));
}

if(!empty($news->image)){
    delete_file($news->image);
}

$is_deleted = delete_item('news', 'id', request('id'));
if ($is_deleted){
    redirect(aurl('news'));
}