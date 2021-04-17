<?php

namespace App\Http\Livewire;

use App\Models\Detail;
use App\Models\Element;
use Livewire\Component;
use App\Models\ObjectModel;
use App\Models\WorkTimeHistory;

class DisplayObject extends Component
{
    public $object_id;
    public $object;
    public $fav;
    public $objectType;

    public $parts;
    public $overviews;
    public $insurances;
    public $details = [];
    public $ownDetails = [];
    public $ifDelete = false;
    public $workTimeValue;

    public function mount(){
        $this->object = ObjectModel::find($this->object_id);
        $this->fav = $this->object->favourite;
        $this->objectType = $this->object->object_type_id;

        $this->parts = Element::where('object_model_id', $this->object_id)
                    ->where('elements_category_id', '1')->count();
        $this->overviews = Element::where('object_model_id', $this->object_id)
                    ->where('elements_category_id', '2')->count();
        $this->insurances = Element::where('object_model_id', $this->object_id)
                    ->where('elements_category_id', '3')->count();

        $this->details = Detail::where('detail_ownerable_type', get_class($this->object))
                    ->where('detail_ownerable_id', $this->object_id)
                    ->whereNull('own_name')
                    ->take(5)->get();
        
        $this->ownDetails = Detail::where('detail_ownerable_type', get_class($this->object))
                    ->where('detail_ownerable_id', $this->object_id)
                    ->whereNotNull('own_name')
                    ->take(5)->get();
        $this->workTimeValue = WorkTimeHistory::where('object_model_id', $this->object_id)->orderBy('created_at')->first();
    }

    public function toggleFav(){
        $this->fav = !$this->fav;
        $object = ObjectModel::find($this->object_id);
        $object->favourite = $this->fav;
        $object->save();
    }

    public function setDelete(){
        $this->ifDelete = true;
    }

    public function cancelDelete(){
        $this->ifDelete = false;
    }

    public function confirmDelete(){
        $vehicle = ObjectModel::findOrFail($this->object_id);
        $vehicle->delete();

        session()->flash('message', 'Pojazd został usunięty');
        switch($this->objectType){
            case '1': 
                return redirect()->route('vehicles.index');
                break;
            case '2':
                return redirect()->route('trailers.index');
                break;
            case '3':
                return redirect()->route('machines.index');
                break;
        }
    }

    public function render()
    {
        return view('livewire.display-object');
    }

    public function showMore(){
        switch($this->objectType){
            case '1': 
                return redirect()->route('vehicles.show', $this->object_id);
                break;
            case '2':
                return redirect()->route('trailers.show', $this->object_id);
                break;
            case '3':
                return redirect()->route('machines.show', $this->object_id);
                break;
        }
    }
}
