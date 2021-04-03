<div>
    <div class="row my-2" >
        <div class="col-12">
            <div class="card border-primary shadow-sm">
                <div class="card-body">
                    <div class="container px-0">
                        <div class="row align-items-center">
                            <div class="col-lg-10 col-md-9 col-8 align-middle text-truncate">
                                @if ($objectType == 1)
                                <img src="{{ asset('storage/svg/car.svg') }}" width="20" height="20" alt="" class="float-left mr-2">
                                @elseif ($objectType == 2)
                                <img src="{{ asset('storage/svg/trailer.svg') }}" width="20" height="20" alt="" class="float-left mr-2">  
                                @elseif ($objectType == 3)
                                <img src="{{ asset('storage/svg/mechanism.svg') }}" width="20" height="20" alt="" class="float-left mr-2">        
                                @endif
                                <h5>{{ $object->name}}</h5>

                            </div>
                            <div class="col-lg-2 col-md-3 col-4 text-center">
                                @if ($ifDelete == false)
                                <div class="btn-group float-left" role="group" >
                                    <a href="#" class="btn btn-link px-0" wire:click="toggleFav">
                                        @if($fav == false)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                            </svg>
                                        @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                        </svg>
                                        @endif                                
                                    </a>
                                    <div class="btn-group dropdown ">
                                        <button type="button" class="btn dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-controls="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu" >
                                            <button class="dropdown-item" type="button">Edytuj</button>
                                            <div class="dropdown-divider"></div>
                                            <button wire:click="setDelete()" class="dropdown-item" type="button">Usuń</button>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
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
                                        <div class="col-12 text-muted small">
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
                        <div class="row">
                            <div class="col-md-6 ">
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
                        <div class="row justify-content-center mt-3">
                            @if ($ifDelete == false)
                            <div class="col-6 col-md-8">
                                <div class="d-none d-sm-block">
                                    @if ($parts > 0)
                                    <button type="button" class="btn btn-outline-primary float-left m-1">
                                        <img src="{{ asset('storage/svg/part.svg')}}" width="20" height="20" alt="" class="float-left">
                                        <span class="badge badge-primary ml-1 mb">{{ $parts }}</span>
                                    </button>
                                    @endif
                                    @if ($overviews > 0)
                                    <button type="button" class="btn btn-outline-primary float-left m-1">
                                        <img src="{{ asset('storage/svg/overview.svg')}}" width="20" height="20" alt="" class="float-left">
                                        <span class="badge badge-primary ml-1 mb">{{ $overviews }}</span>
                                    </button>
                                    @endif
                                    @if ($insurances > 0)
                                    <button type="button" class="btn btn-outline-primary float-left m-1">
                                        <img src="{{ asset('storage/svg/insurance.svg')}}" width="20" height="20" alt="" class="float-left">
                                        <span class="badge badge-primary ml-1 mb">{{ $parts }}</span>
                                    </button>
                                    @endif
                                </div>
                            </div>                            
                            <div class="col-6 col-md-4 ">                                
                                <button wire:click="showMore" type="button" class="btn btn-outline-primary btn-block m-1">
                                    Pokaż więcej
                                </button>                                
                            </div>
                            @else
                            <div class="col-12 col-md-8 ">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="lead">Czy na pewno chcesz usunąć?</span>
                                        </div>
                                    </div>
                                    <div class="row pt-2">
                                        <div class="col-12">
                                            <div class="btn-group btn-block" role="group" >
                                                <button wire:click="cancelDelete" type="button" class="btn btn-outline-success">Anuluj</button>
                                                <button wire:click="confirmDelete" type="button" class="btn btn-danger">Usuń</button>
                                            </div>  
                                        </div>
                                    </div>
                                </div>                                                              
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
