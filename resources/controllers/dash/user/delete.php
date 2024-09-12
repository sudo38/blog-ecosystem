<?php

$user = get_items('users', 'id', request('id'));

if (!$user){
   redirect(aurl('users'));
}

$is_deleted = delete_item('users', 'id', request('id'));

if ($is_deleted){
   // header('refresh:1;');
}