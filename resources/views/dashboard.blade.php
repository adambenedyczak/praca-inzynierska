@extends('layouts.app')

@section('content')
<div class="row px-1">
    
    @foreach ($vehicles as $vehicle)
    <div class="col-xl-6 col-xxl-4 p-2">
        <div class="card d-flex">
            <div class="card-header text-dark" style="background-color: #D4F5F5;">            
                <img src="storage/svg/car.svg" width="30" height="30" alt="" class="float-left mr-2">
                <h5> {{  $vehicle->name }}
               @if ($vehicle->plate != null) 
                    <span class="float-right">{{  $vehicle->plate }}</span>
               @endif
               </h5>
            </div>
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>  
        </div>  
    </div>
    @endforeach



    @foreach ($trailers as $trailer)
    <div class="col-xl-6 col-xxl-4 p-2">
        <div class="card d-flex">
            <div class="card-header text-dark" style="background-color: #93B7BE;">            
                <img src="storage/svg/trailer.svg" width="30" height="30" alt="" class="float-left mr-2">   
                <h5 class="mr-2"> {{  $trailer->name }}
               @if ($trailer->plate != null) 
                    <span class="float-right">{{  $trailer->plate }}</span>
               @endif
               </h5>
            </div>
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>  
        </div>  
    </div>
    @endforeach


    @foreach ($engines as $engine)
    <div class="col-xl-6 col-xxl-4 p-2">
        <div class="card d-flex" >
            <div class="card-header text-white"  style="background-color: #554348;">            
                <img src="storage/svg/mechanism.svg" width="30" height="30" alt="" class="float-left mr-2">   
                <h5> {{  $engine->name }}
               @if ($engine->plate != null) 
                    <span class="float-right">{{  $engine->plate }}</span>
               @endif
               </h5>
            </div>
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>  
        </div>  
    </div>
    @endforeach



    
</div>

@endsection
