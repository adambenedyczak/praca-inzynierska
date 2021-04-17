<div>
    @livewire('mini-nav-bar', ['tmp' => 0])

    <div class="row justify-content-center mt-md-5 mt-3 m-2">
        <div class="col-xl-8 col-md-10 p-0">
            <div class="card border-primary " >
                <div class="card-body">                   
                    <div class="container-xl py-3">
                        <div class="row">
                            <div class="col-9">
                                <h4 class="card-title mb-3 mt-2">Edycja {{$object_name}}</h4>
                            </div>
                            <div class="col-3 float-right">
                                <a href="{{ url()->previous() }}" class="btn close " aria-label="Close">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="floatName">{{ __('object.vehicle.create.name') }}</label> 
                                <input id="floatName" type="text" name="object_name" class="form-control"
                                    value="{{ old('object_name') }}" required wire:model="object_name" placeholder="wprowadź własną nazwę">                               
                            </div>
                            @error('object_name') 
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                            <div class="form-group col-md-6">
                                <label for="unit">{{ __('Jednostka czasu pracy') }}</label>
                                <select name="object_unit"
                                        wire:model.lazy="selectedWorkTimeUnit"
                                        class="form-control" required >
                                    @foreach ($allWorkTimeUnit as $unit)
                                        <option value="{{ $unit->id }}" >
                                            {{ $unit->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('selectedWorkTimeUnit') 
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div>
                            <hr/>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <p class="lead">Szczegóły</p>
                            </div>
                        </div>
                        <div class="container m-0 p-0">
                            @foreach ($addDetails as $index => $addDetail)
                            <div class="row py-1">
                                <div class="col-sm-4 my-1">
                                    <select name="addDetails[{{$index}}][detail_typeable_id]"
                                            wire:model.lazy="addDetails.{{$index}}.detail_typeable_id"
                                            class="form-control" >
                                        <option value="">{{ __('object.vehicle.create.choose_type') }}</option>
                                        @foreach ($allDetailsType as $detailType)
                                            <option value="{{ $detailType->id }}">
                                                {{ $detailType->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 my-1">
                                    <input type="text"
                                        name="addDetails[{{$index}}][value]"
                                        class="form-control"
                                        placeholder="{{ __('object.vehicle.create.put_value') }}"
                                        wire:model="addDetails.{{$index}}.value" />
                                </div>
                                
                                <div class="col-sm-2 justify-content-end my-1">
                                    <button type="button" class="btn btn-sm btn-danger px-3 pb-2 float-right" wire:click.prevent="removeDetail({{$index}})">{{ __('object.buttons.delete') }}</button>
                                </div>
                            </div>
                            @endforeach
                            <div class="row justify-content-start">
                                <div class="col-sm-6 offset-md-4 my-2 justify-content-end">
                                    <button class="btn btn btn-outline-primary btn-block px-3"
                                        wire:click.prevent="addDetail">{{ __('object.buttons.add_detail') }}</button>
                                </div>
                            </div>
                        
                        </div>  
                        <div>
                            <hr/>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <p class="lead">Własne szczegóły</p>
                            </div>
                        </div>
                        <div class="container m-0 p-0">
                                @foreach ($addOwnDetails as $index => $addDetail)
                                <div class="row py-1">
                                    <div class="col-sm-4 my-1">
                                        <input type="text"
                                            name="addOwnDetails[{{$index}}][own_name]"
                                            class="form-control"
                                            placeholder="{{ __('wpisz nazwę') }}"
                                            wire:model="addOwnDetails.{{$index}}.own_name" />
                                    </div>
                                    <div class="col-sm-6 my-1">
                                        <input type="text"
                                            name="addOwnDetails[{{$index}}][value]"
                                            class="form-control"
                                            placeholder="{{ __('wpisz wartość') }}"
                                            wire:model="addOwnDetails.{{$index}}.value" />
                                    </div>
                                    
                                    <div class="col-sm-2 justify-content-end my-1">
                                        <button type="button" class="btn btn-sm btn-danger px-3 pb-2 float-right" wire:click.prevent="removeOwnDetail({{$index}})">{{ __('object.buttons.delete') }}</button>
                                    </div>
                                </div>
                                @endforeach
                                <div class="row justify-content-start">
                                    <div class="col-sm-6 offset-md-4 my-2 justify-content-end">
                                        <button class="btn btn btn-outline-primary btn-block px-3"
                                            wire:click.prevent="addOwnDetail">{{ __('object.buttons.add_own_detail') }}</button>
                                    </div>
                                </div>
                            
                        </div> 
                        <div class="row mt-5">
                            <div class="col-md-6 my-1">
                                <button wire:click="saveAll" type="button" class="btn btn-success btn-block pt-2">
                                    <h5>Zapisz zmiany</h5>
                                </button>
                            </div>
                            <div class="col-md-6 my-1">
                                <a href="{{ url()->previous() }}" type="button" class="btn btn-outline-danger btn-block pt-2">
                                    <h5>Anuluj</h5>
                                </a>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
