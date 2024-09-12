<?php
   $user = get_items('users', 'id', request('id'));

   if(!$user){
      redirect(aurl('users'));
   }

   $name_err = input_err('name');
   $email_err = input_err('email');
   $password_err = input_err('password');
   $mobile_err = input_err('mobile');
   $role_err = input_err('role');
   $status_err = input_err('error');

   view('admin.layouts.header', ['title' => $user->name]);
   view('admin.layouts.navbar');
?>

<div class="container">
   <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">{{ trans('user.edit_user') }}</h1>
      <a class="btn btn-primary" href="{{ aurl('users') }}">{{ trans('admin.users') }}</a>
   </div>
   <form action="{{ aurl('user/update') }}" method="POST" enctype="multipart/form-data">
   <div class="row">
         <div class="col-md-6 mt-2">
            <div class="form-group">
               <label class="mb-1">{{ trans('user.name') }}:</label>
               <input type="hidden" name="id" value="{{ request('id') }}">
               <input class="form-control {{ $name_err ? 'is-invalid' : '' }}" type="text" name="name" value="{{ $user->name }}">
               @if($name_err)
                  <div class="invalid-feedback">{{ $name_err }}</div>
               @endif
            </div>
         </div>
         <div class="col-md-6 mt-2">
            <div class="form-group">
               <label class="mb-1">{{ trans('user.email') }}:</label>
               <input class="form-control  {{ $email_err ? 'is-invalid' : '' }}" type="text" name="email" value="{{ $user->email }}">
               @if($email_err)
                  <div class="invalid-feedback">{{ $email_err }}</div>
               @endif
            </div>
         </div>
         <div class="col-md-6 mt-2">
            <div class="form-group">
               <label class="mb-1">{{ trans('user.password') }}:</label>
               <input class="form-control {{ $password_err ? 'is-invalid' : '' }}" type="text" name="password">
               @if($password_err)
                  <div class="invalid-feedback">{{ $password_err }}</div>
               @endif
            </div>
         </div>
         <div class="col-md-6 mt-2">
            <div class="form-group">
               <label class="mb-1">{{ trans('user.mobile') }}:</label>
               <input class="form-control {{ $mobile_err ? 'is-invalid' : '' }}" type="text" name="mobile" value="{{ $user->mobile }}">
               @if($mobile_err)
                  <div class="invalid-feedback">{{ $mobile_err }}</div>
               @endif
            </div>
         </div>
         <div class="col-md-6 mt-2">
            <div class="form-group">
               <label class="mb-1">{{ trans('user.role') }}:</label>
               <select class="form-select {{ $role_err ? 'is-invalid' : '' }}" name="role">
                  <option disabled selected>--</option>
                  <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>{{ trans('user.admin') }}
                  </option>
                  <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>
                     {{ trans('user.user') }}
                  </option>
               </select>
               @if($role_err)
                  <div class="invalid-feedback">{{ $role_err }}</div>
               @endif
            </div>
         </div>
         <div class="col-md-6 mt-2">
            <div class="form-group">
               <label class="mb-1">{{ trans('user.status') }}:</label>
               <select class="form-select {{ $status_err ? 'is-invalid' : '' }}" name="status">
                  <option disabled selected>--</option>
                  <option value="yes" {{ $user->status == 'yes' ? 'selected' : '' }}>{{ trans('user.yes') }}
                  </option>
                  <option value="no" {{ $user->status == 'no' ? 'selected' : '' }}>
                     {{ trans('user.no') }}
                  </option>
               </select>
               @if($status_err)
                  <div class="invalid-feedback">{{ $status_err }}</div>
               @endif
            </div>
         </div>
      </div>
      <button class="btn btn-primary mt-2" type="submit">{{ trans('admin.update') }}</button>
   </form>
</div>

<?php view('admin.layouts.footer') ?>