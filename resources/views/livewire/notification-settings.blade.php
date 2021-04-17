<div>
    @livewire('mini-nav-bar', ['tmp' => 0])
    
    @if (session()->has('message'))
    <div class="row justify-content-center m-2"> 
        <div class="col-xl-10 col-md-12 p-0">        
            <div class="alert alert-success">
                {{ session('message') }}
            </div>        
        </div>
    </div>
    @endif

    <div class="row justify-content-center m-2">
        <div class="col-xl-10 col-md-12 p-0">
            <div class="card border-primary " >
                <div class="card-body p-2 p-sm-3">                   
                    <div class="container">
                        <div class="row">
                            <div class="col-9">
                                <h5 class="card-title mt-2">{{ __('Ustawienia powiadomień') }}</h5>
                                <small>Wybierz ile dni wcześniej chcesz otrzymać powiadomienie</small>
                            </div>
                        </div>
                        <div>
                            <hr/>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-4">
                                <div class="container">
                                    <div class="row my-2">
                                        <h6>Powiadomienia o częściach</h6>
                                    </div>
                                    <div class="row my-2">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input wire:model="isEnabledNotificationPart" type="checkbox" class="custom-control-input" id="customSwitch1" checked="">
                                                <label class="custom-control-label" for="customSwitch1">Włącz powiadomienia</label>
                                            </div>
                                            @if($isEnabledNotificationPart)
                                            <select wire:model="notificationPartTime" class="custom-select my-2 form-control">
                                            @else
                                            <select wire:model="notificationPartTime" class="custom-select my-2 form-control" disabled="disabled">
                                            @endif
                                                @foreach ($notificationTimeList as $time)
                                                    <option value="{{ $time['time'] }}">{{ $time['description'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="container">
                                    <div class="row my-2">
                                        <h6>Powiadomienia o przeglądach</h6>
                                    </div>
                                    <div class="row my-2">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input wire:model="isEnabledNotificationOverview" type="checkbox" class="custom-control-input" id="customSwitch2" checked="">
                                                <label class="custom-control-label" for="customSwitch2">Włącz powiadomienia</label>
                                            </div>
                                            @if($isEnabledNotificationOverview)
                                            <select wire:model="notificationOverviewTime" class="custom-select my-2 form-control">
                                            @else
                                            <select wire:model="notificationOverviewTime" class="custom-select my-2 form-control" disabled="disabled">
                                            @endif
                                                @foreach ($notificationTimeList as $time)
                                                    <option value="{{ $time['time'] }}">{{ $time['description'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="container">
                                    <div class="row my-2">
                                        <h6>Powiadomienia o ubezpieczeniach</h6>
                                    </div>
                                    <div class="row my-2">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input wire:model="isEnabledNotificationInsurance" type="checkbox" class="custom-control-input" id="customSwitch3" checked="">
                                                <label class="custom-control-label" for="customSwitch3">Włącz powiadomienia</label>
                                            </div>
                                            @if($isEnabledNotificationInsurance)
                                            <select wire:model="notificationInsuranceTime" class="custom-select my-2 form-control">
                                            @else
                                            <select wire:model="notificationInsuranceTime" class="custom-select my-2 form-control" disabled="disabled">
                                            @endif
                                                @foreach ($notificationTimeList as $time)
                                                    <option value="{{ $time['time'] }}">{{ $time['description'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row my-3 justify-content-end mr-md-3 mr-0">
                            <button wire:click="saveNotificationRuleChanges" type="button" class="btn btn-success mx-1">
                                Zapisz zmiany
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row justify-content-center m-2">
        <div class="col-xl-10 col-md-12 p-0">
            <div class="card border-primary " >
                <div class="card-body p-2 p-sm-3">                   
                    <div class="container">
                        <div class="row my-3">
                            <div class="col-md-9">
                                <h5 class="card-title mt-2">{{ __('Twoje adresy email') }}</h5>
                            </div>
                            <div class="col-md-3">
                            @if($addNewMail == false)
                                <button wire:click="$set('addNewMail', true)" type="button" class="btn btn-outline-primary btn-block">
                                    Dodaj adres email
                                </button>
                            @endif
                            </div>
                        </div>
                        @if ($addNewMail)
                        <div class="row my-3">
                            <div class="col-md-4">
                                <input id="newMail" wire:model="newMail" type="text" class="form-control" placeholder="Nowy adres email">
                                @error('newMail') 
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>                            
                            <div class="col-md-4 offset-md-4">
                                <div class="btn-group btn-block" role="group">
                                    <button wire:click="cancelSaveNewEmail" type="button" class="btn btn-outline-danger">
                                        Anuluj
                                    </button>
                                    <button wire:click="saveNewEmail" type="button" class="btn btn-success">
                                        Zapisz
                                    </button>
                                </div>  
                            </div>
                        </div>
                        <div>
                            <hr/>
                        </div>
                        @endif
                        @foreach ($emailAdress as $index => $email)
                        <div class="row my-2">
                            <div class="col-md-3">
                                @if($editEmail == $email['id'])
                                    <input wire:model="editedEmail" type="text" class="form-control" placeholder="Adres email">
                                @else
                                <h6>{{ $email['email'] }}</h6>                                
                                <div class="custom-control custom-switch">
                                    <input wire:model="emailAdress.{{$index}}.enable" type="checkbox" class="custom-control-input" id="cus{{$index}}" checked="">
                                    <label class="custom-control-label" for="cus{{$index}}">Aktywny</label>
                                </div>
                                @endif
                                
                            </div>
                            <div class="col-md-6">
                                <div class="container my-2">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="custom-control custom-checkbox mx-2">
                                            @if( $emailAdress[$index]['enable'] )
                                                <input wire:model="emailAdress.{{$index}}.parts_notifications" type="checkbox" class="custom-control-input" id="cch1{{$index}}" >
                                            @else
                                                <input wire:model="emailAdress.{{$index}}.parts_notifications" type="checkbox" class="custom-control-input" id="cch1{{$index}}" disabled="disabled" >
                                            @endif
                                                <label class="custom-control-label" for="cch1{{$index}}">Części</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="custom-control custom-checkbox mx-2">
                                            @if( $emailAdress[$index]['enable'] )
                                                <input wire:model="emailAdress.{{$index}}.overviews_notifications" type="checkbox" class="custom-control-input" id="cch2{{$index}}" >
                                            @else
                                                <input wire:model="emailAdress.{{$index}}.overviews_notifications" type="checkbox" class="custom-control-input" id="cch2{{$index}}" disabled="disabled" >
                                            @endif
                                                <label class="custom-control-label" for="cch2{{$index}}">Przeglądy</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="custom-control custom-checkbox mx-2">
                                            @if( $emailAdress[$index]['enable'] )
                                                <input wire:model="emailAdress.{{$index}}.insurances_notifications" type="checkbox" class="custom-control-input" id="cch3{{$index}}" >
                                            @else
                                                <input wire:model="emailAdress.{{$index}}.insurances_notifications" type="checkbox" class="custom-control-input" id="cch3{{$index}}" disabled="disabled" >
                                            @endif
                                                <label class="custom-control-label" for="cch3{{$index}}">Ubezpieczenia</label>
                                            </div>
                                        </div>
                                    </div>            
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="btn-group btn-block" role="group" id="1">
                                @if($editEmail != $email['id'])
                                    @if($ifDeleteEmail != $email['id'])
                                    
                                        <button wire:click="setEditEmail({{$email['id']}})" type="button" class="btn btn-outline-primary">
                                            Edytuj
                                        </button>
                                        <button wire:click="setDeleteEmail({{$email['id']}})" type="button" class="btn btn-danger">
                                            Usuń
                                        </button>
                                    @elseif($ifDeleteEmail == $email['id'])
                                        <button id="3" type="button" wire:click="confirmDeleteEmail" class="btn btn-outline-danger">
                                            Usuń
                                        </button>
                                        <button type="button" wire:click="cancelDeleteEmail" class="btn btn-success">
                                            Anuluj
                                        </button>                               
                                    @endif
                                @else
                                    <button wire:click="cancelEditEmail" type="button" class="btn btn-outline-primary">
                                        Anuluj
                                    </button>
                                    <button wire:click="saveEditEmail" type="button" class="btn btn-success">
                                        Zapisz
                                    </button>
                                @endif
                                </div>                             
                            </div>
                        </div>
                        <div>
                            <hr/>
                        </div>
                        @endforeach
                        <div class="row my-3 justify-content-end mr-md-3 mr-0">
                            <button wire:click="saveEmailsRuleChanges" type="button" class="btn btn-success mx-1">
                                Zapisz zmiany
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
