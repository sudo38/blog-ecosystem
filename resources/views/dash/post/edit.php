<?php
   $post = get_items('posts', 'id', request('id'));

   if(!$post){
      redirect(aurl('posts'));
   }
   
   view('admin.layouts.header', ['title' => $post->title]);
   view('admin.layouts.navbar');

   $categories = get_items('categories');
   $tags = get_items('tags');

   $title_err = input_err('title');
   $image_err = input_err('image');
   $content_err = input_err('content');
   $category_err = input_err('category_id');
   // $tag_err = input_err('tag_id');
   $desc_err = input_err('description');
?>

<div class="container">
   <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">{{ trans('post.edit_post') }}</h1>
      <a href="{{ aurl('posts') }}"><i class="fa-solid fa-circle-chevron-left"></i></a>
   </div>
   <form action="{{ aurl('post/update') }}" method="POST" enctype="multipart/form-data">
      <div class="row">
         <div class="col-md-6 mt-2">
            <div class="form-group">
               <label>{{ trans('post.title') }}:</label>
               <input type="hidden" name="id" value="{{ request('id') }}">
               <input class="form-control {{ $title_err ? 'is-invalid' : '' }}" type="text" name="title" value="{{ $post->title }}">
               @if($title_err)
                  <div class="invalid-feedback">
                     {{ $title_err }}
                  </div>
               @endif
            </div>
         </div>
         <div class="col-md-6 mt-2">
            <div class="form-group">
               <label>{{ trans('post.image') }}:</label>
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
               <label>{{ trans('post.category') }}:</label>
               <select class="form-control {{ $category_err ? 'is-invalid' : '' }}" name="category_id">
                  <option disabled>--</option>
                  @foreach($categories as $category)
                     <option value="{{ $category['id'] }}" {{ ($category['id'] == $post->category_id) ? 'selected' : '' }}>
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
         <!-- <div class="col-md-6 mt-2">
            <div class="form-group">
               <label>{{ trans('post.tag') }}:</label>
               <select class="form-control" name="tag_id">
                  <option disabled>--</option>
                  @foreach($tags as $tag)
                     <option value="{{ $tag['id'] }}" {{ ($tag['id'] == $post->tag_id) ? 'selected' : '' }}>
                        {{ $tag['name'] }}
                     </option>
                  @endforeach
               </select>
               @if($tag_err)
                  <div class="invalid-feedback">
                     {{ $tag_err }}
                  </div>
               @endif
            </div>
         </div> -->
         <div class="col-md-12 mt-2">
            <div class="form-group">
               <label>{{ trans('post.description') }}:</label>
               <textarea class="form-control {{ $desc_err ? 'is-invalid' : '' }}" name="description">{{ $post->description }}</textarea>
               @if($desc_err)
                  <div class="invalid-feedback">
                     {{ $desc_err }}
                  </div>
               @endif
            </div>
         </div>
         <div class="col-md-12 mt-2">
            <div class="form-group">
               <label>{{ trans('post.content') }}:</label>
               <textarea class="form-control {{ $content_err ? 'is-invalid' : '' }}" name="content">{{ $post->content }}</textarea>
               @if($content_err)
                  <div class="invalid-feedback">
                     {{ $content_err }}
                  </div>
               @endif
            </div>
         </div>
      </div>
      <button class="btn btn-primary mt-2" type="submit">{{ trans('admin.update') }}</button>
   </form>
</div>
{{ view('admin.layouts.footer') }}