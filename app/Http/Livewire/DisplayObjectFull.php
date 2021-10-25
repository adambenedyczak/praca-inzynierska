<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Detail;
use App\Models\Element;
use Livewire\Component;
use App\Models\ObjectModel;
use App\Models\Notification;
use App\Models\WorkTimeUnit;
use App\Models\WorkTimeHistory;
use App\Models\ObjectDetailType;

class DisplayObjectFull extends Component
{
    public $object_id;
    public $object;
    public $fav;
    public $objectType;
    public $selectedWorkTimeUnit;
    public $allWorkTimeUnit = [];

    public $details = [];
    public $ownDetails = [];
    public $object_name;


    public $ifDelete = false;
    public $workTimeValue;

    public $openSection = 0;

    public $listeners = ['refreshElements' => 'render',
                        'refreshEvents' => 'refresh'];


    public function mount(){
        $this->object = ObjectModel::with('detail_ownerable', 'work_time_unit')->where('id', $this->object_id)->first();
        $this->fav = $this->object->favourite;
        $this->objectType = $this->object->object_type_id;
        $this->object_name = $this->object->name;
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
        $events = Event::with('element','element.object_model')
                ->where('events_type_id', 2)
                ->whereHas('element.object_model', function ($query) {
                    $query->where('id', $this->object_id);
                })->get();
        foreach($events as $event){
            Notification::where('events_id', $event->id)->delete();
        }

        $elements = Element::where('object_model_id', $this->object_id)->get();

        foreach($elements as $element){
            Detail::where('elements_typeable_type', $element->elements_typeable_type)
                ->where('elements_typeable_id', $element->elements_typeable_id)->delete();
        }

        Detail::where('detail_ownerable_type', 'App\Models\ObjectModel')
                ->where('detail_ownerable_id', $this->object_id)->delete();

        ObjectModel::findOrFail($this->object_id)->delete();

        session()->flash('message', 'Pojazd został usunięty');
        return redirect()->route('vehicles.index');
    }

    public function render()
    {
        $this->workTimeValue = WorkTimeHistory::where('object_model_id', $this->object_id)->orderBy('created_at', 'desc')->first();
        $this->details = Detail::where('detail_ownerable_type', get_class($this->object))
                    ->where('detail_ownerable_id', $this->object_id)
                    ->whereNull('own_name')
                    ->orderBy('detail_typeable_id')->get();

        $this->ownDetails = Detail::where('detail_ownerable_type', get_class($this->object))
                    ->where('detail_ownerable_id', $this->object_id)
                    ->whereNotNull('own_name')->get();

        return view('livewire.display-object-full');
    }
}
