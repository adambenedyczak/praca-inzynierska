<div>
    @if($ifAddElement == false)
    <div class="row justify-content-between">
        @if($ifAddWorkTimeHistory == false)
            <div class="col-md-4 my-1">                
                <button wire:click="$set('ifAddWorkTimeHistory', true)"class="btn btn-success btn-block" type="button">
                    Aktualizuj przebieg
                </button>
            </div>
        @else
            <div class="col-md-8 my-1">  
                <div class="container p-0 m-0">
                    <div class="row">
                        <div class="col-md-3">
                            Aktualny przebieg
                        </div>
                        <div class="col-md-4 my-1">
                            <input id="currentWorkTimeValue" wire:model="currentWorkTimeValue" type="number" class="form-control" min="{{ $oldWorkTimeValue }}" step="1">  
                            @error('currentWorkTimeValue') 
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-5 my-1">
                            <div class="btn-group btn-block" role="group" id="20">
                                <button wire:click="$set('ifAddWorkTimeHistory', false)" type="button" class="btn btn-outline-primary">Anuluj</button>
                                <button wire:click="storeNewWorkTimeHistory" type="button" class="btn btn-success">Zapisz</button>
                            </div>
                        </div>
                    </div>
                </div>        
            </div>
        @endif
        <div class="col-md-4 my-1">
            <button wire:click="addNewElement" class="btn btn-primary btn-block" type="button">
                Dodaj informacje
            </button>
        </div>
    </div>
    @else
    <div>
        @livewire('add-new-element', ['object_id' => $object->id])    
    </div>
    @endif
    @if (count($elements) > 0)
        <div class="accordion mt-3" id="accordionExample">
         
        @foreach ($elements as $elementsCategory)         
            <div class="card">
                <div class="card-header p-1" id="{{$loop->index}}">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$loop->index}}" aria-expanded="false" aria-controls="{{$loop->index}}">
                        @if ($loop->index == 0)
                        <img src="{{ asset('storage/svg/part.svg') }}" width="30" height="30" alt="" class="float-left mr-3">
                            Części
                        @elseif ($loop->index == 1)
                        <img src="{{ asset('storage/svg/overview.svg') }}" width="30" height="30" alt="" class="float-left mr-3">  
                            Przeglądy
                        @elseif ($loop->index == 2)
                        <img src="{{ asset('storage/svg/insurance.svg') }}" width="30" height="30" alt="" class="float-left mr-3">        
                            Ubezpieczenia
                        @endif

                        </button>
                    </h2>
                </div>
                <div id="collapse{{$loop->index}}" class="collapse hide" aria-labelledby="{{$loop->index}}" data-parent="#accordionExample">
                    <div class="card-body p-2">
                        <div class="container px-2">
                        @foreach ($elementsCategory as $elements)
                            @if(!$loop->first)  
                            <div>
                                <hr class="m-0" />
                            </div>
                            @endif                          
                            @livewire('display-element', ['element_id' => $elements->id])                                                 
                        @endforeach
                        </div>                  
                    </div>
                </div>
            </div>        
        @endforeach
        </div>
    @endif
        
</div>
