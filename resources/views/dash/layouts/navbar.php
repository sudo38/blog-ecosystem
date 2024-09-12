<header class="navbar sticky-top flex-md-nowrap p-0" data-bs-theme="dark">
   <a class="circle" href="{{ aurl('profile') }}">
      {{ substr(auth(DASH)->name, 0, 1) }}
   </a>
   <ul class="nav">
      @if(session('locale') == 'ar')
         <li class="nav-item"><a href="{{ url('lang?lang=en') }}" class="nav-link">En</a></li>
      @else
         <li class="nav-item"><a href="{{ url('lang?lang=ar') }}" class="nav-link">ع</a></li>
      @endif
   </ul>
</header>

<style>
   header {
      background: #fff;
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.03);
   }
   .circle {
      width: 32px;
      height: 32px;
      color: white;
      margin-left: 7px;
      font-size: 17px;
      display: flex;
      border-radius: 50%;
      justify-content: center;
      align-items: center;
      background-color: #0b5ed7;
   }
</style>
