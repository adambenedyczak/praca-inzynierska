@extends('layouts.app')

@section('content')

@livewire('mini-nav-bar', ['tmp' => 0])

@if (session()->has('message'))
    <div class="row justify-content-center">
        <div class="col-md-8 mt-md-5 mt-2">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
@endif

@if( count($objects) > 0)
    <div class="mt-md-5 mt-3">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-md-10">
                <h4>
                    Archiwum
                </h4>
            </div>
        </div>
        @foreach ($objects as $object)
        <div class="row justify-content-center">
            <div class="col-xl-8 col-md-10">
            @livewire('display-object', ['object_id' => $object->id])        
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="mt-md-5 mt-3">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-md-10">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Twoje archiwum jest puste!</strong> 

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection
