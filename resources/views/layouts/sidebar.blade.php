@auth
<div class="bg-dark border-right" id="sidebar-wrapper">
    <div class="sidebar-heading sidebar-header">Menu</div>
    <div class="list-group list-group-flush">
        <a href="{{ route('home') }}" class="list-group-item list-group-item-action " style="border-bottom-width: 3px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
            </svg>    
            {{ __('menu.dashboard') }}
        </a>
        <a href="#" type="button" class="btn list-group-item list-group-item-action bg-success text-white" style="border-bottom-width: 3px;" data-toggle="modal" data-target="#addNewObjectModal" data-backdrop="static" data-keyboard="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
            {{ __('menu.add_new') }}
        </a>
        <a href=" {{ route('vehicles.index') }}" class="list-group-item list-group-item-action " style="border-bottom-width: 3px;">
            <img src="{{ asset('storage/svg/car.svg') }}" width="20" height="20" alt="" class="float-left mr-2">
                    
            {{ __('menu.vehicles') }}

            @if(Helper::vehicles_quantity() > 0)
                <span class="badge badge-primary badge-pill float-right">
                    {{ Helper::vehicles_quantity() }}
                </span>
            @endif
        </a>
        <a href="{{ route('trailers.index') }}" class="list-group-item list-group-item-action" style="border-bottom-width: 3px;">
            <img src="{{ asset('storage/svg/trailer.svg') }}" width="20" height="20" alt="" class="float-left mr-2">   
                    
            {{ __('menu.trailers') }}
            @if(Helper::trailers_quantity() > 0)
                <span class="badge badge-primary badge-pill float-right">
                    {{ Helper::trailers_quantity() }}
                </span>
            @endif
        </a>
        <a href="{{ route('machines.index') }}" class="list-group-item list-group-item-action" style="border-bottom-width: 3px;">
            <img src="{{ asset('storage/svg/mechanism.svg') }}" width="20" height="20" alt="" class="float-left mr-2">   
                    
            {{ __('menu.machines') }}
            @if(Helper::engines_quantity() > 0)
                <span class="badge badge-primary badge-pill float-right">
                    {{ Helper::engines_quantity() }}
                </span>
            @endif
        </a>
        <a href="#" class="list-group-item list-group-item-action" style="border-bottom-width: 3px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
            </svg>
            {{ __('menu.notifications') }}
        </a>
        @hasrole('admin')
            <a href="#" class="list-group-item list-group-item-action bg-warning" style="border-bottom-width: 3px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
                    <path d="M1 0L0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.356 3.356a1 1 0 0 0 1.414 0l1.586-1.586a1 1 0 0 0 0-1.414l-3.356-3.356a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3c0-.269-.035-.53-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814L1 0zm9.646 10.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708zM3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026L3 11z"/>
                </svg>
                {{ __('menu.admin_panel') }}
            </a>
        @endhasrole
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addNewObjectModal" tabindex="-1" role="dialog" aria-labelledby="addNewObjectModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title ">{{ __('menu.choose_new') }}</h5></h5>
        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
        {{ __('object.buttons.close') }}
        </button> 
      </div>
      <div class="modal-body">

        <a href=" {{ route('objects.create', 1)}}" class="btn btn-dark btn-lg text-dark btn-block pt-3 mb-3" role="button" style="background-color: #D4F5F5;">
            <img src="{{ asset('storage/svg/car.svg') }}" width="30" height="30" alt="" class="float-left mr-2">
            <h4>{{ __('object.vehicle.name') }}</h4>
        </a>

        <a href=" {{ route('objects.create', 2)}}" class="btn btn-dark btn-lg text-dark btn-block pt-3 mb-3" role="button" style="background-color: #93B7BE;">
            <img src="{{ asset('storage/svg/trailer.svg') }}" width="30" height="30" alt="" class="float-left mr-2">   
            <h4>{{ __('object.trailer.name') }}</h4>
        </a>

        <a href=" {{ route('objects.create', 3)}}" class="btn btn-dark btn-lg text-white btn-block pt-3 mb-3" role="button" style="background-color: #554348;">
            <img src="{{ asset('storage/svg/mechanism.svg') }}" width="30" height="30" alt="" class="float-left mr-2">  
            <h4>{{ __('object.machine.name') }}</h4>
        </a>


      </div>
    </div>
  </div>
</div>

@endauth