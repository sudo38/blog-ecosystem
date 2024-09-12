<!-- main title -->
@start('title')
{{ trans('dash.categories') }}
@end('title')

<!-- btn -->
@start('btn')
<a href="{{ aurl('category/create') }}">
   <i class="fa-solid fa-square-plus"></i>
</a>
@end('btn')

<!-- content -->
@start('content')
<div class="table-responsive small">
   <table class="table table-striped table-sm">
      <thead>
         <tr>
            <th scope="col">#</th>
            <th scope="col">{{ trans('category.name') }}</th>
            <th scope="col">{{ trans('category.description') }}</th>
            <th scope="col">{{ trans('dash.action') }}</th>
         </tr>
      </thead>
      <tbody>
         @foreach($categories as $category)
            <tr>
               <td>{{ $category['id'] }}</td>
               <td>{{ $category['name'] }}</td>
               <td>{{ $category['description'] }}</td>
               <td>
                  <a href="{{ aurl('category/view?id='.$category['id']) }}">
                     <i class="fa-regular fa-eye"></i>
                  </a>
                  <a href="{{ aurl('category/edit?id='.$category['id']) }}">
                     <i class="fa-solid fa-pen-to-square"></i>
                  </a>
                  {{ delete_record(aurl('category/delete?id='.$category['id'])) }}
               </td>
            </tr>
         @endforeach
      </tbody>
   </table>
</div>
{{ $links }}
@end('content')

<!-- main file -->
@extends('dash.layouts.main-1')