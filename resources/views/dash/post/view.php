<?php
   $post = get_items('posts', 'id', request('id'));

   if(!$post){
      redirect(aurl('posts'));
   }

   $user = get_items('users', 'id', $post->user_id);
   $tags = tags_related_post('posts', $post->id);

   $created_at = format_date($post->created_at, '%B %d, %Y');
   $img = storage_url($post->image);

   view('admin.layouts.header', ['title' => $post->title]);
   view('admin.layouts.navbar');
?>

<div class="container pt-5">
   <article class="blog-post">
      <h2 class="display-5 link-body-emphasis mb-1">{{ $post->title }}</h2>
      <p class="blog-post-meta">
         {{ $created_at }} by <a href="{{ url('user/'.$user->id) }}">{{ $user->name }}</a>
      </p>
      <hr>
      <img src="{{ $img }}" width="500">
      <p>{{ $post->content }}</p>
      <p>Tags: 
         @foreach($tags as $tag_id => $tag_name)
            <a href="{{ aurl('posts?tag_id='.$tag_id) }}">
            {{ $tag_name.', ' }}
            </a>
         @endforeach
      </p>
      <p class="mt-5">
         <a href="{{ $_SERVER['HTTP_REFERER'] }}">back</a>
      </p>
   </article>
</div>

{{ view('admin.layouts.footer') }}