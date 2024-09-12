<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
   <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
      <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
         <ul class="nav flex-column mb-auto">
         <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="{{ aurl('/') }}" class="nav-link">
               <i class="fa-solid fa-chart-line"></i>
               {{ trans('dash.dashboard') }}
            </a>
         </li>
         <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="{{ aurl('posts') }}" class="nav-link">
               <i class="fa-regular fa-newspaper"></i>
               {{ trans('dash.posts') }}
            </a>
         </li>
         <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="{{ aurl('tags') }}">
               <i class="fa-solid fa-tag"></i>
               {{ trans('dash.tags') }}
            </a>
         </li>
         <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="{{ aurl('categories') }}">
               <i class="fa-solid fa-table-list"></i>
               {{ trans('dash.categories') }}
            </a>
         </li>
         <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="{{ aurl('users') }}" class="nav-link">
               <i class="fa fa-users"></i>
               {{ trans('dash.users') }}
            </a>
         </li>
         <hr>
         <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="{{ aurl('settings') }}" class="nav-link">
               <i class="fa-solid fa-gear"></i>
               {{ trans('dash.settings') }}
            </a>
         </li>
         <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="{{ url('logout') }}" class="nav-link">
               <i class="fa-solid fa-right-from-bracket"></i>
               {{ trans('main.logout') }}
            </a>
         </li>
         </ul>
      </div>
   </div>
</div>