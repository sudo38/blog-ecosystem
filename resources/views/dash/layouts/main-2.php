@include('dash.layouts.header')
@include('dash.layouts.navbar')
<div class="container">
   <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">@section('title')</h1>
      @section('btn')
   </div>
   @section('form')
</div>
@include('dash.layouts.footer')