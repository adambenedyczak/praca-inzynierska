<div>
    <div class="row my-2 align-items-center">
        @if($action != 2)
            <div class="col-md-3">
                <span class="lead">{{ $element->elements_typeable->name }}</span>
            </div>
            <div class="col-md-3">
                <strong>{{ $element->name }}</strong>
            </div>
            <div class="col-md-3 pt-2 pt-md-0">
            @if( $event)
                <span class="text-primary">
                {{ date("d-m-Y", strtotime($event->expired_date)) }} 
                </span>
                @if( $event->work_time_value  )
                    <div class="text-muted">
                    {{ number_format($event->work_time_value,0,""," ") }} {{ $object->work_time_unit->short }}
                    </div>
                @endif
            @endif
            </div>        
            <div class="col-md-3">
                <div class="float-right">
                    @if($ifMore == false)
                    <button type="button" wire:click="$set('ifMore', true)" class="btn @if($this->alert) btn-warning @endif btn-outline-primary btn-block">
                    Więcej
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-expand" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                        </svg>
                    </button>
                    @else
                    <button type="button" wire:click="$set('ifMore', false)" class="btn btn-outline-primary btn-block">
                    Mniej
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-contract" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M3.646 13.854a.5.5 0 0 0 .708 0L8 10.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708zm0-11.708a.5.5 0 0 1 .708 0L8 5.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </button>
                    @endif
                </div>
            </div>
        @elseif($action == 2)
            <div class="col-md-4">
                <label for="selectedType">{{ __('Kategoria') }}</label>
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
                @error('selectedType') 
                    <small class="form-text text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="col-md-5">
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
            <div class="col-md-3">
                <div class="float-right ">
                    @if($ifMore == false)
                    <button type="button" wire:click="$set('ifMore', true)" class="btn btn-outline-primary btn-block">
                    Więcej
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-expand" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                        </svg>
                    </button>
                    @else
                    <button type="button" wire:click="$set('ifMore', false)" class="btn btn-outline-primary btn-block">
                    Mniej
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-contract" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M3.646 13.854a.5.5 0 0 0 .708 0L8 10.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708zm0-11.708a.5.5 0 0 1 .708 0L8 5.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </button>
                    @endif
                </div>
            </div>
        @endif
    </div>
    @if($action == 2 )
    <div class="row mt-2">
        <div class="col-12">
            <div class="custom-control custom-switch">
                <input wire:model="isSetEvent" type="checkbox" class="custom-control-input" id="customSwitch1" >
                <label class="custom-control-label pl-2" for="customSwitch1">Edytuj zdarzenie</label>
            </div>
        </div>
    </div>
    @if($isSetEvent == true )
        <div class="row">
            <div class="col-12">
                <span class="lead"> Termin ważności/następnej wymiany</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
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
    @endif
    <div>
        <hr/>
    </div>
    @endif
    @if ($ifMore == true)
        @if ($action != 2)
        <div class="row mb-2">
            @foreach ($ownDetails as $detailCol)
            <div class="col-md-6 ">
                <div class="container">
                    @foreach ($detailCol as $detail)
                    <div class="row">
                        <div class="col-5 text-muted">
                            {{ $detail['own_name'] }}: 
                        </div>
                        <div class="col-7" >
                            {{ $detail['value'] }}
                        </div>
                    </div>                                        
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
        @else
            @foreach ($ownDetailsEdit as $index => $detail)
            <div class="row my-1">
                <div class="col-sm-4 my-1">
                    <input type="text" name="ownDetailsEdit[{{$index}}][own_name]" 
                        wire:model="ownDetailsEdit.{{$index}}.own_name" 
                        class="form-control" placeholder="nazwa"> 
                </div>
                <div class="col-sm-6 my-1" >
                    <input type="text" name="ownDetailsEdit[{{$index}}][value]" 
                        wire:model="ownDetailsEdit.{{$index}}.value" 
                        class="form-control" placeholder="wartość">
                </div>
                <div class="col-sm-2 my-1">
                    <button type="button" wire:click.prevent="removeElementDetail({{$index}})" 
                            class="btn btn-danger btn-block">Usuń</button>
                </div>
            </div>
            @endforeach
            <div class="row justify-content-start">
                <div class="col-md-4 my-2">
                    <button class="btn btn btn-primary btn-block px-3"
                        wire:click.prevent="addElementDetail">Dodaj szczegół</button>
                </div>
                <div class="col-md-8 my-2">
                    <div class="btn-group btn-block" role="group" id="ab3">
                        <button wire:click="cancelSave" type="button" class="btn btn-outline-primary">Anuluj</button>
                        <button wire:click="saveAll" type="button" class="btn btn-success">Zapisz</button>
                    </div>
                </div>
            </div>
        @endif
        @if($action != 1)
        <div class="row justify-content-end mb-2">
            <div class="col-12 col-md-6">
                @if($action == 0)
                <div class="btn-group btn-block" role="group" id="1">
                    @if($isSetEvent)
                        <button wire:click="updateEvent" type="button" class="btn btn-success">Aktualizuj</button>
                    @else
                        <button wire:click="updateEvent" type="button" class="btn btn-success" disabled>Aktualizuj</button>
                    @endif
                    @if(count($allEventsPast) > 0)
                        <button wire:click="showHistory" type="button" class="btn btn-outline-info">Historia</button>
                    @else
                        <button wire:click="showHistory" type="button" class="btn btn-outline-info" disabled>Historia</button>
                    @endif
                    <button wire:click="$set('action', 2)"type="button" class="btn btn-outline-primary">Edytuj</button>
                    <button wire:click="setDelete" type="button" class="btn btn-outline-danger">Usuń</button>
                </div>
                @elseif($action == 3)
                <div class="btn-group btn-block" role="group" id="2">
                    <button type="button" wire:click="confirmDeleteElement" class="btn btn-outline-danger">Usuń</button>
                    <button type="button" wire:click="cancelDeleteElement" class="btn btn-success">Anuluj</button>
                </div>
                @endif
            </div>
        </div>
        @else
        <div>
            <hr/>
        </div>
        <div class="row">
            <div class="col-md-3">
                Wykonana wymiana
            </div>
            <div class="col-md-3">
                <div class="form-floating my-1">
                    <input type="date" name="doneDate" min="{{$tomorrow}}"
                            wire:model="doneDate"
                            class="form-control" required>
                    </input>
                </div>
                @error('doneDate') 
                    <small class="form-text text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="col-md-3 my-1">
            @if($object->work_time_unit_id > 1)            
                <div class="form-floading">
                    <input id="doneWorkTimeValue" type="number" name="doneWorkTimeValue" class="form-control"
                        value="{{ old('doneWorkTimeValue') }}" required 
                        wire:model="doneWorkTimeValue" placeholder="wprowadź przebieg"
                        min="{{$workTimeValue}}" step="1">                               
                </div>
                @error('doneWorkTimeValue') 
                    <small class="form-text text-danger">
                        {{ $message }}
                    </small>
                @enderror  
            @endif
            </div>           
        </div>
        <div class="row my-1">
            <div class="col-md-3">
                Następna wymiana / termin ważności
            </div>
            <div class="col-md-3">
                <div class="form-floating my-1">
                    <input type="date" name="nextNextDate" min="{{$tomorrow}}"
                            wire:model="nextNextDate"
                            class="form-control" required>
                    </input>
                </div>
                @error('nextNextDate') 
                    <small class="form-text text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="col-md-3 my-1">
            @if($object->work_time_unit_id > 1)
            
                <div class="form-floading">
                    <input id="nextNextWorkTimeValue" type="number" name="nextNextWorkTimeValue" class="form-control"
                        value="{{ old('nextNextWorkTimeValue') }}" required 
                        wire:model="nextNextWorkTimeValue" placeholder="wprowadź przebieg"
                        min="{{$workTimeValue}}" step="1">                               
                </div>
                @error('nextNextWorkTimeValuee') 
                    <small class="form-text text-danger">
                        {{ $message }}
                    </small>
                @enderror              
            @endif
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="btn-group btn-block" role="group" id="53">
                    <button wire:click="cancelNewEvent" type="button" class="btn btn-outline-primary">Anuluj</button>
                    <button wire:click="storeNewEvent" type="button" class="btn btn-success">Zapisz</button>
                </div>
            </div>
        </div>
        @endif
    @endif




    <!-- Modal -->
    <div class="modal fade" id="elementHistory{{$element_id}}" tabindex="-1" role="dialog" aria-labelledby="elementHistoryTitle{{$element_id}}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="elementHistoryTitle{{$element_id}}">Historia elementu: {{ $element->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        @foreach ($allEventsPast as $event)
                            @if(!$loop->first)
                                <div>
                                    <hr/>
                                </div>
                            @endif
                            <div class="row align-items-center">
                                <div class="col-md-3 text-muted">
                                    Wymiana:
                                </div>
                                <div class="col-md-3">
                                    <span class="float-right">
                                        {{ date("d-m-Y", strtotime($event->done_date)) }} 
                                    </span>
                                </div>
                                <div class="col-md-3 text-muted">
                                    Przebieg:
                                </div>
                                <div class="col-md-3">
                                    <span class="float-right">
                                        @if($event->done_work_time_value != null)
                                            {{ number_format($event->done_work_time_value,0,""," ") }} {{ $object->work_time_unit->short }} 
                                        @else
                                            --
                                        @endif 
                                    </span>
                                </div>
                            </div>
                        @endforeach     
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Zamknij</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

    window.livewire.on('show{{$element_id}}', () => {
        $('#elementHistory{{$element_id}}').modal('show');
    });

    </script>

</div>
