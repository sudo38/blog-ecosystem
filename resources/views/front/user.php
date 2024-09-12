<?php
   $exp = explode('/' ,segment());
   $id = end($exp);
   $user = get_items('users', 'id', $id);

   if(!$user){
      redirect(aurl('users'));
   }
   view('front.layouts.header', ['title' => $user->name]);
   view('front.layouts.navbar');
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
      <div class="w-100 mt-3">
         <div class="form-group">
            <label>{{ trans('user.contact') }}:</label><br>
            <i class="fa-brands fa-facebook"></i>
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-x"></i>
         </div>
      </div>
   </div>
</div>

{{ view('admin.layouts.footer') }}