<?php

namespace App\Http\Livewire;

use App\Models\Detail;
use Livewire\Component;
use App\Models\ObjectModel;
use App\Models\WorkTimeUnit;
use App\Models\WorkTimeHistory;
use App\Models\ObjectDetailType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AddNewObject extends Component
{
    public $selectedObjectType = 1;
    public $allWorkTimeUnit = [];
    public $selectedWorkTimeUnit;
    public $defaultWorkTimeUnit = 1;

    public $object_name = '';
    public $addDetails = [];
    public $addOwnDetails = [];
    public $allDetailsType = [];

    public $workTimeValue;

    public function mount(){
        $this->allWorkTimeUnit = WorkTimeUnit::all();
        $this->allDetailsType = ObjectDetailType::orderBy('name')->get();
        $this->addDetails = [
            ['detail_type_id' => '', 'value' => '']
        ];
        $this->selectedWorkTimeUnit = 2;
    }
    
    public function updatedSelectedObjectType(){
        if($this->selectedObjectType == 1){
            $this->selectedWorkTimeUnit = 2;
        }elseif($this->selectedObjectType == 2){
            $this->selectedWorkTimeUnit = 1;
        }elseif($this->selectedObjectType == 3){
            $this->selectedWorkTimeUnit = 3;
        }        
    }

    public function updatedSelectedWorkTimeUnit($value){
        $this->selectedWorkTimeUnit = $value;
    }

    public function addDetail()
    {
        $this->addDetails[] = ['detail_type_id' => '', 'value' => ''];
    }

    public function addOwnDetail()
    {
        $this->addOwnDetails[] = ['own_name' => '', 'value' => ''];
    }

    public function removeDetail($index)
    {
        unset($this->addDetails[$index]);
        $this->addDetails = array_values($this->addDetails);
    }

    public function removeOwnDetail($index)
    {
        unset($this->addOwnDetails[$index]);
        $this->addOwnDetails = array_values($this->addOwnDetails);
    }



    public function render()
    {
        info($this->addDetails);
        return view('livewire.add-new-object')
                    ->extends('layouts.app');
    }

    protected $rules = [
        'object_name' => 'required|string|min:5|max:100',
        'selectedWorkTimeUnit' => 'required',
        'workTimeValue' => 'nullable|numeric|gt:0'
    ];

    public function updated($object_name){
        $this->validateOnly($object_name);
    }

    public function messages()
    {
        return [
            'object_name.required' => 'Nazwa jest wymagana',
            'object_name.min' => 'Nazwa musi mieć minimum :min znaków',
            'object_name.max' => 'Nazwa może mieć maksymalnie :max znaków',
            'selectedWorkTimeUnit.required' => 'Jednostka czasu pracy jest wymagana',
            'workTimeValue.gt' => 'Przebieg musi być wartością dodatnią',
        ];
    }

    public function saveAll(){
        $this->validate();
        
        $obiekt = new ObjectModel;            
        DB::beginTransaction();
        try{
            $user = Auth::user()->id;
            $obiekt->name = ucfirst(trim($this->object_name));
            $obiekt->object_type_id = $this->selectedObjectType;
            $obiekt->user_id = $user;
            $obiekt->work_time_unit_id = $this->selectedWorkTimeUnit;
            $obiekt->save();

            if($this->workTimeValue != null){
                $przebieg = new WorkTimeHistory;
                $przebieg->object_model_id = $obiekt->id;
                $przebieg->value = $this->workTimeValue;
                $przebieg->save();
            }

            $OBT = new ObjectDetailType;

            foreach($this->addDetails as $detail){
                if($detail['detail_type_id'] != null && $detail['value'] != null){
                    $new_detail = new Detail;
                    $new_detail->detail_ownerable_type = get_class($obiekt);
                    $new_detail->detail_ownerable_id = $obiekt->id;
                    $new_detail->detail_typeable_type = get_class($OBT);
                    $new_detail->detail_typeable_id = trim($detail['detail_type_id']);
                    $new_detail->value = $detail['value'];
                    $new_detail->save();
                }            
            }

            if($this->addOwnDetails != null){
                foreach($this->addOwnDetails as $detail){
                    if($detail['own_name'] != null && $detail['value'] != null){
                        $new_detail = new Detail;
                        $new_detail->detail_ownerable_type = get_class($obiekt);
                        $new_detail->detail_ownerable_id = $obiekt->id;
                        $new_detail->own_name = ucfirst(trim($detail['own_name']));
                        $new_detail->value = trim($detail['value']);
                        $new_detail->save();
                    }
                }
            }
            DB::commit();
        }catch (\Exception $ex) {
            DB::rollback();
        }

        switch($this->selectedObjectType){
            case '1': 
                session()->flash('message', 'Nowy pojazd został dodany!');
                return redirect()->route('vehicles.show', $obiekt->id);
                break;
            case '2':
                session()->flash('message', 'Nowa przyczepa została dodana!');
                return redirect()->route('trailers.show', $obiekt->id);
                break;
            case '3':
                return redirect()->route('machines.show', $obiekt->id);
                break;
            default:
            session()->flash('message', 'Nowa maszyna została dodana!');
                return redirect()->route('');
                break;
        }

    }
}
