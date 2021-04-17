@extends('layouts.app')

@section('content')

@livewire('mini-nav-bar', ['tmp' => 3])

@if( count($machines) > 0)
    <div class="mt-md-5 mt-3">
        @foreach ($machines as $machine)
        <div class="row justify-content-center">
            <div class="col-xl-8 col-md-10">
            @livewire('display-object', ['object_id' => $machine->id])        
            </div>
        </div>
        @endforeach
    </div>
@endif

@endsection
