<?php
   $exp = explode('/' ,segment());
   $id = end($exp);
   $category = get_items('categories', 'id', $id);

   if(!$category){
      redirect(url('/'));
   }

   $posts = get_items('posts', 'category_id', $category->id);

   view('front.layouts.header', ['title' => $category->name]);
   view('front.layouts.navbar', ['id' => $id]);
?>

<main class="container">
   <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
      <div class="col-lg-6 px-0">
         <h1 class="display-4 fst-italic">{{ $category->name }}</h1>
         <p class="lead my-3">{{ $category->description }}</p>
      </div>
   </div>
   <div class="row mb-2">
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
            $title = $post->title;
            $link = url('post/'.$post->id);
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
                     <img src="{{ $row['image'] ? storage_url($row['image']) : '' }}" width="200">
                  </div>
               </div>
         </div>
      @else
         <!-- <h3 class="text-center" style="padding: 100px">Record Not Found</h3> -->
      @endif
   </div>
</main>

{{ view('front.layouts.footer') }}