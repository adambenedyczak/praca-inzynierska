@extends('layouts.app')

@section('content')

<div class="container px-0">
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-7">
        @livewire('create-element-part', ['parent' => $parent, 'id' => $id ])
            
    </div>
</div>
</div>


@endsection