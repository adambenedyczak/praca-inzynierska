<div class="row justify-content-center m-0 p-0">
    <div class="col-12 col-md-10 col-lg-6 text-center p-0 m-0">
        <div class="btn-group shadow-sm" role="group" aria-label="Basic example">
            @if ($tmp == 1)
                <a href="{{ route('vehicles.index') }}" type="button" class="btn btn-primary">
            @else
                <a href="{{ route('vehicles.index') }}" type="button" class="btn btn-outline-primary">
            @endif
                Pojazdy
            </a>
            @if ($tmp == 2)
            <a href="{{ route('trailers.index') }}" type="button" class="btn btn-primary">
            @else
            <a href="{{ route('trailers.index') }}" type="button" class="btn btn-outline-primary">
            @endif
                Przyczepy
            </a>
            @if ($tmp == 3)
            <a href="{{ route('machines.index') }}" type="button" class="btn btn-primary">
            @else
            <a href="{{ route('machines.index') }}" type="button" class="btn btn-outline-primary">
            @endif
                Maszyny
            </a>
            <a href="{{ route('objects.create') }}" type="button" class="btn btn-outline-success">
                Nowy
            </a>
        </div>
    </div>
</div>

