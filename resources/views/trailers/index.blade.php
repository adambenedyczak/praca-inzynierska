@extends('layouts.app')

@section('content')

@livewire('mini-nav-bar', ['tmp' => 2])

@if( count($trailers) > 0)
    <div class="mt-md-5 mt-3">
        @foreach ($trailers as $trailer)
        <div class="row justify-content-center">
            <div class="col-xl-8 col-md-10">
            @livewire('display-object', ['object_id' => $trailer->id])        
            </div>
        </div>
        @endforeach
    </div>
@endif

@endsection
