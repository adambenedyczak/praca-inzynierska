<div>
    @if($isArchival == false)
        @if($ifAddElement == false)
        <div class="row justify-content-between">
            @if($ifAddWorkTimeHistory == false)
                <div class="col-md-4 my-1">
                    @if($workTimeUnit != 1)                
                        <button wire:click="$set('ifAddWorkTimeHistory', true)"class="btn btn-success btn-block" type="button">
                            Aktualizuj przebieg
                        </button>
                    @endif
                </div>
                <div class="col-md-4 my-1">
                    <button wire:click="openPDFModal" class="btn btn-outline-primary btn-block" type="button">
                        Generuj PDF
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
                                <input id="currentWorkTimeValue" 
                                    wire:model="currentWorkTimeValue" 
                                    wire:keydown.enter="storeNewWorkTimeHistory"
                                    type="number" class="form-control" 
                                    min="{{ $oldWorkTimeValue }}" step="1">  
                                @error('currentWorkTimeValue') 
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <div class="btn-group btn-block" role="group">
                                    <button wire:click="$set('ifAddWorkTimeHistory', false)" type="button" class="btn btn-outline-primary">Anuluj</button>
                                    <button wire:click="storeNewWorkTimeHistory" type="button" class="btn btn-success">Zapisz</button>
                                </div>
                            </div>
                        </div>
                    </div>        
                </div>
            @endif
            <div class="col-md-4 my-1">
                <button wire:click="$set('ifAddElement', true)" class="btn btn-primary btn-block" type="button">
                    Dodaj informacje
                </button>
            </div>
        </div>
        @else
        <div>
            @livewire('add-new-element', ['object_id' => $object->id])    
        </div>
        @endif
    @endif
        <div class="accordion mt-3" id="accordionExample">  
        @if (count($parts) > 0)      
            <div class="card">
                <div class="card-header p-1 " id="1">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="1">
                        <img src="{{ asset('storage/svg/part.svg') }}" width="30" height="30" alt="" class="float-left mr-3">
                            Części
                            @if(isset($events[1]))
                            <span class="text-danger float-right">
                                <strong>Zbliżają się zdarzenia!</strong>
                            </span>
                            @endif
                        </button>
                    </h2>
                </div>
                
                <div id="collapse1" class="collapse @if($openSection == 1) show @else hide @endif" aria-labelledby="1" data-parent="#accordionExample">
                    <div class="card-body p-2">
                        <div class="container px-2">
                        @foreach ($parts as $part)  
                            @if(!$loop->first)  
                            <div>
                                <hr class="m-0" />
                            </div>
                            @endif                          
                            @livewire('display-element', ['element_id' => $part->id], key($part->id))                                                 
                        @endforeach
                        </div>                  
                    </div>
                </div>
            </div>        
        @endif
        @if (count($overviews) > 0)      
            <div class="card">
                <div class="card-header p-1 " id="2">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="2">
                        <img src="{{ asset('storage/svg/overview.svg') }}" width="30" height="30" alt="" class="float-left mr-3">
                            Przeglądy
                            @if(isset($events[2]))
                            <span class="text-danger float-right">
                                <strong>Zbliżają się zdarzenia!</strong>
                            </span>
                            @endif
                        </button>
                    </h2>
                </div>
                <div id="collapse2" class="collapse @if($openSection == 2) show @else hide @endif" aria-labelledby="2" data-parent="#accordionExample">
                    <div class="card-body p-2">
                        <div class="container px-2">
                        @foreach ($overviews as $overview)  
                            @if(!$loop->first)  
                            <div>
                                <hr class="m-0" />
                            </div>
                            @endif                          
                            @livewire('display-element', ['element_id' => $overview->id], key($overview->id))                                                 
                        @endforeach
                        </div>                  
                    </div>
                </div>
            </div>        
        @endif
        @if (count($insurances) > 0)      
            <div class="card">
                <div class="card-header p-1 " id="3">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="3">
                        <img src="{{ asset('storage/svg/insurance.svg') }}" width="30" height="30" alt="" class="float-left mr-3">
                            Ubezpieczenia
                            @if(isset($events[3]))
                            <span class="text-danger float-right">
                                <strong>Zbliżają się zdarzenia!</strong>
                            </span>
                            @endif
                        </button>
                    </h2>
                </div>
                <div id="collapse3" class="collapse @if($openSection == 3) show @else hide @endif" aria-labelledby="3" data-parent="#accordionExample">
                    <div class="card-body p-2">
                        <div class="container px-2">
                        @foreach ($insurances as $insurance)  
                            @if(!$loop->first)  
                            <div>
                                <hr class="m-0" />
                            </div>
                            @endif                          
                            @livewire('display-element', ['element_id' => $insurance->id], key($insurance->id))                                                 
                        @endforeach
                        </div>                  
                    </div>
                </div>
            </div>        
        @endif
        </div>
        

        <div class="modal fade" id="PDFModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                
                    @livewire('generate-p-d-f', ['object_id' => $object->id], key($object->id . $object->id .$object->id))  
                
              </div>
            </div>
          </div>
</div>

<script>
    window.addEventListener('closePDFModal', event => {
      $("#PDFModal").modal('hide');
    })
    window.addEventListener('openPDFModal', event => {
      $("#PDFModal").modal('show');
    })
  </script>

