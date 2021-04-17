@extends('layouts.app')

@section('content')

@livewire('mini-nav-bar', ['tmp' => 2])

<div class="mt-md-5 mt-3 mx-2">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-md-10">
            @livewire('display-object-full', ['object_id' => $trailer->id])  
        </div>
    </div>      
</div>

@endsection
