<?php

$data = valid([
   'name' => 'required',
   'email' => 'required|email|unique:users',
   'password' => 'required',
   'conf_password' => 'required|equal:password',
   'mobile' => 'required|unique:users',
],
[
   'name' => trans('main.name'),
   'email' => trans('main.email'),
   'password' => trans('main.password'),
   'conf_password' => trans('main.conf_password'),
   'mobile' => trans('main.mobile'),
]);


unset($data['conf_password']);
$data['password'] = bcrypt($data['password']);
$is_created = create_item('users', $data);

if ($is_created){
   redirect(url('/'));
}