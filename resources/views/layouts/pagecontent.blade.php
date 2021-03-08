<div id="page-content-wrapper">

    @include('layouts.navbar')
    @guest
        <div class="container-fluid mt-5 container-guest">
    @else
        <div class="container-fluid mt-5 container-login">
            @include('layouts.alert')
    @endauth
        @yield('content')
    </div>
</div>

@section('js-scripts')
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
@endsection