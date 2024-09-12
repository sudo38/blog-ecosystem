<?php

route_group(['prefix' => DASH, 'middleware' => 'auth'], [
   # Dashboard
   get('/', 'index'),

   # Categories
   get('categories', 'category.index'),
   get('category/create', 'category.create'),
   get('category/view', 'category.view'),
   get('category/edit', 'category.edit'),
   post('category/store', 'category.store'),
   post('category/update', 'category.update'),
   post('category/delete', 'category.delete'),

   # Tags
   get('tags', 'tag.index'),
   get('tag/create', 'tag.create'),
   post('tag/store', 'tag.store'),
   get('tag/{id}', 'tag.view'),
   get('tag/edit/{id}', 'tag.edit'),
   post('tag/update/{id}', 'tag.update'),
   post('tag/delete/{id}', 'tag.delete'),


   # Posts
   get('posts', 'post.index'),
   get('post/create', 'post.create'),
   get('post/view', 'post.view'),
   get('post/edit', 'post.edit'),
   post('post/store', 'post.store'),
   post('post/update', 'post.update'),
   post('post/delete', 'post.delete'),


   # Users
   get('users', 'user.index'),
   get('user/view', 'user.view'),
   get('user/edit', 'user.edit'),
   post('user/update', 'user.update'),
   post('user/delete', 'user.delete'),


   # Profile
   get('profile', 'profile.index'),
   get('settings', 'profile.settings'),
   post('settings/update', 'profile.update'),
]);


