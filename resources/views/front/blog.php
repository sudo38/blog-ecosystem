<?php
   view('front.layouts.header');
   view('front.layouts.navbar');
   view('front.layouts.main');

   $posts = get_items('posts');
   
   if (request('month')){
      $year = date('Y');
      $date = $year.'-'.request('month').'-01';
      $date = format_date($date, '%B, %Y');
      $posts = fetch_with_date('posts', 'created_at', request('month'));
   }  elseif (request('p')){

   }
   else {
      clear_url();
   }

   $paginate = pagination($posts, 4);
   $posts = $paginate['records'];
   $render = $paginate['render'];
?>

<main class="container">
   <div class="row mb-2">
      @if(isset($date))
      <h3 class="py-4">
         <i class="fa-solid fa-angles-right" style="font-size: 23px;"></i> {{ $date }}</h3>
      @endif
      @if(is_array($posts))
         @foreach($posts as $post)
            @php
               $link = url('post/'.$post['id']);
               $title = $post['title'];
               $description = $post['description'];
               $created_at = format_date($post['created_at']);
            @endphp
            <div class="col-md-6">
               <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                  <div class="col p-4 d-flex flex-column position-static">
                     <h3 class="mb-0">
                        <a href="{{ $link }}">{{ $title }}</a>
                     </h3>
                     <div class="mb-1 text-body-secondary">
                        {{ $created_at }}
                     </div>
                     <p class="card-text mb-auto">{{ $description }}</p>
                     <a href="{{ $link }}" class="icon-link gap-1">
                        {{ trans('main.readmore') }}
                        <svg class="bi"><use xlink:href="#chevron-right"/></svg>
                     </a>
                  </div>
                  <div class="col-auto d-none d-lg-block">
                     <img src="{{ $row['image'] ? storage_url($row['image']) : '' }}" width="200">
                  </div>
               </div>
            </div>
         @endforeach
      @elseif(is_object($posts))
         @php
            $post = ${'posts'};
            $link = url('post/'.$post->id);
            $title = $post->title;
            $description = $post->description;
            $created_at = format_date($post->created_at);
         @endphp
         <div class="col-md-6">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
               <div class="col p-4 d-flex flex-column position-static">
                  <h3 class="mb-0">
                     <a href="{{ $link }}">{{ $title }}</a>
                  </h3>
                  <div class="mb-1 text-body-secondary">
                     {{ $created_at }}
                  </div>
                  <p class="card-text mb-auto">{{ $description }}</p>
                  <a href="{{ $link }}" class="icon-link gap-1">
                     {{ trans('main.readmore') }}
                     <svg class="bi"><use xlink:href="#chevron-right"/></svg>
                  </a>
               </div>
               <div class="col-auto d-none d-lg-block">
                  <img src="{{ $post->image ? storage_url($post->image) : '' }}" width="200">
               </div>
            </div>
         </div>
      @endif
      {{ $render }}
   </div>
</main>

{{ view('front.layouts.footer') }}