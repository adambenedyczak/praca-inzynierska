<?php

namespace App\Http\Livewire;

use App\Models\Element;
use Livewire\Component;
use App\Models\ObjectModel;
use App\Models\WorkTimeHistory;

class DisplayElements extends Component
{
    public $ifAddElement = false;
    public $ifAddWorkTimeHistory = false;
    public $object_id;
    public $object;

    public $currentWorkTimeValue;
    public $oldWorkTimeValue;

    public $elements = [];

    public function mount(){
        $this->object = ObjectModel::with('detail_ownerable', 'work_time_unit')->where('id', $this->object_id)->first();
        $this->objectType = $this->object->object_type_id;

        $this->elements = Element::with(
                    'detail_ownerable',
                    'elements_typeable', 
                    'element_category')
                    ->where('object_model_id', $this->object_id)   
                    ->orderBy('elements_category_id')                 
                    ->orderBy('elements_typeable_id')
                    ->orderBy('name')->get()
                    ->groupBy( 'elements_category_id', 'elements_typeable_id')
                    ->all();
        if(WorkTimeHistory::where('object_model_id', $this->object->id)->orderBy('created_at', 'desc')->first()){
            $this->currentWorkTimeValue = WorkTimeHistory::where('object_model_id', $this->object->id)->orderBy('created_at', 'desc')->first()->value;
            $this->oldWorkTimeValue = $this->currentWorkTimeValue;
        }else{
            $this->oldWorkTimeValue = 0;
        }
    }

    public function storeNewWorkTimeHistory(){
        $this->validate([
            'currentWorkTimeValue' => 'required|numeric|gt:oldWorkTimeValue',
        ],
        [
            'currentWorkTimeValue.required' => 'Wartość jest wymagana',
            'currentWorkTimeValue.gte' => 'Przebieg musi być większy niż aktualny'
        ]);
        $newWorkTimeHistory = new WorkTimeHistory;
        $newWorkTimeHistory->object_model_id = $this->object_id;
        $newWorkTimeHistory->value = $this->currentWorkTimeValue;
        $newWorkTimeHistory->save();
        $this->ifAddWorkTimeHistory = false;
    }

    public function addNewElement(){
        $this->ifAddElement = true;
    }
    public function render()
    {
        return view('livewire.display-elements');
    }
}
