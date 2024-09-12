<?php
   $exp = explode('/' ,segment());
   $id = end($exp);
   $tag = get_items('tags', 'id', $id);
   $posts = get_items('posts', 'tag_id', $tag->id);

   
   if(!$posts){
      redirect(url('/'));
   }

   view('front.layouts.header', ['title' => $tag->name]);
   view('front.layouts.navbar');
?>

<main class="container">
   <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
      <div class="col-lg-6 px-0">
         <h1 class="display-4 fst-italic">{{ $tag->name }}</h1>
         <p class="lead my-3">{{ $tag->description }}</p>
      </div>
   </div>
   <div class="row mb-2">
      @if(is_array($posts))
         @foreach($posts as $post)
            @php
               $date = new DateTime($post['created_at']);
               $created_at = $date->format('Y-m-d');
               $link = url('post/'.$post['id']);
            @endphp
            <div class="col-md-6">
               <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                  <div class="col p-4 d-flex flex-column position-static">
                     <h3 class="mb-0">
                        <a href="{{ $link }}">{{ $post['title'] }}</a>
                     </h3>
                     <div class="mb-1 text-body-secondary">
                        {{ $created_at }}
                     </div>
                     <p class="card-text mb-auto">{{ $post['description'] }}</p>
                     <a href="{{ $link }}" class="icon-link gap-1">
                        {{ trans('main.readmore') }}
                        <svg class="bi"><use xlink:href="#chevron-right"/></svg>
                     </a>
                  </div>
                  <div class="col-auto d-none d-lg-block">
                     <img src="{{ $post['image'] ? storage_url($post['image']) : '' }}" width="200">
                  </div>
               </div>
            </div>
         @endforeach
      @else
         @php
            $post = ${'posts'};
            $created_at = format_date($post->created_at);
            $link = url('post/'.$post->id);
         @endphp
         <div class="col-md-6">
               <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                  <div class="col p-4 d-flex flex-column position-static">
                     <h3 class="mb-0">
                        <a href="{{ $link }}">{{ $post->title }}</a>
                     </h3>
                     <div class="mb-1 text-body-secondary">
                        {{ $created_at }}
                     </div>
                     <p class="card-text mb-auto">{{ $post->description }}</p>
                     <a href="#" class="icon-link gap-1">
                        {{ trans('main.readmore') }}
                        <svg class="bi"><use xlink:href="#chevron-right"/></svg>
                     </a>
                  </div>
                  <div class="col-auto d-none d-lg-block">
                     <img src="{{ storage_url($post->image) ? storage_url($post->image) : '' }}" width="200">
                  </div>
               </div>
         </div>
      @endif
   </div>
</main>

<?php view('front.layouts.footer') ?>