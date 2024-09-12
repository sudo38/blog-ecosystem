<?php
   view('admin.layouts.header', ['title' => trans('posts.create_posts')]);
   view('admin.layouts.navbar');

   $categories = get_items('categories'); 
   $tags = get_items('tags');

   $title_err = input_err('title');
   $image_err = input_err('image');
   $content_err = input_err('content');
   $category_err = input_err('category_id');
   $tags_err = input_err('tags');
   $desc_err = input_err('description');
?>

<div class="container">
   <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">{{ trans('post.create_post') }}</h1>
      <a href="{{ aurl('posts') }}"><i class="fa-solid fa-circle-chevron-left"></i></a>
   </div>
   <form action="{{ aurl('post/store') }}" method="POST" enctype="multipart/form-data">
      <div class="row">
         <div class="col-md-6 mt-2">
            <div class="form-group">
               <label class="mb-1">{{ trans('post.title') }}:</label>
               <input class="form-control {{ $title_err ? 'is-invalid' : '' }}" type="text" name="title" value="{{ old('title') }}">
               @if($title_err)
                  <div class="invalid-feedback">
                     {{ $title_err }}
                  </div>
               @endif
            </div>
         </div>
         <div class="col-md-6 mt-2">
            <div class="form-group">
               <label class="mb-1">{{ trans('post.image') }}:</label>
               <input class="form-control {{ $image_err ? 'is-invalid' : '' }}" type="file" name="image">
               @if($image_err)
                  <div class="invalid-feedback">
                     {{ $image_err }}
                  </div>
               @endif
            </div>
         </div>
         <div class="col-md-6 mt-2">
            <div class="form-group">
               <label class="mb-1">{{ trans('post.category') }}:</label>
               <select class="form-control {{ $category_err ? 'is-invalid' : '' }}" name="category_id">
                  <option disabled selected>--</option>
                  @foreach($categories as $category)
                     <option value="{{ $category['id'] }}" {{ ($category['id'] == old('category_id')) ? 'selected' : '' }}>
                        {{ $category['name'] }}
                     </option>
                  @endforeach
               </select>
               @if($category_err)
                  <div class="invalid-feedback">
                     {{ $category_err }}
                  </div>
               @endif
            </div>
         </div>

         <div class="col-md-6 mt-2">
            <div class="form-group">
                  <label>Select your options:</label><br>
                  @foreach($tags as $tag)
                     <input type="checkbox" class="form-check-input" name="tag_{{$tag['id']}}" id="{{$tag['id']}}" value="{{$tag['id']}}">
                     <label class="form-check-label mb-1" for="{{$tag['id']}}">{{$tag['name']}}</label><br>
                  @endforeach
            </div>
         </div>

         <div class="col-md-12 mt-2">
            <div class="form-group">
               <label class="mb-1">{{ trans('post.description') }}:</label>
               <textarea class="form-control {{ $desc_err ? 'is-invalid' : '' }}" name="description">{{ old('description') }}</textarea>
               @if($desc_err)
                  <div class="invalid-feedback">
                     {{ $desc_err }}
                  </div>
               @endif
            </div>
         </div>
         <div class="col-md-12 mt-2">
            <div class="form-group">
               <label class="mb-1">{{ trans('post.content') }}:</label>
               <textarea class="form-control {{ $content_err ? 'is-invalid' : '' }}" name="content">{{ old('content') }}</textarea>
               @if($content_err)
                  <div class="invalid-feedback">
                     {{ $content_err }}
                  </div>
               @endif
            </div>
         </div>
      </div>
      <button class="btn btn-primary mt-2" type="submit">{{ trans('admin.create') }}</button>
   </form>
</div>

{{ view('admin.layouts.footer') }}