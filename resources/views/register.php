<?php
view('front.layouts.header', ['title' => trans('main.create_account')]);

if(auth(DASH)){
   redirect(DASH);
}

$name_err = input_err('name');
$email_err = input_err('email');
$mobile_err = input_err('mobile');
$password_err = input_err('password');
$conf_password_err = input_err('conf_password');
?>

<main class="form-signin w-100 m-auto">
   <form action="{{ url('do/register') }}" method="POST">
      <img class="mb-4" src="{{ url('assets/brand/bootstrap-logo.svg') }}" alt="" width="72" height="57">
      <h1 class="h3 mb-3 fw-normal">{{ trans('main.create_account') }}</h1>

      @if(session_has('login_failed'))
         <div class="alert alert-danger">
            {{ session_flash('login_failed') }}
         </div>
      @endif
      
      <div class="form-floating mb-3">
         <input class="form-control {{ $name_err ? 'is-invalid' : '' }}" type="text" name="name" id="floatingInput" placeholder="name@example.com" value="{{ old('name') }}">
         <label for="floatingInput">{{ trans('main.name') }}</label>
         @if($name_err)
            <div class="invalid-feedback">
               {{ $name_err }}
            </div>
         @endif
      </div>
      <div class="form-floating mb-3">
         <input class="form-control {{ $email_err ? 'is-invalid' : '' }}" type="text" name="email" id="floatingInput" placeholder="name@example.com" value="{{ old('email') }}">
         <label for="floatingInput">{{ trans('main.email') }}</label>
         @if($email_err)
            <div class="invalid-feedback">
               {{ $email_err }}
            </div>
         @endif
      </div>
      <div class="form-floating mb-3">
         <input class="form-control {{ $mobile_err ? 'is-invalid' : '' }}" type="text" name="mobile" id="floatingInput" placeholder="name@example.com" value="{{ old('mobile') }}">
         <label for="floatingInput">{{ trans('main.mobile') }}</label>
         @if($mobile_err)
            <div class="invalid-feedback">
               {{ $mobile_err }}
            </div>
         @endif
      </div>
      <div class="form-floating mb-3">
         <input class="form-control {{ $password_err ? 'is-invalid' : '' }}" type="password" name="password" id="floatingPassword" placeholder="Password" value="{{ old('password') }}">
         <label for="floatingPassword">{{ trans('main.password') }}</label>
         @if($password_err)
            <div class="invalid-feedback">
               {{ $password_err }}
            </div>
         @endif
      </div>
      <div class="form-floating mb-3">
         <input class="form-control {{ $conf_password_err ? 'is-invalid' : '' }}" type="password" name="conf_password" id="floatingPassword" placeholder="Confirm Password" value="{{ old('conf_password') }}">
         <label for="floatingPassword">{{ trans('main.conf_password') }}</label>
         @if($conf_password_err)
            <div class="invalid-feedback">
               {{ $conf_password_err }}
            </div>
         @endif
      </div>
      <button class="btn btn-primary w-100 py-2" type="submit">{{ trans('main.create') }}
      </button>
   </form>
   <p class="mt-3 mb-3 text-body-secondary">&copy; 2017–2024
   @if(session('locale') == 'ar')
      <a href="{{ url('lang?lang=en') }}" class="nav-link">En</a></li>
   @else
      <a href="{{ url('lang?lang=ar') }}" class="nav-link">ع</a></li>
   @endif
   </p>
   @php session_forget('old'); @endphp
</main>
