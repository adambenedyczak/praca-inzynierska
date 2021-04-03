<?php

namespace App\Http\Livewire;

use App\Models\Element;
use Livewire\Component;
use App\Models\ObjectModel;

class DisplayElements extends Component
{
    public $ifAddElement = false;
    public $object_id;
    public $object;

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
        //dd($this->elements);

    }

    public function addNewElement(){
        $this->ifAddElement = true;
    }
    public function render()
    {
        return view('livewire.display-elements');
    }
}
