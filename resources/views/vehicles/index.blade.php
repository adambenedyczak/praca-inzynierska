@extends('layouts.app')

@section('content')
<div class="row align-items-center">
    <div class="col-6">
        <h2>Moje pojazdy</h2>
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
            <div class="card-header text-dark" style="background-color: #D4F5F5;">            
                <div class="row align-items-center">
                    <div class="col-10 align-middle">
                        <img src="storage/svg/car.svg" width="30" height="30" alt="" class="float-left mr-2">
                        <h5> {{  $vehicle->name }}
                            @if ($vehicle->plate != null) 
                                    <span class="float-end">{{  $vehicle->plate }}</span>
                            @endif
                        </h5>
                    </div>
                    <div class="col-2 px-0">
                        <div class="btn-group float-right">
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
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                
                @foreach($vehicle->detail_ownerable as $detail)
                    <div>
                    @if ($detail->own_name == null)
                        {{ $detail->detail_typeable->name}}: {{ $detail->value}}
                    @else
                        {{ $detail->own_name}}: {{ $detail->value}}
                    @endif
                    </div>
                
                @endforeach
                <div>
                    <button type="button" class="btn btn-outline-primary">
                    Części <span class="badge bg-primary text-white">4</span>
                    </button>

                    <button type="button" class="btn btn-outline-primary">
                    Przeglądy <span class="badge bg-primary text-white">4</span>
                    </button>

                    <button type="button" class="btn btn-outline-primary">
                    Ubezpieczenia <span class="badge bg-primary text-white">4</span>
                    </button>

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
        <div class="float-right ">
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
