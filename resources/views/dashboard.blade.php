@extends('layouts.app')

@section('content')

@livewire('mini-nav-bar')

@if( count($favs) > 0)
    <div class="mt-md-5 mt-3">
        @foreach ($favs as $fav)
        <div class="row justify-content-center">
            <div class="col-xl-8 col-md-10">
            @livewire('display-object', ['object_id' => $fav->id])        
            </div>
        </div>
        @endforeach
    </div>
@else
<div class="mt-md-5 mt-3">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Twoja lista ulubionych jest pusta!</strong> 
    <p>
        Zaznacz ikonę gwiazdki przy Twoim pojeździe, przyczepie lub agregacie, 
        aby widzieć go na stronie głównej.
    </p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
</div>
@endif

@endsection
