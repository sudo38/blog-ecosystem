<?php

// var_dump(strlen(trim('/', '/') != 0));
// echo url('lll').'<br>';
// echo aurl('kkk').'<br>';

include base_path('routes/dash.php');

# Front
route_get('/','front.index');
route_get('test','test');
route_get('blog','front.blog');
route_get('tag/{id}','front.tag');
route_get('post/{slug}','front.post');
route_get('user/{id}','front.user');
route_get('category/{id}','front.category');

# Set Language
route_get('lang', 'action.set_lang');

# Authentication
route_get('login','login');
route_post('auth','auth');
route_get('register','register');
route_post('do/register','store');
route_get('logout','logout');




















// route_get('hello/salah', 'hello-salah');