<!DOCTYPE html>
<html lang="<?= setup()->lang ?>" dir="<?= setup()->dir ?>" data-bs-theme="auto">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title></title>
      <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/blog/">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
      <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">

      <?php if(setup()->dir == 'rtl'): ?>
         <link href="<?= asset('front/css/blog.rtl.css')?>" rel="stylesheet">
         <link href="<?= asset('plugins/bootstrap/v5.3/css/bootstrap.rtl.min.css') ?>" rel="stylesheet">
      <?php else: ?>
         <link href="<?= asset('front/css/blog.css')?>" rel="stylesheet">
         <link href="<?= asset('plugins/bootstrap/v5.3/css/bootstrap.min.css') ?>" rel="stylesheet">
      <?php endif ?>
      
      <link href="<?= asset('css/headers.css')?>" rel="stylesheet">
      <link href="<?= asset('css/sign-in.css')?>" rel="stylesheet">
      <link href="<?= asset('css/style.css')?>" rel="stylesheet">
      <link href="<?= asset('plugins/font-awesome/v6.5/css/all.min.css') ?>" rel="stylesheet">
   </head>
   <body>
