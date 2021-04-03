<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PartType;
use App\Models\ObjectModel;
use App\Models\PartDetailType;

class CreateElementPart extends Component
{
    public $parent_id;
    public $parent;
    public $object_type_id;
    public $part_type = '';
    public $allPartType = [];
    public $addDetails = [];
    public $allDetailsType = [];
    public $addOwnDetails = [];
    public $object_name = '';

    public function mount($parent, $id)
    {
        $this->parent_id = $parent;
        $this->object_type_id = $id;
        $this->parent = ObjectModel::where('id', $this->parent_id)->first();
        $this->allPartType = PartType::all();
        $this->object_name;
        $this->allDetailsType = PartDetailType::all();
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
        return view('livewire.create-element-part');
    }

    protected $rules = [
        'part_name' => 'nullable|string|min:5|max:100',
        'part_type' => 'required',
    ];

    public function updated($part_name){
        $this->validateOnly($part_name);
    }

    public function messages()
    {
        return [
            'part_type.required' => 'Typ części jest wymagany',
            'part_name.min' => 'Nazwa musi mieć minimum :min znaków',
            'part_name.max' => 'Nazwa może mieć maksymalnie :max znaków',
            
        ];
    }
}
