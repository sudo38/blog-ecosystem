<?php

$data = validator([
   'email'    => 'required|email',
   'password' => 'required',
]);

$login = get_items('users', 'email', $data['email']);

if (is_null($login) || !hash_check($data['password'], $login->password)){
   session('login_failed', trans('main.login_failed'));
   redirect('login');
} else {
   session(DASH, json_encode($login));
   redirect(DASH);
}