<div>
    <div class="row justify-content-center m-2">
        <div class="col-xl-8 col-md-10 p-0">
            <div class="card border-primary " >
                <div class="card-body">                   
                    <div class="container-xl py-3">
                        <div class="row">
                            <div class="col">
                                <h4 class="card-title mb-3">{{ __('Nowy') }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="lead">Wybierz, co chcesz dodać</p>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-4 text-center my-1">
                                @if ($selectedObjectType == 1)
                                    <button wire:click="$set('selectedObjectType', 1)" type="button" class="btn btn-primary btn-block pt-2" >
                                @else
                                    <button wire:click="$set('selectedObjectType', 1)" type="button" class="btn btn-outline-primary btn-block pt-2" >
                                @endif
                                        <h5>Pojazd</h5>
                                    </button>                        
                            </div>
                            <div class="col-sm-4 text-center my-1">
                                @if ($selectedObjectType == 2)
                                    <button wire:click="$set('selectedObjectType', 2)" type="button" class="btn btn-primary btn-block pt-2">
                                @else
                                    <button wire:click="$set('selectedObjectType', 2)" type="button" class="btn btn-outline-primary btn-block pt-2" >
                                @endif
                                        <h5>Przyczepa</h5>
                                    </button>  
                            </div>
                            <div class="col-sm-4 text-center my-1">
                                @if ($selectedObjectType == 3)
                                    <button wire:click="$set('selectedObjectType', 3)" type="button" class="btn btn-primary btn-block pt-2" >
                                @else
                                    <button wire:click="$set('selectedObjectType', 3)" type="button" class="btn btn-outline-primary btn-block pt-2" >
                                @endif
                                        <h5>Maszyna</h5>
                                    </button>  
                            </div>
                        </div>
                        <div class="form-group form-floating">
                            <div class="form-floating">
                                <label for="floatName">{{ __('object.vehicle.create.name') }}</label> 
                                <input id="floatName" type="text" name="object_name" class="form-control"
                                    value="{{ old('object_name') }}" required wire:model="object_name" placeholder="wprowadź własną nazwę">                               
                            </div>
                            @error('object_name') 
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                            <div class="form-floating mt-3">
                                <label for="unit">{{ __('Jednostka czasu pracy') }}</label>
                                <select name="object_unit"
                                        wire:model.lazy="selectedWorkTimeUnit"
                                        class="form-control" required >
                                    <option value="">{{ __('wybierz') }}</option>
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

                            @if($selectedWorkTimeUnit > 1)
                                <div class="form-floating mt-3">
                                    <label for="timeValue">{{ __('Aktualny przebieg') }}</label> 
                                    <input id="timeValue" type="number" name="work_time_value" class="form-control" min="0" step="1"
                                        value="{{ old('workTimeValue') }}" required wire:model="workTimeValue" placeholder="wprowadź aktualny przebieg">                               
                                </div>
                                @error('workTimeValue') 
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            @endif
                        </div>
                        <div>
                            <hr/>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <p class="lead">Dodaj szczegóły</p>
                            </div>
                        </div>
                            <div class="container m-0 p-0">
                                @foreach ($addDetails as $index => $addDetail)
                                <div class="row py-1">
                                    <div class="col-sm-4 my-1">
                                        <select name="addDetails[{{$index}}][detail_type_id]"
                                                wire:model.lazy="addDetails.{{$index}}.detail_type_id"
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
                                <p class="lead">Dodaj własne szczegóły</p>
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
                            <div class="col">
                                <button wire:click="saveAll" type="button" class="btn btn-success btn-block pt-3 pb-2">
                                    <h5>Zapisz</h5>
                                </button>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
