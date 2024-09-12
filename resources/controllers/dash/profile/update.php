<?php
$user_id = auth(ADMIN)['id'];

$data = valid([
   'name' => 'required',
   'email' => 'required|email|unique:users,'.$user_id,
   'mobile' => 'required|unique:users,'.$user_id,
   // 'role' => 'required|in:admin,user',
   // 'status' => 'required|in:yes,no',
],
[
   'name' => trans('user.name'),
   'email' => trans('user.email'),
   'mobile' => trans('user.mobile'),
   // 'role' => trans('user.role'),
   // 'status' => trans('user.status'),
]);

if (!empty($data['password'])){
   $data['password'] = bcrypt($data['password']);
} else {
   unset($data['password']);
}

$is_updated = update_item('users', $data, 'id='.$user_id);

if ($is_updated){
   redirect(aurl('/'));
}