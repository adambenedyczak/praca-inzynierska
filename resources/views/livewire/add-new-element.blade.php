<div>
    <div class="row justify-content-center m-2">
        <div class="col-12 p-0">
            <div class="card border-primary" >
                <div class="card-body p-2">                   
                    <div class="container-xl py-3">
                        <div class="row">
                            <div class="col-10">
                                <h5 class="card-title mb-1">{{ __('Nowa informacja') }}</h5>
                            </div>
                            <div class="col-2 float-left">
                                <button wire:click="cancelAdd" type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 ">
                                <span class="lead"> Wybierz, co chcesz dodać</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            @foreach ($elementCategoryList as $category)
                            <div class="col-sm-4 text-center my-1">
                                @if ($selectedCategory == $category->id)
                                    <button wire:click="$set('selectedCategory', {{$category->id}})" type="button" class="btn btn-primary btn-block" >
                                @else
                                    <button wire:click="$set('selectedCategory', {{$category->id}})" type="button" class="btn btn-outline-primary btn-block" >
                                @endif
                                        <h6>{{$category->name}}</h6>
                                    </button>                        
                            </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating my-1">
                                    <label for="unit">{{ __('Kategoria') }}</label>
                                    <select name="selectedType"
                                            wire:model.lazy="selectedType"
                                            class="form-control" required >
                                        <option value="">{{ __('wybierz') }}</option>
                                        @foreach ($allType as $type)
                                            <option value="{{ $type->id }}" >
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('selectedType') 
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="col-md-6 my-1">
                                <div class="form-floating">
                                    <label for="floatName">{{ __('Nazwa') }}</label> 
                                    <input id="floatName" type="text" name="element_name" class="form-control"
                                        value="{{ old('element_name') }}" required wire:model="element_name" placeholder="wprowadź nazwę">                               
                                </div>
                                @error('element_name') 
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror   
                            </div>
                        </div>
                        <div>
                            <hr/>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <span class="lead"> Termin ważności/następnej wymiany</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating my-1">
                                    <label for="nextDate">{{ __('Data') }}</label>
                                    <input type="date" name="nextDate" min="{{$tomorrow}}"
                                            wire:model="nextDate"
                                            class="form-control" required >
                                    </input>
                                </div>
                                @error('nextDate') 
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            @if($object->work_time_unit_id > 1)
                            <div class="col-md-6 my-1">
                                <div class="form-floading">
                                    <label for="nextWorkTimeValue">{{ __('Przebieg') }}</label> 
                                    <input id="nextWorkTimeValue" type="number" name="nextWorkTimeValue" class="form-control"
                                        value="{{ old('element_name') }}" required 
                                        wire:model="nextWorkTimeValue" placeholder="wprowadź przebieg"
                                        min="{{$workTimeValue}}" step="1">                               
                                </div>
                                @error('nextWorkTimeValue') 
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror   
                            </div>
                            @endif
                        </div>
                        
                        <div>
                            <hr/>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="lead m-0">Szczegóły</p>
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
                                            wire:click.prevent="addOwnDetail">Dodaj szczegół</button>
                                    </div>
                                </div>
                            
                        </div> 
                        <div class="row mt-3">
                            <div class="col">
                                <button wire:click="saveAll" type="button" class="btn btn-success btn-block pt-2 pb-1">
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
