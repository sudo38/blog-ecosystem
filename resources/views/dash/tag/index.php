<?php
   view('admin.layouts.header', ['title' => trans('admin.tags')]);
   view('admin.layouts.navbar');

   $paginate = pagination('tags', 5);
   $tags = $paginate['records'];
   $render = $paginate['render'];
?>

<div class="container-fluid">
   <div class="row">
      @php view('admin.layouts.sidebar') @endphp
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
         <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{ trans('admin.tags') }}</h1>
            <a href="{{ aurl('tag/create') }}"><i class="fa-solid fa-square-plus"></i></a>
         </div>
         <div class="table-responsive small">
            <table class="table table-striped table-sm">
               <thead>
                  <tr>
                     <th scope="col">#</th>
                     <th scope="col">{{ trans('tag.name') }}</th>
                     <th scope="col">{{ trans('tag.description') }}</th>
                     <th scope="col">{{ trans('admin.action') }}</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($tags as $tag)
                     <tr>
                        <td>{{ $tag['id'] }}</td>
                        <td>{{ $tag['name'] }}</td>
                        <td>{{ $tag['description'] }}</td>
                        <td>
                           <a href="{{ aurl('tag/'.$tag['id']) }}">
                              <i class="fa-regular fa-eye"></i>
                           </a>
                           <a href="{{ aurl('tag/edit/'.$tag['id']) }}">
                              <i class="fa-solid fa-pen-to-square"></i>
                           </a>
                           {{ delete_record(aurl('tag/delete/'.$tag['id'])) }}
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
{{ view('admin.layouts.footer') }}