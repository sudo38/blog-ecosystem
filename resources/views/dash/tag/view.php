<?php
   $exp = explode('/' ,segment());
   $id = end($exp);
   $tag = get_items('tags', 'id', $id);

   if (!$tag){
      redirect(aurl('tags'));
   }

   view('admin.layouts.header', ['title' => $tag->name]);
   view('admin.layouts.navbar');
?>

<div class="container pt-5">
   <article class="blog-post">
      <h2 class="display-5 link-body-emphasis mb-1">{{ $tag->name }}</h2>
      <hr>
      <p>{{ $tag->description }}</p>
      <p class="mt-5"><a href="{{ $_SERVER['HTTP_REFERER'] }}">back</a></p>
   </article>
</div>

{{ view('admin.layouts.footer') }}