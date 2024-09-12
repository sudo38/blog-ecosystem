<?php
   $user = get_items('users', 'id', auth(ADMIN)->id);

   if(!$user){
      redirect(aurl('users'));
   }

   $name_err = input_err('name');
   $mobile_err = input_err('mobile');
   $email_err = input_err('email');
   $old_password_err = input_err('old_password');
   $new_password_err = input_err('new_password');
   $conf_password_err = input_err('conf_password');

   view('admin.layouts.header', ['title' => $user->name]);
   view('admin.layouts.navbar');
?>


<div class="container-fluid">
   <form action="{{ aurl('settings/update') }}" method="POST" enctype="multipart/form-data">
      <div class="row">
         @php view('admin.layouts.sidebar') @endphp
         <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
               <h1 class="h2">{{ trans('settings.general') }}</h1>
            </div>
               <div class="row">
                  <div class="col-md-12 mt-2">
                     <div class="form-group">
                        <label class="mb-1">{{ trans('user.name') }}:</label>
                        <input class="form-control {{ $name_err ? 'is-invalid' : '' }}" type="text" name="name" value="{{ $user->name }}">
                        @if($name_err)
                           <div class="invalid-feedback">{{ $name_err }}</div>
                        @endif
                     </div>
                  </div>
                  <div class="col-md-12 mt-2">
                     <div class="form-group">
                        <label class="mb-1">{{ trans('user.email') }}:</label>
                        <input class="form-control  {{ $email_err ? 'is-invalid' : '' }}" type="text" name="email" value="{{ $user->email }}">
                        @if($email_err)
                           <div class="invalid-feedback">{{ $email_err }}</div>
                        @endif
                     </div>
                  </div>
                  <div class="col-md-12 mt-2">
                     <div class="form-group">
                        <label class="mb-1">{{ trans('user.mobile') }}:</label>
                        <input class="form-control {{ $mobile_err ? 'is-invalid' : '' }}" type="text" name="mobile" value="{{ $user->mobile }}">
                        @if($mobile_err)
                           <div class="invalid-feedback">{{ $mobile_err }}</div>
                        @endif
                     </div>
                  </div>
               </div>
         </main>
      </div>
      <div class="row mt-5">
         <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
               <h1 class="h2">{{ trans('settings.security') }}</h1>
            </div>
            <div class="row">
               <div class="col-md-12 mt-2">
                  <div class="form-group">
                     <label class="mb-1">{{ trans('user.old_password') }}:</label>
                     <input class="form-control {{ $old_password_err ? 'is-invalid' : '' }}" type="old_password" name="password">
                     @if($old_password_err)
                        <div class="invalid-feedback">{{ $old_password_err }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-md-12 mt-2">
                  <div class="form-group">
                     <label class="mb-1">{{ trans('user.new_password') }}:</label>
                     <input class="form-control {{ $new_password_err ? 'is-invalid' : '' }}" type="new_password" name="password">
                     @if($new_password_err)
                        <div class="invalid-feedback">{{ $new_password_err }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-md-12 mt-2">
                  <div class="form-group">
                     <label class="mb-1">{{ trans('user.conf_password') }}:</label>
                     <input class="form-control {{ $conf_password_err ? 'is-invalid' : '' }}" type="conf_password" name="password">
                     @if($conf_password_err)
                        <div class="invalid-feedback">{{ $conf_password_err }}</div>
                     @endif
                  </div>
               </div>
            </div>
            <button class="btn btn-primary mt-2" type="submit">{{ trans('admin.update') }}</button>
         </main>
      </div>
   </form>
</div>
{{ view('admin.layouts.footer') }}