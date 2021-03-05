<div id="page-content-wrapper">

    @include('layouts.navbar')

    <div class="container-fluid mt-5">
        @include('layouts.alert')
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