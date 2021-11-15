<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Element;
use Livewire\Component;
use App\Models\ObjectModel;
use Illuminate\Support\Carbon;
use App\Models\WorkTimeHistory;
use App\Models\NotificationRules;
use Illuminate\Support\Facades\Auth;

class DisplayElements extends Component
{
    public $ifAddElement = false;
    public $ifAddWorkTimeHistory = false;
    public $object_id;
    public $object;

    public $currentWorkTimeValue;
    public $oldWorkTimeValue;
    public $parts;
    public $overviews;
    public $insurances;

    public $elements = [];
    public $workTimeUnit;
    public $events;
    public $events_gr;

    public $isArchival = false;

    public $openSection = 0; //1,2,3

    public $listeners = ['refreshEvents' => 'remount'];

    public function mount(){
        $this->object = ObjectModel::with('detail_ownerable', 'work_time_unit')->where('id', $this->object_id)->first();
        $this->isArchival = $this->object->archival;
        $this->objectType = $this->object->object_type_id;
        $this->parts = Element::with(
                        'detail_ownerable',
                        'elements_typeable',
                        'element_category')
                    ->where('object_model_id', $this->object_id) 
                    ->where('elements_category_id', 1)
                    ->orderBy('elements_typeable_id')
                    ->orderBy('name')->get();
        $this->overviews = Element::with(
                        'detail_ownerable',
                        'elements_typeable', 
                        'element_category')
                    ->where('object_model_id', $this->object_id) 
                    ->where('elements_category_id', 2)
                    ->orderBy('elements_typeable_id')
                    ->orderBy('name')->get();
        $this->insurances = Element::with(
                        'detail_ownerable',
                        'elements_typeable', 
                        'element_category')
                    ->where('object_model_id', $this->object_id) 
                    ->where('elements_category_id', 3)
                    ->orderBy('elements_typeable_id')
                    ->orderBy('name')->get();
        
        if(WorkTimeHistory::where('object_model_id', $this->object->id)->orderBy('created_at', 'desc')->first()){
            $this->currentWorkTimeValue = WorkTimeHistory::where('object_model_id', $this->object->id)->orderBy('created_at', 'desc')->first()->value;
            $this->oldWorkTimeValue = $this->currentWorkTimeValue;
        }else{
            $this->oldWorkTimeValue = 0;
        }

        $this->rules = NotificationRules::where('user_id', Auth::id())->first();
        $this->parts_date = Carbon::now()->addDays($this->rules->parts_notifications)->format('Y-m-d');
        $this->overviews_date = Carbon::now()->addDays($this->rules->overviews_notifications)->format('Y-m-d');
        $this->insurances_date = Carbon::now()->addDays($this->rules->insurances_notifications)->format('Y-m-d');
        $this->events = Event::with('element','element.object_model')
                    ->where('events_type_id', 2)
                    ->whereHas('element.object_model', function ($query) {
                        $query->where('user_id', Auth::id())
                            ->where('id', $this->object_id);
                    })
                    ->where(function ($q){
                        $q->whereDate('expired_date', '<=', $this->parts_date)
                            ->whereHas('element', function ($query2) {
                                $query2->where('elements_category_id', 1);
                            });
                    })->orWhere(function ($q){
                        $q->whereDate('expired_date', '<=', $this->overviews_date)
                            ->whereHas('element', function ($query2) {
                                $query2->where('elements_category_id', 2);
                            });
                    })->orWhere(function ($q){
                        $q->whereDate('expired_date', '<=', $this->insurances_date)
                            ->whereHas('element', function ($query2) {
                                $query2->where('elements_category_id', 3);
                            });
                    })                  
                    ->get()
                    
                    ->groupBy('element.elements_category_id')
                    ->toArray();    
        //dd($this->events);
    }

    public function remount(){
        $this->object = ObjectModel::with('detail_ownerable', 'work_time_unit')->where('id', $this->object_id)->first();
        $this->objectType = $this->object->object_type_id;
        $this->parts = Element::with(
                    'detail_ownerable',
                    'elements_typeable',
                    'element_category')
                    ->where('object_model_id', $this->object_id) 
                    ->where('elements_category_id', 1)
                    ->orderBy('elements_typeable_id')
                    ->orderBy('name')->get();
        $this->overviews = Element::with(
                    'detail_ownerable',
                    'elements_typeable', 
                    'element_category')
                    ->where('object_model_id', $this->object_id) 
                    ->where('elements_category_id', 2)
                    ->orderBy('elements_typeable_id')
                    ->orderBy('name')->get();
        $this->insurances = Element::with(
                    'detail_ownerable',
                    'elements_typeable', 
                    'element_category')
                    ->where('object_model_id', $this->object_id) 
                    ->where('elements_category_id', 3)
                    ->orderBy('elements_typeable_id')
                    ->orderBy('name')->get();
        
        if(WorkTimeHistory::where('object_model_id', $this->object->id)->orderBy('created_at', 'desc')->first()){
            $this->currentWorkTimeValue = WorkTimeHistory::where('object_model_id', $this->object->id)->orderBy('created_at', 'desc')->first()->value;
            $this->oldWorkTimeValue = $this->currentWorkTimeValue;
        }else{
            $this->oldWorkTimeValue = 0;
        }

        $this->rules = NotificationRules::where('user_id', Auth::id())->first();
        $this->parts_date = Carbon::now()->addDays($this->rules->parts_notifications)->format('Y-m-d');
        $this->overviews_date = Carbon::now()->addDays($this->rules->overviews_notifications)->format('Y-m-d');
        $this->insurances_date = Carbon::now()->addDays($this->rules->insurances_notifications)->format('Y-m-d');
        $this->events = Event::with('element','element.object_model')
                    ->where('events_type_id', 2)
                    ->whereHas('element.object_model', function ($query) {
                        $query->where('user_id', Auth::id())
                            ->where('id', $this->object_id);
                    })
                    ->where(function ($q){
                        $q->whereDate('expired_date', '<=', $this->parts_date)
                            ->whereHas('element', function ($query2) {
                                $query2->where('elements_category_id', 1);
                            });
                    })->orWhere(function ($q){
                        $q->whereDate('expired_date', '<=', $this->overviews_date)
                            ->whereHas('element', function ($query2) {
                                $query2->where('elements_category_id', 2);
                            });
                    })->orWhere(function ($q){
                        $q->whereDate('expired_date', '<=', $this->insurances_date)
                            ->whereHas('element', function ($query2) {
                                $query2->where('elements_category_id', 3);
                            });
                    })                  
                    ->get()
                    
                    ->groupBy('element.elements_category_id')
                    ->toArray();    
        //dd($this->events);
    }

    public function storeNewWorkTimeHistory(){
        $this->validate([
            'currentWorkTimeValue' => 'required|numeric|gt:oldWorkTimeValue',
        ],
        [
            'currentWorkTimeValue.required' => 'Wartość jest wymagana',
            'currentWorkTimeValue.gt' => 'Przebieg musi być większy niż aktualny'
        ]);
        
        $newWorkTimeHistory = new WorkTimeHistory;
        $newWorkTimeHistory->object_model_id = $this->object_id;
        $newWorkTimeHistory->value = $this->currentWorkTimeValue;
        $newWorkTimeHistory->save();
        $this->ifAddWorkTimeHistory = false;
        session()->flash('message', 'Przebieg został zaktualizowany!');
        $this->emit('refreshElements');
    }
    
    public function openPDFModal(){
        $this->dispatchBrowserEvent('openPDFModal');
    }

    public function render()
    {        
        $this->workTimeUnit = $this->object->work_time_unit_id;
        return view('livewire.display-elements');
    }
}
