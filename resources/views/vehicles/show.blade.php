@extends('layouts.app')

@section('content')

@livewire('mini-nav-bar', ['tmp' => 1])

<div class="mt-md-5 mt-3 mx-2">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-md-10">
            @livewire('display-object-full', ['object_id' => $vehicle->id, 'openSection' => $openSection])  
        </div>
    </div>      
</div>

@endsection
