<?php
view('front.layouts.header', ['title' => trans('main.login_page')]);

if(auth(DASH)){
   redirect(DASH);
}

$email_err = input_err('email');
$password_err = input_err('password');
?>

<main class="form-signin w-100 m-auto">
   <form action="<?= url('auth') ?>" method="POST">
      <h1 class="h3 mb-3 mt-5 fw-normal"><?= trans('main.login_page') ?></h1>
      <?php if(session_has('login_failed')): ?>
         <div class="alert alert-danger">
            <?= session_flash('login_failed') ?>
         </div>
      <?php endif ?>
      
      <div class="form-floating mb-3">
         <input class="form-control <?= $email_err ? 'is-invalid' : '' ?>" type="text" name="email" id="floatingInput" placeholder="name@example.com" value="<?= old('email') ?>">
         <label for="floatingInput"><?= trans('main.email') ?></label>
         <?php if($email_err): ?>
            <div class="invalid-feedback">
               <?= $email_err ?>
            </div>
         <?php endif ?>
      </div>
      <div class="form-floating mb-3">
         <input class="form-control <?= $password_err ? 'is-invalid' : '' ?>" type="password" name="password" id="floatingPassword" placeholder="Password" value="<?= old('password') ?>">
         <label for="floatingPassword"><?= trans('main.password') ?></label>
         <?php if($password_err): ?>
            <div class="invalid-feedback">
               <?= $password_err ?>
            </div>
         <?php endif ?>
      </div>

      <div class="form-check text-start my-3">
         <input class="form-check-input" type="checkbox" name="remember_me" value="remember-me" id="flexCheckDefault">
         <label class="form-check-label" for="flexCheckDefault"> <?= trans('main.remember_me') ?></label>
      </div>
      <button class="btn btn-primary w-100 py-2" type="submit"><?= trans('main.sign-in') ?></button>
   </form>
   <p class="mt-3"><a href="<?= url('register') ?>"><?= trans('main.create_account') ?> ?</a></p>
   <p class="mt-3 mb-3 text-body-secondary">&copy; 2017–2024
   <?php if(session('locale') == 'ar'): ?>
      <a href="<?= url('lang?lang=en') ?>" class="nav-link">En</a></li>
   <?php else: ?>
      <a href="<?= url('lang?lang=ar') ?>" class="nav-link">ع</a></li>
   <?php endif ?>
   </p>
   <?= session_forget('old'); ?>
</main>
