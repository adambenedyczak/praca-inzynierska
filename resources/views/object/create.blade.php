@extends('layouts.app')

@section('content')

<div class="container px-0">
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-7">
        
        @if( $id == 1)
            @livewire('create-object-vehicle')
        @elseif( $id == 2)
            @livewire('create-object-trailer')
        @elseif ( $id == 3)
            @livewire('create-object-machine')
        @endif
            
    </div>
</div>
</div>


@endsection