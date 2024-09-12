<!-- main title -->
@start('title')
{{ trans('category.edit_category') }}
@end('title')

<!-- btn -->
@start('btn')
<a href="{{ aurl('categories') }}">
   <i class="fa-solid fa-circle-chevron-left"></i>
</a>
@end('btn')

<!-- form -->
@start('form')
<form action="{{ aurl('category/update') }}" method="POST" enctype="multipart/form-data">
   <div class="row">
      <div class="col-md-6 mt-2">
         <div class="form-group">
            <label class="mb-1">{{ trans('category.name') }}:</label>
            <input type="hidden" name="id" value="{{ request('id') }}">
            <input class="form-control {{ $name_err ? 'is-invalid' : '' }}" type="text" name="name" value="{{ $category->name }}">
            @if($name_err)
               <div class="invalid-feedback">
                  {{ $name_err }}
               </div>
            @endif
         </div>
      </div>
      <div class="col-md-12 mt-2">
         <div class="form-group">
            <label class="mb-1">{{ trans('category.description') }}:</label>
            <textarea class="form-control {{ $desc_err ? 'is-invalid' : '' }}" name="description">{{ $category->description }}</textarea>
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
@end('form')

<!-- main file -->
@extends('admin.layouts.main-2')