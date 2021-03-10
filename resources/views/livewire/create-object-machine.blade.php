<div>
<div class="card">
            <div class="card-header font-weight-bold">{{ __('object.machine.create.new') }}</div>

            <div class="card-body">
    <form action="{{ route('objects.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf
      
        
        <div class="form-group form-floating {{ $errors->has('object_name') ? 'has-error' : '' }}">
            <div class="form-floating">
                <label for="floatName">{{ __('object.machine.create.name') }}</label> 
                <input id="floatName" type="text" name="object_name" class="form-control"
                    value="{{ old('object_name') }}" required wire:model="object_name">                               
            </div>
            @error('object_name') 
                 <small class="form-text text-danger">
                    {{ $message }}
                </small>
            @enderror
            <div class="form-floating mt-3">
                <label for="unit">{{ __('object.machine.create.unit_name') }}</label>
                <select name="object_unit"
                        wire:model="object_unit"
                        class="form-control" required >
                    <option value="">{{ __('object.machine.create.choose_unit') }}</option>
                    @foreach ($workTimeUnits as $unit)
                        <option value="{{ $unit->id }}" @if($unit->short == "mh") selected @endif>
                            {{ $unit->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            @error('object_unit') 
                 <small class="form-text text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div class="card">
            <div class="card-header">
            {{ __('object.machine.create.details') }}
            </div>

            <div class="card-body">
                @foreach ($addDetails as $index => $addDetail)
                <div class="form-row align-items-center my-2">
                    <div class="col-sm-4 mb-1">
                        <select name="addDetails[{{$index}}][detail_type_id]"
                                wire:model="addDetails.{{$index}}.detail_type_id"
                                class="form-control" >
                            <option value="">{{ __('object.machine.create.choose_type') }}</option>
                            @foreach ($allDetailsType as $detailType)
                                <option value="{{ $detailType->id }}">
                                    {{ $detailType->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 mb-1">
                    <input type="text"
                        name="addDetails[{{$index}}][value]"
                        class="form-control"
                        placeholder="{{ __('object.machine.create.put_value') }}"
                        wire:model="addDetails.{{$index}}.value" />
                    </div>
                    
                    <div class="col-sm-2 mb-1 justify-content-end">
                        <button type="button" class="btn btn-sm btn-danger px-3 float-right" wire:click.prevent="removeDetail({{$index}})">{{ __('object.buttons.delete') }}</button>
                    </div>
                </div>
                @endforeach
                <div class="row">
                    <div class="col-sm-12 mt-2 justify-content-end">
                        <button class="btn btn-sm btn-success px-3"
                            wire:click.prevent="addDetail">{{ __('object.buttons.add_detail') }}</button>
                    </div>
                </div>

                <hr>


                @foreach ($addOwnDetails as $index => $addOwnDetail)
                <div class="form-row align-items-center my-2">
                    <div class="col-sm-4 mb-1">
                        <input type="text"
                            name="addOwnDetails[{{$index}}][own_name]"
                            class="form-control"
                            placeholder="{{ __('object.machine.create.put_name') }}"
                            wire:model="addOwnDetails.{{$index}}.own_name" />
                    </div>
                    <div class="col-sm-6 mb-1">
                        <input type="text"
                            name="addOwnDetails[{{$index}}][value]"
                            class="form-control"
                            placeholder="{{ __('object.machine.create.put_name') }}"
                            wire:model="addOwnDetails.{{$index}}.value" />
                        </div>
                    <div class="col-sm-2 mb-1 justify-content-end">
                        <button type="button" class="btn btn-sm btn-danger px-3 float-right" wire:click.prevent="removeOwnDetail({{$index}})">{{ __('object.buttons.delete') }}</button>
                    </div>
                </div>
                @endforeach
                <div class="row">
                    <div class="col-sm-12 mt-2 justify-content-end">
                        <button class="btn btn-sm btn-primary px-3"
                            wire:click.prevent="addOwnDetail">{{ __('object.buttons.add_own_detail') }}</button>
                    </div>
                </div>
            </div>
               
        </div>
        <br />
        <div>
            <input class="btn btn-primary px-3 float-right" type="submit" value="{{ __('object.buttons.submit') }}">
        </div>
    </form>

    </div>
        </div>

</div>
