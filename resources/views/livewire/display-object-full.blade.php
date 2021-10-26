<div>
    @if (session()->has('message'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row justify-content-center my-3">
        <div class="col-lg-10 col-md-9 col-8 align-middle "> 
            @if ($objectType == 1)
            <img src="{{ asset('storage/svg/car.svg') }}" width="40" height="40" alt="" class="float-left mr-3">
            @elseif ($objectType == 2)
            <img src="{{ asset('storage/svg/trailer.svg') }}" width="40" height="40" alt="" class="float-left mr-3">  
            @elseif ($objectType == 3)
            <img src="{{ asset('storage/svg/mechanism.svg') }}" width="40" height="40" alt="" class="float-left mr-3">        
            @endif            
            <h3 class="">{{ $object_name }}
                @if($isArchival == true)
                    <span class="badge badge-secondary">Archiwalny</span>
                @endif
            </h3>
            
        </div>
        <div class="col-lg-2 col-md-3 col-4">
            @if ($ifDelete == false)
            <div class="btn-group float-left" role="group" >
                @if($isArchival == false)
                    @if($fav == false)
                        <a href="#" class="btn btn-link px-0" wire:click="toggleFav" data-toggle="tooltip" data-placement="left" title="Dodaj do ulubionych">         
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                            </svg>
                        </a>
                    @else
                        <a href="#" class="btn btn-link px-0" wire:click="toggleFav" data-toggle="tooltip" data-placement="left" title="Usuń z ulubionych"> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg>
                        </a>
                    @endif  
                @endif                               
                
                <div class="btn-group dropdown ">
                    <button type="button" class="btn dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-controls="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </button>
                    <div class="dropdown-menu" >
                        <a href="{{ route('objects.edit', $object->id) }}" class="btn dropdown-item" >Edytuj</a>
                        <div class="dropdown-divider"></div>
                        @if($isArchival == false)
                            <button wire:click="$set('ifSetArchival', true)" class="dropdown-item" type="button">Archiwizuj</button>
                        @else
                            <button wire:click="$set('ifSetArchival', true)" class="dropdown-item" type="button">Przywróć</button>
                        @endif
                        <button wire:click="$set('ifDelete', true)" class="dropdown-item" type="button">Usuń</button>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    @if($ifDelete == true)
    <div class="row justify-content-center ">        
        <div class="col-12 col-md-8 ">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <span class="lead">Czy na pewno chcesz usunąć?</span>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-12">
                        <div class="btn-group btn-block" role="group" >
                            <button wire:click="confirmDelete" type="button" class="btn btn-danger">Usuń</button>
                            <button wire:click="$set('ifDelete', false)" type="button" class="btn btn-outline-success">Anuluj</button>
                        </div>  
                    </div>
                </div>
            </div>                                                              
        </div>        
    </div>
    @endif
    @if($ifSetArchival == true)
    <div class="row justify-content-center ">        
        <div class="col-12 col-md-8 ">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        @if($isArchival == false)
                            <span class="lead">Czy na pewno chcesz przenieść do archiwum?</span>
                        @else
                            <span class="lead">Czy chcesz przywrócić z archiwum?</span>
                        @endif
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-12">
                        <div class="btn-group btn-block" role="group" >
                            @if($isArchival == false)
                                <button wire:click="confirmSetArchival" type="button" class="btn btn-warning">Archiwizuj</button>
                            @else
                                <button wire:click="confirmSetArchival" type="button" class="btn btn-success">Przywróć</button>
                            @endif                           
                            <button wire:click="$set('ifSetArchival',  false)" type="button" class="btn btn-outline-success">Anuluj</button>
                        </div>  
                    </div>
                </div>
            </div>                                                              
        </div>        
    </div>
    @endif
        @if($workTimeValue != null)
            <div class="row">
                <div class="col-md-6">
                    <div class="container">
                        <div class="row">
                            <div class="col-5 text-muted">
                                Przebieg:  
                            </div>
                            <div class="col-7" >
                                {{ number_format($workTimeValue->value,0,""," ") }} {{ $object->work_time_unit->short }} 
                            </div>
                        </div>                                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 text-muted">
                                (ostatnia aktualizacja: {{ $workTimeValue->created_at->format('d-m-Y') }})
                            </div>
                        </div>                                        
                    </div>
                </div>
            </div>
            <div>
                <hr class="my-2"/>
            </div>
        @endif
        <div class="row my-3">
            @if(count($details) > 0)
            <div class="col-md-6">
                <div class="container">
                    @foreach ($details as $detail)
                    <div class="row">
                        <div class="col-5 text-muted">
                            {{ $detail->detail_typeable->name}}: 
                        </div>
                        <div class="col-7" >
                            {{ $detail->value}}
                        </div>
                    </div>                                        
                    @endforeach
                </div>
            </div>
            @endif
            <div class="col-md-6">
                <div class="container">
                    @foreach ($ownDetails as $detail)
                    <div class="row">
                        <div class="col-5 text-muted">
                            {{ $detail->own_name}}: 
                        </div>
                        <div class="col-7" >
                            {{ $detail->value}}
                        </div>
                    </div>                                        
                    @endforeach
                </div>
            </div>
        </div>
    <div>
        <hr/>
    </div>
    <div>
        @livewire('display-elements', ['object_id' => $object->id, 'openSection' => $openSection], key($object->id)) 
    </div>
</div>
