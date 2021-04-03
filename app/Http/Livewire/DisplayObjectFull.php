<?php

namespace App\Http\Livewire;

use App\Models\Detail;
use App\Models\Element;
use Livewire\Component;
use App\Models\ObjectModel;
use App\Models\WorkTimeHistory;

class DisplayObjectFull extends Component
{
    public $object_id;
    public $object;
    public $fav;
    public $objectType;

    public $details = [];
    public $ownDetails = [];

    public $ifDelete = false;
    public $workTimeValue;

    public function mount(){
        $this->object = ObjectModel::with('detail_ownerable', 'work_time_unit')->where('id', $this->object_id)->first();
        $this->fav = $this->object->favourite;
        $this->objectType = $this->object->object_type_id;

        $this->details = Detail::where('detail_ownerable_id', $this->object_id)
                    ->whereNull('own_name')->get();

        $this->ownDetails = Detail::where('detail_ownerable_id', $this->object_id)
                    ->whereNotNull('own_name')->get();
        $this->workTimeValue = WorkTimeHistory::where('object_model_id', $this->object_id)->orderBy('created_at', 'desc')->first();
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
        return redirect()->route('vehicles.index');
    }

    public function render()
    {
        return view('livewire.display-object-full');
    }
}
