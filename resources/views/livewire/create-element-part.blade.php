<div>
    <div class="card">
        <div class="card-header">
            <div class="font-weight-bold float-left">
            {{ __('element.part.create') }} 
            </div>
            <div class="float-right">
            @if( $object_type_id == 1)
                {{ __('object.vehicle.name') }}
            @elseif( $object_type_id == 2)
                {{ __('object.trailer.name') }}
            @elseif ( $object_type_id == 3)
                {{ __('object.machine.name') }}
            @endif
            {{$parent->name}}                
            </div>
        </div>
        <div class="card-body">
        <form action="{{ route('parts.store', ['id' => $object_type_id, 'owner' => $parent]) }}" method="POST" class="needs-validation" novalidate>
            @csrf
        
            
            <div class="form-group form-floating {{ $errors->has('part_name') ? 'has-error' : '' }}">
                <div class="form-floating mt-3">
                    <label for="part_type">{{ __('element.part.type_name') }}</label>
                    <select name="part_type"
                            wire:model="part_type"
                            class="form-control" required >
                        <option value="">{{ __('element.part.choose_type') }}</option>
                        @foreach ($allPartType as $part_type)
                            <option value="{{ $part_type->id }}" >
                                {{ $part_type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('part_type') 
                    <small class="form-text text-danger">
                        {{ $message }}
                    </small>
                @enderror

                <div class="form-floating py-3">
                    <input id="floatName" type="text" name="part_name" class="form-control"
                        value="{{ old('part_name') }}" wire:model="part_name"
                        placeholder="{{ __('element.part.name') }}">       
                        @error('part_name') 
                            <small class="form-text text-danger">
                                {{ $message }}
                            </small>
                        @enderror                        
                </div>

            </div>

            <div class="card">
                <div class="card-header">
                {{ __('element.part.details') }}
                </div>

                <div class="card-body">
                    @foreach ($addDetails as $index => $addDetail)
                    <div class="form-row align-items-center my-2">
                        <div class="col-sm-4 mb-1">
                            <select name="addDetails[{{$index}}][detail_type_id]"
                                    wire:model="addDetails.{{$index}}.detail_type_id"
                                    class="form-control" >
                                <option value="">{{ __('element.choose_detail_type') }}</option>
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
                            placeholder="{{ __('object.vehicle.create.put_value') }}"
                            wire:model="addDetails.{{$index}}.value" />
                        </div>
                        
                        <div class="col-sm-2 mb-1 justify-content-end">
                            <button type="button" class="btn btn-sm btn-danger px-3 float-right" wire:click.prevent="removeDetail({{$index}})">{{ __('object.buttons.delete') }}</button>
                        </div>
                    </div>
                    @endforeach
                    <div class="row">
                        <div class="col-sm-12 mt-2 justify-content-end">
                            <button class="btn btn-sm btn-success  px-3"
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
                                placeholder="{{ __('object.vehicle.create.put_name') }}"
                                wire:model="addOwnDetails.{{$index}}.own_name" />
                        </div>
                        <div class="col-sm-6 mb-1">
                            <input type="text"
                                name="addOwnDetails[{{$index}}][value]"
                                class="form-control"
                                placeholder="{{ __('object.vehicle.create.put_name') }}"
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
