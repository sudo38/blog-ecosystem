<?php
   $user = get_items('users', 'id', auth(ADMIN)->id);

   $bio_err = input_err('bio');
   $fb_err = input_err('fb');
   $x_err = input_err('x');
   $instagram_err = input_err('instagram');

   view('admin.layouts.header', ['title' => $user->name]);
   view('admin.layouts.navbar');
?>


<div class="container-fluid">
   <form action="{{ aurl('settings/update') }}" method="POST" enctype="multipart/form-data">
      <div class="row">
         @php view('admin.layouts.sidebar') @endphp
         <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
               <h1 class="h2">{{ trans('settings.social') }}</h1>
            </div>
               <div class="row">
                  <div class="col-md-12 mt-2">
                     <div class="form-group">
                        <label class="mb-1">{{ trans('user.bio') }}:</label>
                        <input class="form-control {{ $bio_err ? 'is-invalid' : '' }}" type="text" name="bio" value="{{ $user->bio }}">
                        @if($bio_err)
                           <div class="invalid-feedback">{{ $bio_err }}</div>
                        @endif
                     </div>
                  <div class="col-md-12 mt-2">
                     <div class="form-group">
                        <label class="mb-1">{{ trans('user.social') }}:</label>
                        <input class="form-control {{ $fb_err ? 'is-invalid' : '' }}" type="text" name="fb">
                        @if($fb_err)
                           <div class="invalid-feedback">{{ $fb_err }}</div>
                        @endif

                        <input class="form-control {{ $instagram_err ? 'is-invalid' : '' }}" type="text" name="instagram">
                        @if($instagram_err)
                           <div class="invalid-feedback">{{ $instagram_err }}</div>
                        @endif

                        <input class="form-control {{ $x_err ? 'is-invalid' : '' }}" type="text" name="x">
                        @if($x_err)
                           <div class="invalid-feedback">{{ $x_err }}</div>
                        @endif
                     </div>
                  </div>
               </div>
         </main>
      </div>
   </form>
</div>
{{ view('admin.layouts.footer') }}