@extends('layouts.app')

@section('content')
<div class="row align-items-center">
    <div class="col-6">
        <h2>Pojazdy</h2>
    </div>
    <div class="col-6">
        <div class="float-right ">
            <a href="{{ route('objects.create', 1)}}" class="btn btn-success" >{{ __('object.buttons.create') }}</a>
        </div>
    </div>
</div>
<div class="row">    
    @foreach ($vehicles as $vehicle)
    <div class="col-xl-6 col-xxl-4 p-2">
        <div class="card d-flex">
            <div class="card-header text-dark py-0" style="background-color: #D4F5F5;">            
                <div class="row align-items-center ">
                    <div class="col-10 align-middle pt-2">
                        <img src="storage/svg/car.svg" width="30" height="30" alt="" class="float-left mr-3">
                        <h4 class="card-title"> {{  $vehicle->name }}
                            @if ($vehicle->plate != null) 
                                    <span class="float-end">{{  $vehicle->plate }}</span>
                            @endif
                        </h4>
                    </div>
                    <div class="col-2 px-0 ">
                        <div class="btn-group float-right p-0 d-none d-sm-block">
                            <button type="button" class="btn dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </button>
                            <div class="dropdown-menu">
                                <button class="dropdown-item" type="button">Edytuj</button>
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item" type="button" data-href="{{ route('vehicles.destroy', $vehicle->id)}}" data-toggle="modal" data-target="#confirmDelete">Usuń</button>
                                </div>
                        </div>                    
                    </div>                
                </div>
              
            </div>
            <div class="card-body py-3">                
                @php
                    $counter_max = count($vehicle->detail_ownerable);
                    $counter_half = $counter_max/2;
                @endphp
                <div class="container px-0">
                    <div class="row">
                        <div class="col-xl-6">
                            @php
                                $counter = 0;
                            @endphp
                            <div class="container px-0">
                            @for($i = 0; $i < $counter_half; $i++)
                                <div class="row">
                                    @if ($vehicle->detail_ownerable[$i]->own_name == null)
                                    <div class="col-4 text-muted">
                                        {{ $vehicle->detail_ownerable[$i]->detail_typeable->name}}: 
                                    </div>
                                    <div class="col-8" >
                                        {{ $vehicle->detail_ownerable[$i]->value}}
                                    </div>
                                    @else
                                    <div class="col-4 text-muted">
                                        {{ $vehicle->detail_ownerable[$i]->own_name}}: 
                                    </div>
                                    <div class="col-8">
                                        {{ $vehicle->detail_ownerable[$i]->value}}
                                    </div>
                                    @endif
                                </div>
                                @php
                                    $counter++;
                                @endphp
                            
                            @endfor
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="container px-0 d-none d-sm-block">
                            @for($i = $counter; $i < $counter_max; $i++)
                                <div class="row">
                                    @if ($vehicle->detail_ownerable[$i]->own_name == null)
                                    <div class="col-4 text-muted">
                                        {{ $vehicle->detail_ownerable[$i]->detail_typeable->name}}: 
                                    </div>
                                    <div class="col-8" >
                                        {{ $vehicle->detail_ownerable[$i]->value}}
                                    </div>
                                    @else
                                    <div class="col-4 text-muted">
                                        {{ $vehicle->detail_ownerable[$i]->own_name}}: 
                                    </div>
                                    <div class="col-8">
                                        {{ $vehicle->detail_ownerable[$i]->value}}
                                    </div>
                                    @endif
                                </div>
                                @php
                                    $counter++;
                                @endphp
                            
                            @endfor
                            </div>
                        </div>
                    </div>

                    <div class="row pb-0">
                        <div class="col-xl-9 pt-2">
                            <div class="d-none d-sm-block">
                            <div class="btn-group align-middle " role="group" aria-label="Basic outlined example">
                                <div class="btn btn-info px-3">Części 
                                    <span class="badge bg-light text-dark">4</span>
                                </div>
                                <div class="btn btn-info px-3">Przeglądy
                                    <span class="badge bg-light text-dark">4</span>
                                </div>
                                <div class="btn btn-info px-3">Ubezpieczenia
                                    <span class="badge bg-light text-dark">4</span>
                                </div>
                            </div>  
                            </div>
                        </div>
                        <div class="col-xl-3 py-0  pb-0">
                            <a href=" {{ route('vehicles.show', $vehicle->id) }}">
                                <button type="button" class="btn btn-primary align-middle float-right px-3">Pokaż więcej</button>
                            </a>
                        </div>                                          
                    </div>
                </div>
            </div>
        </div>  
    </div>
    @endforeach

</div>
<div class="row align-items-center">
    <div class="col-6">
        
    </div>
    <div class="col-6">
        <div class="float-right pt-4">
        <a href="{{ route('objects.create', 1)}}" class="btn btn-success" >{{ __('object.buttons.create') }}</a>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDelete">Potwierdzenie usunięcia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Czy na pewno chcesz usunąć?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Nie, anuluj</button>
        <form action="{{ route('vehicles.destroy', $vehicle->id)}}"
            method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Tak, usuń</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
