<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Detail;
use App\Models\Element;
use Livewire\Component;
use App\Models\ObjectModel;
use App\Models\Notification;
use App\Models\WorkTimeUnit;
use Illuminate\Support\Carbon;
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
    public $isArchival = false;
    public $ifSetArchival = false;
    public $workTimeValue;

    public $openSection = 0;

    public $listeners = ['refreshElements' => 'render'];


    public function mount(){
        $this->object = ObjectModel::with('detail_ownerable', 'work_time_unit')->where('id', $this->object_id)->first();
        $this->fav = $this->object->favourite;
        $this->isArchival = $this->object->archival;
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



    public function confirmDelete(){
        $events = Event::with('element.object_model')
                ->where('events_type_id', 2)
                ->whereHas('element.object_model', function ($query) {
                    $query->where('id', $this->object_id);
                })->get();
        foreach($events as $event){
            Notification::where('events_id', $event->id)->forceDelete();
        }

        $events = Event::with('element.object_model')
                ->whereHas('element.object_model', function ($query) {
                    $query->where('id', $this->object_id);
                })->get();
        foreach($events as $event){
            $event->forceDelete();
        }

        $elements = Element::where('object_model_id', $this->object_id)->get();

        foreach($elements as $element){
            Detail::where('elements_typeable_type', $element->elements_typeable_type)
                ->where('elements_typeable_id', $element->elements_typeable_id)->delete();
        }

        Detail::where('detail_ownerable_type', 'App\Models\ObjectModel')
                ->where('detail_ownerable_id', $this->object_id)->delete();

        ObjectModel::findOrFail($this->object_id)->delete();

        switch($this->objectType){
            case '1': 
                session()->flash('message', 'Pojazd został usunięty');
                return redirect()->route('vehicles.index');
                break;
            case '2':
                session()->flash('message', 'Przyczepa została usunięta');
                return redirect()->route('trailers.index');
                break;
            case '3':
                session()->flash('message', 'Maszyna została usunięta');
                return redirect()->route('machines.index');
                break;
            default:
                return redirect()->route('');
                break;
        }
    }

    public function confirmSetArchival(){        
        if($this->isArchival == false){
            $events = Event::with('element.object_model')
                    ->where('events_type_id', 2)
                    ->whereHas('element.object_model', function ($query) {
                        $query->where('id', $this->object_id);
                    })->get();
            foreach($events as $event){
                Notification::where('events_id', $event->id)->forceDelete();
                $event->forceDelete();
            }

            $this->object->archival = true;
            $this->object->favourite = false;
            $this->object->save();

            switch($this->objectType){
                case '1': 
                    session()->flash('message', 'Pojazd został przeniesiony do archiwum');
                    return redirect()->route('vehicles.index');
                    break;
                case '2':
                    session()->flash('message', 'Przyczepa została przeniesiona do archiwum');
                    return redirect()->route('trailers.index');
                    break;
                case '3':
                    session()->flash('message', 'Maszyna została przeniesiona do archiwum');
                    return redirect()->route('machines.index');
                    break;
                default:
                    return redirect()->route('');
                    break;
            }
        }else{
            $this->object->archival = false;
            $this->object->save();

            switch($this->objectType){
                case '1': 
                    session()->flash('message', 'Pojazd został przywrócony');
                    return redirect()->route('vehicles.show', ['id' => $this->object_id, 'openSection' => '0']);
                    break;
                case '2':
                    session()->flash('message', 'Przyczepa została przywrócona');
                    return redirect()->route('trailers.show', ['id' => $this->object_id, 'openSection' => '0']);
                    break;
                case '3':
                    session()->flash('message', 'Maszyna została przywrócona');
                    return redirect()->route('machines.show', ['id' => $this->object_id, 'openSection' => '0']);
                    break;
                default:
                    return redirect()->route('');
                    break;
            }
        }
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
