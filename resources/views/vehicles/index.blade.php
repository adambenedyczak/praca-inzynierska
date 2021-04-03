@extends('layouts.app')

@section('content')

@livewire('mini-nav-bar', ['tmp' => 1])

@if( count($vehicles) > 0)
    <div class="mt-md-5 mt-3">
        @foreach ($vehicles as $vehicle)
        <div class="row justify-content-center">
            <div class="col-xl-8 col-md-10">
            @livewire('display-object', ['object_id' => $vehicle->id])        
            </div>
        </div>
        @endforeach
    </div>
@endif

@endsection
