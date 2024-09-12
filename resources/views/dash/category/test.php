<?php
   $paginate = pagination('categories', 2);
   $categories = $paginate['records'];
   $render = $paginate['render'];
?>

@inc('admin.layouts.header', ['title' => trans('admin.categories')])
@inc('admin.layouts.navbar')

<div class="container-fluid">
   <div class="row">
      @inc('admin.layouts.sidebar')
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
         <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{ trans('admin.categories') }}</h1>
            <a href="{{ aurl('category/create') }}">
               <i class="fa-solid fa-square-plus"></i>
            </a>
         </div>
         <div class="table-responsive small">
            <table class="table table-striped table-sm">
               <thead>
                  <tr>
                     <th scope="col">#</th>
                     <th scope="col">{{ trans('category.name') }}</th>
                     <th scope="col">{{ trans('category.description') }}</th>
                     <th scope="col">{{ trans('admin.action') }}</th>
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
         {{ $render }}
      </main>
   </div>
</div>

@inc('admin.layouts.footer')