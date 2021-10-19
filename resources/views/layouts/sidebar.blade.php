<div class="bg-primary" id="sidebar-wrapper">
    <div class="sidebar-heading text-white">Lista obiektów </div>
    <div class="list-group list-group-flush">
    <a href="{{ route('home') }}" class="list-group-item list-group-item-action bg-primary sidebar-heading text-white">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house-door mr-1" viewBox="0 0 16 16">
            <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
        </svg>   
        Dashboard
    </a>
    <a href="{{ route('vehicles.index') }}" class="list-group-item list-group-item-action bg-primary sidebar-heading text-white">
        <img src="{{ asset('storage/svg/car.svg') }}" width="20" height="20" alt="" class="float-left mr-2">    
        {{ __('menu.vehicles') }}
    </a>
    <a href="{{ route('trailers.index') }}" class="list-group-item list-group-item-action bg-primary sidebar-heading text-white">
        <img src="{{ asset('storage/svg/trailer.svg') }}" width="20" height="20" alt="" class="float-left mr-2">  
        {{ __('menu.trailers') }}
    </a>
    <a href="{{ route('machines.index') }}" class="list-group-item list-group-item-action bg-primary sidebar-heading text-white">
        <img src="{{ asset('storage/svg/mechanism.svg') }}" width="20" height="20" alt="" class="float-left mr-2">   
        {{ __('menu.machines') }}
    </a>
    <a href="#" class="list-group-item list-group-item-action bg-primary text-white">Dashboard</a>
    <a href="#" class="list-group-item list-group-item-action bg-primary text-white">Dashboard</a>

    </div>
    
</div>