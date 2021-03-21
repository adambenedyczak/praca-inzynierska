@extends('layouts.app')

@section('content')
<div class="container px-0">
    <div class="row justify-content-center">
        <div class="col-10">
            <img src="storage/svg/car.svg" width="30" height="30" alt="" class="float-left mr-3">    
            <h2 class="pb-3">{{ $vehicle->name }} </h2>
        </div>
        <div class="col-2">
            <div class="btn-group dropdown float-right">
                <button type="button" class="btn dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-controls="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                </button>
                <div class="dropdown-menu" >
                    <button class="dropdown-item" type="button">Edytuj</button>
                    <div class="dropdown-divider"></div>
                    <button class="dropdown-item" type="button" data-href="{{ route('vehicles.destroy', $vehicle->id)}}" data-toggle="modal" data-target="#confirmDelete">Usuń</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @php
            $counter_max = count($vehicle->detail_ownerable);
            $counter_half = $counter_max/2;
        @endphp
        <div class="container px-0">
            <div class="row">
                <div class="col-md-6">
                    @php
                        $counter = 0;
                    @endphp
                    <div class="container">
                    @for($i = 0; $i < $counter_half; $i++)
                        <div class="row">
                            @if ($vehicle->detail_ownerable[$i]->own_name == null)
                            <div class="col-5 text-muted">
                                {{ $vehicle->detail_ownerable[$i]->detail_typeable->name}}: 
                            </div>
                            <div class="col-7" >
                                {{ $vehicle->detail_ownerable[$i]->value}}
                            </div>
                            @else
                            <div class="col-5 text-muted">
                                {{ $vehicle->detail_ownerable[$i]->own_name}}: 
                            </div>
                            <div class="col-7">
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
                <div class="col-md-6">
                    <div class="container">
                    @for($i = $counter; $i < $counter_max; $i++)
                        <div class="row">
                            @if ($vehicle->detail_ownerable[$i]->own_name == null)
                            <div class="col-5 text-muted">
                                {{ $vehicle->detail_ownerable[$i]->detail_typeable->name}}: 
                            </div>
                            <div class="col-7" >
                                {{ $vehicle->detail_ownerable[$i]->value}}
                            </div>
                            @else
                            <div class="col-5 text-muted">
                                {{ $vehicle->detail_ownerable[$i]->own_name}}: 
                            </div>
                            <div class="col-7">
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
            <div class="px-2">
                <hr>
            </div>
        <div>
    </div>
    <div class="row px-2 justify-content-md-center ">
        <div class="col-md-4 py-1 d-none d-md-block">
            <a href="#" >
                <button type="button" class="btn btn-primary"> 
                    <img src="storage/svg/part.svg" width="20" height="20" alt="" class="float-left mr-3">
                     Dodaj część 
                </button>
            </a>
        </div>
        <div class="col-md-4 py-1 d-none d-md-block">
            <a href="#" >
                <button type="button" class="btn btn-primary"> 
                    <img src="storage/svg/overview.svg" width="20" height="20" alt="" class="float-left mr-3">
                     Dodaj część 
                </button>
            </a>
        </div>
        <div class="col-md-4 py-1 d-none d-md-block">
            <a href="#" >
                <button type="button" class="btn btn-primary"> 
                    <img src="storage/svg/insurance.svg" width="20" height="20" alt="" class="float-left mr-3">
                     Dodaj część 
                </button>
            </a>
        </div>
    </div>
    <div class="row px-3 d-md-none">
        <div class="col-md-4 py-2">
            <a href="#" >
                <button type="button" class="btn btn-success btn-block"> 

                    <img src="storage/svg/part.svg" width="20" height="20" alt="" class="float-left mr-3">
                     + Część
                </button>
            </a>
        </div>
        <div class="col-md-4 py-2">
            <a href="#" >
                <button type="button" class="btn btn-success btn-block"> 
                    <img src="storage/svg/overview.svg" width="20" height="20" alt="" class="float-left mr-3">
                     + Przegląd
                </button>
            </a>
        </div>
        <div class="col-md-4 py-2">
            <a href="#" >
                <button type="button" class="btn btn-success btn-block"> 
                    <img src="storage/svg/insurance.svg" width="20" height="20" alt="" class="float-left mr-3">
                     + Ubezpieczenie
                </button>
            </a>
        </div>
    </div>
    <div class="row px-2">
        <div class="col-lg-4 py-2">
            <div class="accordion" id="accordion1">
                <div class="card">
                    <div class="card-header py-1 px-2" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse1One" aria-expanded="true" aria-controls="collapse1One">
                            Części
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-expand float-right mt-1" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                            </svg>  
                            </button>                          
                        </h2>                        
                    </div>

                    <div id="collapse1One" class="collapse" aria-labelledby="headingOne" data-parent="#accordion1">
                        <div class="card-body">
                            Some placeholder content for the first accordion panel. This panel is shown by default, thanks to the <code>.show</code> class.
                        </div>
                    </div>           
                </div>
            </div>
        </div> 
        <div class="col-lg-4 py-2">
            <div class="accordion" id="accordion2">
                <div class="card">
                    <div class="card-header py-1 px-2" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse2One" aria-expanded="true" aria-controls="collapse2One">
                            Przeglądy
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-expand float-right mt-1" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                            </svg>  
                            </button>                          
                        </h2>                        
                    </div>

                    <div id="collapse2One" class="collapse aria-labelledby="headingOne" data-parent="#accordion2">
                        <div class="card-body">
                            Some placeholder content for the first accordion panel. This panel is shown by default, thanks to the <code>.show</code> class.
                        </div>
                    </div>           
                </div>
            </div>
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


<div class="d-block d-sm-none position-fixed" style="bottom: 20px; left: 30px;">
    <a href=" {{route('vehicles.index') }}"><button type="button" class="btn btn-primary px-2" style="border-radius:20px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
        </svg>
    </button></a>
</div>

@endsection
