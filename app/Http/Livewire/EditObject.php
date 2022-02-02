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

class EditObject extends Component
{
    public $object_id;
    public $object;
    public $selectedObjectType = 1;
    public $allWorkTimeUnit = [];
    public $selectedWorkTimeUnit;
    public $defaultWorkTimeUnit = 1;

    public $object_name;
    public $addDetails = [];
    public $addOwnDetails = [];
    public $allDetailsType = [];

    public $workTimeValue;

    public function mount($id)
    {
        $this->object_id = $id;
        $this->object = ObjectModel::where('id', $this->object_id)
            ->where('user_id', Auth::id())->first();
        if ($this->object == null) {
            return redirect()->route('home');
        }
        $this->object_name = $this->object->name;
        $this->selectedWorkTimeUnit = $this->object->work_time_unit_id;
        $this->allWorkTimeUnit = WorkTimeUnit::all();
        $this->allDetailsType = ObjectDetailType::orderBy('name')->get();

        $this->addDetails = array_values(Detail::where('detail_ownerable_type', get_class($this->object))
            ->where('detail_ownerable_id', $this->object_id)
            ->whereNull('own_name')->get()->toArray());

        $this->addOwnDetails = array_values(Detail::where('detail_ownerable_type', get_class($this->object))
            ->where('detail_ownerable_id', $this->object_id)
            ->whereNotNull('own_name')->get()->toArray());
    }

    public function updatedSelectedObjectType()
    {
        if ($this->selectedObjectType == 1) {
            $this->selectedWorkTimeUnit = 2;
        } elseif ($this->selectedObjectType == 2) {
            $this->selectedWorkTimeUnit = 1;
        } elseif ($this->selectedObjectType == 3) {
            $this->selectedWorkTimeUnit = 3;
        }
    }

    public function updatedSelectedWorkTimeUnit($value)
    {
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

    protected $rules = [
        'object_name' => 'required|string|min:5|max:100',
        'selectedWorkTimeUnit' => 'required',
    ];

    public function updated($object_name)
    {
        $this->validateOnly($object_name);
    }

    public function messages()
    {
        return [
            'object_name.required' => 'Nazwa jest wymagana',
            'object_name.min' => 'Nazwa musi mieć minimum :min znaków',
            'object_name.max' => 'Nazwa może mieć maksymalnie :max znaków',
            'selectedWorkTimeUnit.required' => 'Jednostka czasu pracy jest wymagana',
        ];
    }

    public function saveAll()
    {
        $this->validate();

        $obiekt = ObjectModel::find($this->object_id);
        DB::beginTransaction();
        try {
            $obiekt->name = ucfirst(trim($this->object_name));
            $obiekt->work_time_unit_id = $this->selectedWorkTimeUnit;
            $obiekt->save();

            $detailToDelete = Detail::where('detail_ownerable_type', get_class($this->object))
                ->where('detail_ownerable_id', $this->object_id)
                ->delete();

            $OBT = new ObjectDetailType;

            foreach ($this->addDetails as $detail) {
                if ($detail['detail_typeable_id'] != null && $detail['value'] != null) {
                    $new_detail = new Detail;
                    $new_detail->detail_ownerable_type = get_class($obiekt);
                    $new_detail->detail_ownerable_id = $obiekt->id;
                    $new_detail->detail_typeable_type = get_class($OBT);
                    $new_detail->detail_typeable_id = trim($detail['detail_typeable_id']);
                    $new_detail->value = $detail['value'];
                    $new_detail->save();
                }
            }

            if ($this->addOwnDetails != null) {
                foreach ($this->addOwnDetails as $detail) {
                    if ($detail['own_name'] != null && $detail['value'] != null) {
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
        } catch (\Exception $ex) {
            DB::rollback();
        }

        switch ($this->selectedObjectType) {
            case '1':
                return redirect()->route('vehicles.show', ['id' => $obiekt->id, 'openSection' => '0']);
                break;
            case '2':
                return redirect()->route('trailers.show', ['id' => $obiekt->id, 'openSection' => '0']);
                break;
            case '3':
                return redirect()->route('machines.show', ['id' => $obiekt->id, 'openSection' => '0']);
                break;
            default:
                return redirect()->route('');
                break;
        }
    }


    public function render()
    {
        return view('livewire.edit-object')->extends('layouts.app');
    }
}
