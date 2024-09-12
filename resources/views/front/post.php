<?php
   $exp = explode('/' ,segment());
   $id = end($exp);
   $post = get_items('posts', 'id', $id);
   
   if (!$post){
      redirect('/');
   }
   
   $category = get_items('categories', 'id', $post->category_id);
   $user = get_items('users', 'id', $post->user_id);
   $tag = get_items('tags', 'id', $post->tag_id);

   view('front.layouts.header', ['title' => $post->title]);
   view('front.layouts.navbar', ['id' => $category->id]);
?>

<div class="container pt-5">
   @php
      $created_at = format_date($post->created_at, '%B %d, %Y');
      $img = storage_url($post->image);
   @endphp

   <article class="blog-post">
      <h2 class="display-5 link-body-emphasis mb-1">{{ $post->title }}</h2>
      <p class="blog-post-meta">
         {{ $created_at }} by <a href="{{ url('user/'.$user->id) }}">{{ $user->name }}</a>
      </p>
      <hr>
      <img src="{{ $img }}" width="500px">
      <p>{{ $post->content }}</p>
      <p>Tags: <a href="{{ url('tag/'.$tag->id) }}">{{ $tag->name }}</a></p>
   </article>
</div>

<?php view('front.layouts.footer') ?>