<!-- main title -->
@start('title')
{{ trans('category.create_category') }}
@end('title')

<!-- btn -->
@start('btn')
<a href="{{ aurl('categories') }}">
   <i class="fa-solid fa-circle-chevron-left"></i>
</a>
@end('btn')

<!-- form -->
@start('form')
<form action="{{ aurl('category/store') }}" method="POST" enctype="multipart/form-data">
   <div class="row">
      <div class="col-md-12 mt-2">
         <div class="form-group">
            <label class="mb-1">{{ trans('category.name') }}:</label>
            <input class="form-control {{ $name ? 'is-invalid' : '' }}" type="text" name="name" value="{{ old('name') }}">
            @error('name')
               <div class="invalid-feedback">
                  {{ $name }}
               </div>
            @enderror
         </div>
      </div>
      <div class="col-md-12 mt-2">
         <div class="form-group">
            <label class="mb-1">{{ trans('category.description') }}:</label>
            <textarea class="form-control {{ $desc ? 'is-invalid' : '' }}" name="description">{{ old('description') }}</textarea>
            @error('desc')
               <div class="invalid-feedback">
                  {{ $desc }}
               </div>
            @enderror
         </div>
      </div>
   </div>
   <button class="btn btn-primary mt-2" type="submit">{{ trans('dash.create') }}</button>
</form>
@end('form')

<!-- main file -->
@extends('dash.layouts.main-2')