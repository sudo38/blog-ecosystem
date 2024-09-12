      
      @if(preg_match('#^dash/.+/create$#', segment()))
         @php session_forget('old'); @endphp
      @endif
      <script src="{{ asset('js/custom.js') }}"></script>
      <script src="{{ asset('js/color-modes.js') }}"></script>
      <script src="{{ asset('dash/js/dashboard.js') }}"></script>
      <script src="{{ asset('plugins/font-awesome/v6.5/js/all.min.js') }}"></script>
      <script src="{{ asset('plugins/bootstrap/v5.3/js/bootstrap.bundle.min.js') }}"></script>
   </body>
</html>