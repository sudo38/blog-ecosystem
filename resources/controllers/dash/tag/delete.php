<?php 

$exp = explode('/' ,segment());
$id = end($exp);

$is_deleted = delete_item('tags', 'id', $id);
if ($is_deleted){
   redirect(aurl('tags'));
}