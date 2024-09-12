<?php
   view('admin.layouts.header', ['title' => trans('tag.create_tag')]);
   view('admin.layouts.navbar');

   $name_err = input_err('name');
   $desc_err = input_err('description');
?>

<div class="container">
   <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
      <h1 class="h2">{{ trans('tag.create_tag') }}</h1>
      <a href="{{ aurl('tags') }}"><i class="fa-solid fa-circle-chevron-left"></i></a>
   </div>
   <form action="{{ aurl('tag/store') }}" method="POST" enctype="multipart/form-data">
      <div class="row">
         <div class="col-md-12 mt-2">
            <div class="form-group">
               <label class="mb-1">{{ trans('tag.name') }}:</label>
               <input class="form-control {{ $name_err ? 'is-invalid' : '' }}" type="text" name="name" value="{{ old('name') }}">
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
               <textarea class="form-control {{ $desc_err ? 'is-invalid' : '' }}" name="description">{{ old('description') }}</textarea>
               @if($desc_err)
                  <div class="invalid-feedback">
                     {{ $desc_err }}
                  </div>
               @endif
            </div>
         </div>
      </div>
      <button class="btn btn-primary mt-2" type="submit">
         {{ trans('admin.create') }}
      </button>
   </form>
</div>

{{ view('admin.layouts.footer') }}