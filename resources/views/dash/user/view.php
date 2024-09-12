<?php
   $user = get_items('users', 'id', request('id'));

   if(!$user){
      redirect(aurl('users'));
   }
   
   view('admin.layouts.header', ['title' => $user->name]);
   view('admin.layouts.navbar');
?>

<div class="container pt-5">
   <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">@{{ $user->name }}</h1>
   </div>
   <div class="row">
      <div class="w-100">
         <div class="form-group">
            <label>{{ trans('user.bio') }}:</label><br>
            {{$user->bio}}
         </div>
      </div>
      <div class="w-100">
         <div class="form-group">
            <label>{{ trans('user.email') }}:</label><br>
            {{$user->email}}
         </div>
      </div>
      <div class="w-100">
         <div class="form-group">
            <label>{{ trans('user.mobile') }}:</label><br>
            {{$user->mobile}}
         </div>
      </div>
      <div class="w-100 mt-3">
         <div class="form-group">
            <label>{{ trans('user.contact') }}:</label><br>
            <i class="fa-brands fa-facebook"></i>
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-x"></i>
         </div>
      </div>
   </div>
   <p class="mt-5"><a href="{{ $_SERVER['HTTP_REFERER'] }}">back</a></p>
</div>

{{ view('admin.layouts.footer') }}