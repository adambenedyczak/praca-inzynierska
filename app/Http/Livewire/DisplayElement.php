<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Detail;
use App\Models\Element;
use Livewire\Component;
use App\Models\PartType;
use App\Models\ObjectModel;
use App\Models\OverviewType;
use App\Models\InsuranceType;
use Illuminate\Support\Carbon;
use App\Models\WorkTimeHistory;
use App\Models\NotificationRules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DisplayElement extends Component
{
    public $element_id;
    public $element;
    public $alert = false;
    
    public $event;
    public $ownDetails = [];
    public $ownDetailsEdit = [];
    public $object;

    public $ifMore = false;
    public $action = 0;

    public $allType = [];
    public $selectedType;

    public $oldSetEvent;
    public $isSetEvent;

    public $element_name;
    public $selectedCategory;
    public $tomorrow;
    public $today;
    public $workTimeValue;
    public $workTVV;
    
    public $nextDate;
    public $nextWorkTimeValue;

    public $doneDate;
    public $doneWorkTimeValue;
    public $nextNextDate;
    public $nextNextWorkTimeValue;

    public $allEventsPast;
    public $futureEvent;

    public function mount(){
        $this->element = Element::with(
                    'detail_ownerable',
                    'elements_typeable', 
                    'element_category',
                    'events')
                    ->where('id', $this->element_id)   
                    ->first();
        $this->selectedCategory = $this->element->elements_category_id;   
        $this->object = ObjectModel::with('work_time_unit')->where('id', $this->element->object_model_id)->first();

        $this->event = Event::where('element_id', $this->element_id)->where('events_type_id', 2)->first(); 
            if($this->event == null){
                $this->isSetEvent = false;
                
            }else{
                $this->isSetEvent = true;
            }
            $this->oldSetEvent = $this->isSetEvent;


        if($this->selectedCategory == 1){
            $this->allType = PartType::orderBy('name')->get();
        }elseif($this->selectedCategory == 2){
            $this->allType = OverviewType::orderBy('name')->get();
        }elseif($this->selectedCategory == 3){
            $this->allType = InsuranceType::orderBy('name')->get();
        }
        $this->tomorrow = Carbon::now()->addDays(1)->format('d-m-Y');
        $this->today = Carbon::now()->format('d-m-Y');

        if(WorkTimeHistory::where('object_model_id', $this->object->id)->orderBy('created_at', 'desc')->first()){
            $this->workTimeValue = WorkTimeHistory::where('object_model_id', $this->object->id)->orderBy('created_at', 'desc')->first();
            $this->workTVV = $this->workTimeValue->value;
        }else{
            $this->workTVV = 0;
        }
        $this->element_name = $this->element->name;
        $this->selectedType = $this->element->elements_typeable_id; 
        if(isset($this->event->expired_date)){
            $this->nextDate = $this->event->expired_date;
        } 
        if(isset($this->event->work_time_value)){
            $this->nextWorkTimeValue = $this->event->work_time_value;
        }
        if($this->isSetEvent){
            $this->rules = NotificationRules::where('user_id', Auth::id())->first();
            $this->parts_date = Carbon::now()->addDays($this->rules->parts_notifications)->format('Y-m-d');
            $this->overviews_date = Carbon::now()->addDays($this->rules->overviews_notifications)->format('Y-m-d');
            $this->insurances_date = Carbon::now()->addDays($this->rules->insurances_notifications)->format('Y-m-d');
            switch($this->element->elements_category_id){
                case '1':
                    if($this->event->expired_date <= $this->parts_date){
                        $this->alert = true;
                    }
                    break;
                case '2':
                    if($this->event->expired_date <= $this->overviews_date){
                        $this->alert = true;
                    }
                    break;
                case '3':
                    if($this->event->expired_date <= $this->insurances_date){
                        $this->alert = true;
                    }
                    break;
            }
        }
    }

    public function setDelete(){
        $this->action = 3;
    }

    public function cancelDeleteElement(){
        $this->action = 0;
    }

    public function updatedAction(){
        if($this->action == 2){
            $this->ownDetailsEdit = array_values(Detail::where('detail_ownerable_type', get_class($this->element))
                ->where('detail_ownerable_id', $this->element_id)
                ->whereNotNull('own_name')->get()->toArray());
        }
    }

    public function confirmDeleteElement(){
        $element = Element::findOrFail($this->element_id);
        $element->delete();

        switch($this->object->object_type_id){
            case '1': 
                return redirect()->route('vehicles.show', $this->object->id);
                break;
            case '2':
                return redirect()->route('trailers.show', $this->object->id);
                break;
            case '3':
                return redirect()->route('machines.show', $this->object->id);
                break;
            default:
                return redirect()->route('');
                break;
        }
    }
    public function addElementDetail()
    {
        $this->ownDetailsEdit[] = ['own_name' => '', 'value' => ''];
    }

    public function removeElementDetail($index)
    {
        unset($this->ownDetailsEdit[$index]);
        $this->ownDetailsEdit = array_values($this->ownDetailsEdit);
    }

    public function hydrate(){
        $this->ownDetailsEdit;
    }

    public function showHistory(){
        $this->emit('show'.$this->element_id);
    }

    public function render()
    {
        if($this->ifMore == false){
            $this->action = 0;
        }

        $count = Detail::where('detail_ownerable_type', get_class($this->element))
                        ->where('detail_ownerable_id', $this->element_id)
                        ->whereNotNull('own_name')->count();        
        if($count > 1){
            $count_half = $count/2;
            $ownDetails = Detail::where('detail_ownerable_type', get_class($this->element))
                            ->where('detail_ownerable_id', $this->element_id)
                            ->whereNotNull('own_name')->get();
            $this->ownDetails = $ownDetails->chunk($count_half)->toArray();
        }else{
            $ownDetails = Detail::where('detail_ownerable_type', get_class($this->element))
                            ->where('detail_ownerable_id', $this->element_id)
                            ->whereNotNull('own_name')->get();
            $this->ownDetails = $ownDetails->chunk(1)->toArray();
        }
        
        $this->allEventsPast = Event::where('element_id', $this->element_id)
                ->where('events_type_id', 1)
                ->orderBy('done_date', 'desc')
                ->get();
        $this->futureEvent = Event::where('element_id', $this->element_id)
                ->where('events_type_id', 2)
                ->first();

        $this->element = Element::with(
            'detail_ownerable', 'elements_typeable', 'element_category', 'events')
            ->where('id', $this->element_id)->first();
        $this->event = Event::where('element_id', $this->element_id)->where('events_type_id', 2)->first(); 

        info($this->ownDetailsEdit);
        return view('livewire.display-element');
    }

    public function updateEvent(){
        $this->action = 1;
    }

    public function cancelSave(){
        $this->isSetEvent = $this->oldSetEvent;
        $this->action = 0;
    }

    public function saveAll(){
        if($this->isSetEvent){
            $this->validate(
                [
                    'element_name' => 'required|string|min:3|max:100',
                    'selectedType' => 'required',
                    'nextDate' => 'required|date|after:today',
                    'nextWorkTimeValue' => 'nullable|numeric|gt:workTVV'
                ],
                [
                    'element_name.required' => 'Nazwa jest wymagana',
                    'element_name.min' => 'Nazwa musi mieć minimum :min znaków',
                    'element_name.max' => 'Nazwa może mieć maksymalnie :max znaków',
                    'selectedType.required' => 'Kategoria jest wymagana',
                    'nextDate.required' => 'Data jest wymagana',
                    'nextDate.after' => 'Data musi być wartością z przyszłości',
                    'nextWorkTimeValue.gt' => 'Przebieg musi być większy niż aktualny'
                ]
            );
        }else{
            $this->validate(
                [
                    'element_name' => 'required|string|min:3|max:100',
                    'selectedType' => 'required',
                ],
                [
                    'element_name.required' => 'Nazwa jest wymagana',
                    'element_name.min' => 'Nazwa musi mieć minimum :min znaków',
                    'element_name.max' => 'Nazwa może mieć maksymalnie :max znaków',
                    'selectedType.required' => 'Kategoria jest wymagana',
                ]
            );
        }
        $user = Auth::id();
        DB::beginTransaction();
        try{
            $element = Element::findOrFail($this->element_id);
            $element->name = ucfirst(trim($this->element_name));
            $element->elements_typeable_id = $this->selectedType;
            $element->save();

            $detail = new Detail;

            $detailToDelete = Detail::where('detail_ownerable_type', get_class($element))
                        ->where('detail_ownerable_id', $element->id)            
                        ->forceDelete();

            if($this->ownDetailsEdit != null){
                foreach($this->ownDetailsEdit as $detail){
                    if($detail['own_name'] != null && $detail['value'] != null){
                        $new_detail = new Detail;
                        $new_detail->detail_ownerable_type = get_class($element);
                        $new_detail->detail_ownerable_id = $element->id;
                        $new_detail->own_name = ucfirst(trim($detail['own_name']));
                        $new_detail->value = trim($detail['value']);
                        $new_detail->save();
                    }
                }
            }

            if($this->oldSetEvent == $this->isSetEvent){
                $event = Event::where('element_id', $this->element_id)->where('events_type_id', 2)->first();
                $event->expired_date = $this->nextDate;
                if($this->nextWorkTimeValue != null){
                    $event->work_time_value = $this->nextWorkTimeValue;
                }else{
                    $event->work_time_value = NULL;
                }
                $event->save();
                $this->emit('refreshEvents');
            }elseif($this->oldSetEvent==false && $this->isSetEvent==true){
                $event = new Event;
                $event->element_id = $element->id;
                $event->events_type_id = 2;
                $event->expired_date = $this->nextDate;
                if($this->nextWorkTimeValue != null){
                    $event->work_time_value = $this->nextWorkTimeValue;
                }
                $event->save();
                $this->emit('refreshEvents');
            }elseif($this->oldSetEvent==true && $this->isSetEvent==false){
                $event = Event::where('element_id', $this->element_id)->where('events_type_id', 2)->first();
                $event->delete();
            }
            
            DB::commit();
            $this->nextDate = '';
            $this->nextWorkTimeValue = '';
            $this->oldSetEvent =$this->isSetEvent;
        }catch (\Exception $ex) {
            DB::rollback();
        }
        session()->flash('message', 'Zmiany w elemencie zostały zapisane!');
        $this->action = 0;
    }

    public function cancelNewEvent(){
        $this->action = 0;
    }

    public function storeNewEvent(){
        $this->validate([
            'doneDate' => 'required|date|before_or_equal:today',
            'doneWorkTimeValue' => 'nullable|numeric|gte:workTVV',
            'nextNextDate' => 'required|date|after:doneDate|after:today',
            'nextNextWorkTimeValue' => 'nullable|numeric|gt:doneWorkTimeValue',
        ],
        [
            'doneDate.required' => 'Data jest wymagana',
            'doneDate.before_or_equal' => 'Data nie może być późniejsza niż :date',
            'doneWorkTimeValue.gte' => 'Przebieg musi być większy lub równy aktualnemu w bazie',
            'nextNextDate.required' => 'Data jest wymagana',
            'nextNextDate.after' => 'Data musi poźniejsza niź :date',
            'nextNextWorkTimeValue.gt' => 'Przebieg musi być większy niż :value',
        ]);

        
        $event = Event::where('element_id', $this->element_id)->where('events_type_id', 2)->first();
        $event->events_type_id = 1;
        $event->done_date = $this->doneDate;
        if($this->doneWorkTimeValue != null){
            $event->done_work_time_value = $this->doneWorkTimeValue;
        }
        $event->save();

        $new_event = new Event;
        $new_event->element_id = $this->element->id;
        $new_event->events_type_id = 2;
        $new_event->expired_date = $this->nextNextDate;
        if($this->nextNextWorkTimeValue != null){
            $new_event->work_time_value = $this->nextNextWorkTimeValue;
        }
        $new_event->save();

        if($this->doneWorkTimeValue != null){
            $this->emit('staffDirectoryRefresh');
        }

        $this->emit('refreshEvents');

        $this->doneDate = '';
        $this->doneWorkTimeValue = '';
        $this->nextDate = '';
        $this->nextWorkTimeValue = '';
        $this->nextNextDate = '';
        $this->nextNextWorkTimeValue = '';
        $this->action = 0;
        session()->flash('message', 'Element został zaktualizowany!');
    }


}
