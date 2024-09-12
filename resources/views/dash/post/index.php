<?php
   view('dash.layouts.header', ['title' => trans('dash.posts')]);
   view('dash.layouts.navbar');

   if (request('user_id')){
      $key = 'user_id';
      $value = request($key);
      $posts_id = [];
      $subtitle = subtitle($value, 'users', 'id', 'user/view?id=', aurl('posts'));

   }  elseif (request('category_id')){
      $key = 'category_id';
      $value = request($key);
      $posts_id = [];
      $subtitle = subtitle($value, 'categories', 'id', 'category/view?id=', aurl('posts'));

   } elseif (request('tag_id')){
      $key = null;
      $value = null;
      $posts_id = posts_related_tag('tags', 'tag_id');
      $subtitle = subtitle(request('tag_id'), 'tags', 'id', 'tag/', aurl('posts'));

   } elseif(request('p')){
   } else {
      $key = null;
      $value = null;
      $posts_id = [];
      clear_url();
   }

   $posts = fetch_items('posts', '
      posts.*,
      users.id as user_id,
      users.name as author,
      categories.id as category_id,
      categories.name as category', '
      JOIN users ON posts.user_id = users.id
      JOIN categories ON posts.category_id = categories.id',
      $posts_id, $key, $value
   );


   $paginate = pagination($posts, 10);
   $posts = $paginate['records'];
   $render = $paginate['render'];
?>


<div class="container-fluid">
   <div class="row">
      @php view('dash.layouts.sidebar') @endphp
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
         <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{ trans('dash.posts') }}{{ isset($subtitle) ? $subtitle : '' }}</h1>
            <a href="{{ aurl('post/create') }}"><i class="fa-solid fa-square-plus"></i></a>
         </div>
         <div class="table-responsive small">
            <table class="table table-striped table-sm">
               <thead>
                  <tr>
                     <th scope="col">#</th>
                     <th scope="col">{{ trans('post.title') }}</th>
                     <th scope="col">{{ trans('post.description') }}</th>
                     <th scope="col">{{ trans('post.author') }}</th>
                     <th scope="col">{{ trans('post.category') }}</th>
                     <th scope="col">{{ trans('post.tags') }}</th>
                     <th scope="col">{{ trans('dash.created_at') }}</th>
                     <th scope="col">{{ trans('dash.updated_at') }}</th>
                     <th scope="col">{{ trans('dash.action') }}</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($posts as $post)
                     <tr>
                        <td>{{ $post['id'] }}</td>
                        <td>{{ $post['title'] }}</td>
                        <td>{{ $post['description'] }}</td>
                        <td>
                           <a href="{{ aurl('posts?user_id='.$post['user_id']) }}">
                           {{ $post['author'] }}
                           </a>
                        </td>
                        <td>
                           <a href="{{ aurl('posts?category_id='.$post['category_id']) }}">
                           {{ $post['category'] }}
                           </a>
                        </td>
                        <td>
                           @php $tags = tags_related_post('posts', $post['id']) @endphp
                           @foreach($tags as $tag_id => $tag_name)
                              <a href="{{ aurl('posts?tag_id='.$tag_id) }}">
                              {{ $tag_name.', ' }}
                              </a>
                           @endforeach
                        </td>
                        <td>{{ $post['created_at'] }}</td>
                        <td>{{ $post['updated_at'] }}</td>
                        <td>
                           <a href="{{ aurl('post/view?id='.$post['id']) }}">
                              <i class="fa-regular fa-eye"></i>
                           </a>
                           <a href="{{ aurl('post/edit?id='.$post['id']) }}">
                              <i class="fa-solid fa-pen-to-square"></i>
                           </a>
                           {{ delete_record(aurl('post/delete?id='.$post['id'])) }}
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
{{ view('dash.layouts.footer') }}