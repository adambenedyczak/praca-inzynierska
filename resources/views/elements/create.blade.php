@extends('layouts.app')

@section('content')

<div class="container px-0">
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-7">
        
        @if( $id == 1)
            @livewire('create-element-part', ['parent' => $parent, 'id' => $id ])
        @elseif( $id == 2)
            @livewire('create-element-overview', ['parent' => $parent, 'id' => $id ])
        @elseif ( $id == 3)
            @livewire('create-element-insurance', ['parent' => $parent, 'id' => $id ])
        @endif
            
    </div>
</div>
</div>


@endsection