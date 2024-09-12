<?php
   $exp = explode('/' ,segment());
   $id = end($exp);
   $tag = get_items('tags', 'id', $id);

   if (!$tag){
      redirect(aurl('tags'));
   }
   
   view('admin.layouts.header', ['title' => $tag->name]);
   view('admin.layouts.navbar');

   $name_err = input_err('name');
   $desc_err = input_err('description');
?>

<div class="container">
   <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
      <h1 class="h2">{{ trans('tag.edit_tag') }}</h1>
      <a href="{{ aurl('tags') }}"><i class="fa-solid fa-circle-chevron-left"></i></a>
   </div>
   <form action="{{ aurl('tag/update/'.$tag->id) }}" method="POST" enctype="multipart/form-data">
      <div class="row">
         <div class="col-md-12">
            <div class="form-group">
               <label class="mb-1">{{ trans('tag.name') }}:</label>
               <input class="form-control {{ $name_err ? 'is-invalid' : '' }}" type="text" name="name" value="{{ $tag->name }}">
               @if($name_err)
                  <div class="invalid-feedback">
                     {{ $name_err }}
                  </div>
               @endif
            </div>
         </div>
         <div class="col-md-12 mt-2">
            <div class="form-group">
               <label class="mb-1">{{ trans('tag.description') }}:</label>
               <textarea class="form-control {{ $desc_err ? 'is-invalid' : '' }}" name="description">{{ $tag->description }}</textarea>
               @if($desc_err)
                  <div class="invalid-feedback">
                     {{ $desc_err }}
                  </div>
               @endif
            </div>
         </div>

      </div>
      <button class="btn btn-primary mt-2" type="submit">{{ trans('admin.update') }}</button>
   </form>
</div>

{{ view('admin.layouts.footer') }}