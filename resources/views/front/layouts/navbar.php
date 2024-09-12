<?php
   view('front.layouts.view-mode');

   $categories = get_items('categories');
?>

<div class="container">
   <header class="border-bottom lh-1 py-3">
      <div class="row flex-nowrap justify-content-between align-items-center">
         <div class="col-4 pt-1">
            <a class="btn btn-sm btn-outline-secondary mx-3" href="#">Sign up</a>
         </div>
         <div class="col-4 text-center">
            <a class="blog-header-logo text-body-emphasis text-decoration-none" href="{{ url('/') }}">Large</a>
         </div>
         <div class="col-4 d-flex justify-content-end align-items-center">
            <ul class="nav nav-pills">
               @if(session('locale') == 'ar')
                  <li class="nav-item">
                     <a href="{{ url('lang?lang=en') }}" class="btn btn-sm btn-outline-secondary">En</a>
                  </li>
               @else
                  <li class="nav-item">
                     <a href="{{ url('lang?lang=ar') }}" class="btn btn-sm btn-outline-secondary">ع</a>
                  </li>
               @endif
            </ul>
         </div>
      </div>
   </header>
   <div class="nav-scroller py-1 mb-3 border-bottom">
      <nav class="nav nav-underline justify-content-between">
         @php $act = segment() == '/blog/public/' ? 'active' : '' @endphp
         <a class="nav-item nav-link link-body-emphasis {{ $act }}" href="{{ url('/') }}">
            {{ trans('main.home') }}
         </a>
         @foreach($categories as $category)
            @php
               $active = (isset($id) && $id == $category['id']) ? 'active' : '';
               $link = url('category/'.$category['id']);
               $category = $category['name'];
            @endphp
            <a class="nav-item nav-link link-body-emphasis {{ $active }}" href="{{ $link }}">{{ $category }}</a>
         @endforeach
      </nav>
   </div>
</div>