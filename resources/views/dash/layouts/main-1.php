@include('dash.layouts.header')
@include('dash.layouts.navbar')
<div class="container-fluid">
   <div class="row">
      @include('dash.layouts.sidebar')
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
         <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">@section('title')</h1>
            @section('btn')
         </div>
         @section('content')
      </main>
   </div>
</div>
@include('dash.layouts.footer')