@include('admin.layouts.header')
@include('admin.layouts.navbar')
<div class="container pt-5">
   <article class="blog-post">
      <h2 class="display-5 link-body-emphasis mb-1">{{ $category->name }}</h2>
      <hr>
      <p>{{ $category->description }}</p>
      <p class="mt-5"><a href="{{ $_SERVER['HTTP_REFERER'] }}">back</a></p>
   </article>
</div>
@include('admin.layouts.footer')