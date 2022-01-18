<div id="page-content-wrapper">

    @include('layouts.navbar')
    <div class="container-xl mt-md-3 mt-xl-5 p-0">
        @include('layouts.alert')
        <div class="m-2 mt-3 pt-5 mb-4">
          @yield('content')      
        </div>
    </div>
</div>

@section('js-scripts')
<script>
    $('#menu-toggle').click(function(e) {
      e.preventDefault();
      $('#wrapper').toggleClass('toggled');
    });
    $(function () {
      $('[data-toggle"tooltip"]').tooltip()
    })
  </script>
  
@endsection