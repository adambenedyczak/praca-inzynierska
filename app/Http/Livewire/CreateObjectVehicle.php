<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ObjectModel;
use App\Models\WorkTimeUnit;
use App\Models\ObjectDetailType;
use Illuminate\Support\Facades\Auth;

class CreateObjectVehicle extends Component
{
    public $object_name = '';
    public $object_unit = '';
    public $addDetails = [];
    public $addOwnDetails = [];
    public $allDetailsType = [];
    public $workTimeUnits = [];

    public function mount()
    {
        $this->object_name;
        $this->allDetailsType = ObjectDetailType::all();
        $this->workTimeUnits = WorkTimeUnit::all();
        $this->addDetails = [
            ['detail_type_id' => '', 'value' => '']
        ];
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
        return view('livewire.create-object-vehicle');
    }

    protected $rules = [
        'object_name' => 'required|string|min:5|max:100',
        'object_unit' => 'required',
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
            'object_unit.required' => 'Jednostka czasu pracy jest wymagana'
        ];
    }
}
