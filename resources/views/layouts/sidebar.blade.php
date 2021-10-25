<div class="bg-primary" id="sidebar-wrapper">
    <div class="sidebar-heading text-white">Lista obiektów </div>
    <div class="list-group list-group-flush">
    <a href="{{ route('home') }}" class="list-group-item list-group-item-action bg-primary sidebar-heading text-white">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-star mr-1" viewBox="0 0 16 16">
            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
          </svg>  
        Ulubione
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
    <a href="{{ route('objects.create') }}" class="list-group-item list-group-item-action bg-primary sidebar-heading text-white">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle mr-1" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
          </svg>
         Nowy
    </a>

    </div>
    
</div>