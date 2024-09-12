<?php
   view('admin.layouts.header', ['title' => trans('admin.users')]);
   view('admin.layouts.navbar');

   $paginate = pagination('users', 5);
   $users = $paginate['records'];
   $render = $paginate['render'];
?>


<div class="container-fluid">
   <div class="row">
      @php view('admin.layouts.sidebar') @endphp
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
         <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{ trans('admin.users') }}</h1>
         </div>
         <div class="table-responsive small">
            <table class="table table-striped table-sm">
               <thead>
                  <tr>
                     <th scope="col">#</th>
                     <th scope="col">{{ trans('user.name') }}</th>
                     <th scope="col">{{ trans('user.email') }}</th>
                     <th scope="col">{{ trans('user.mobile') }}</th>
                     <th scope="col">{{ trans('user.role') }}</th>
                     <th scope="col">{{ trans('user.status') }}</th>
                     <th scope="col">{{ trans('admin.action') }}</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($users as $user)
                     <tr>
                        <td>{{ $user['id'] }}</td>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['mobile'] }}</td>
                        <td>{{ $user['role'] }}</td>
                        <td>
                           @if($user['status'] == 'yes')
                              <i class="fa-solid fa-circle-check" style="color:green"></i>
                           @elseif($user['status'] == 'no')
                              <i class="fa-solid fa-circle-exclamation" style="color:red"></i>
                           @endif
                        </td>
                        <td>
                           <a href="{{ aurl('user/view?id='.$user['id']) }}">
                              <i class="fa-regular fa-eye"></i>
                           </a>
                           <a href="{{ aurl('user/edit?id='.$user['id']) }}">
                              <i class="fa-solid fa-pen-to-square"></i>
                           </a>
                           {{ delete_record(aurl('user/delete?id='.$user['id'])) }}
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