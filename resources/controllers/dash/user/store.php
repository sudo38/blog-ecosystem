<?php

$data = valid([
   'name' => 'required',
   'email' => 'required|email|unique:users',
   'password' => 'required',
   'mobile' => 'required|unique:users',
   'role' => 'required|in:admin,user',
],
[
   'name' => trans('user.name'),
   'email' => trans('user.email'),
   'password' => trans('user.password'),
   'mobile' => trans('user.mobile'),
   'role' => trans('user.role'),
]);

$data['password'] = bcrypt($data['password']);
$is_created = create_item('users', $data);

if ($is_created){
   redirect(aurl('users'));
}