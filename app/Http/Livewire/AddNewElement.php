<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Detail;
use App\Models\Element;
use Livewire\Component;
use App\Models\PartType;
use App\Models\ObjectModel;
use App\Models\OverviewType;
use App\Models\InsuranceType;
use Illuminate\Support\Carbon;
use App\Models\ElementCategory;
use App\Models\WorkTimeHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AddNewElement extends Component
{
    public $object_id;
    public $object;
    public $elementCategoryList = [];
    public $selectedCategory = 1;

    public $allType = [];
    public $selectedType;

    public $element_name;

    public $addOwnDetails = [];
    public $workTimeValue;
    public $workTVV;

    public $nextDate;
    public $nextWorkTimeValue;

    public $addEvent = false;

    public $tomorrow;

    public function mount(){
        $this->elementCategoryList = ElementCategory::all();
        $this->object = ObjectModel::where('id', $this->object_id)->first();
        $this->addOwnDetails = [
            ['own_name' => '', 'value' => '']
        ];
        $this->tomorrow = Carbon::now()->addDays(1)->format('d-m-Y');
        if(WorkTimeHistory::where('object_model_id', $this->object_id)->orderBy('created_at')->first()){
            $this->workTimeValue = WorkTimeHistory::where('object_model_id', $this->object_id)->orderBy('created_at')->first();
            $this->workTVV = $this->workTimeValue->value;
        }
    }

    public function updatedSelectedType($value){
        $this->selectedType = $value;
    }
    
    public function addOwnDetail()
    {
        $this->addOwnDetails[] = ['own_name' => '', 'value' => ''];
    }

    public function removeOwnDetail($index)
    {
        unset($this->addOwnDetails[$index]);
        $this->addOwnDetails = array_values($this->addOwnDetails);
    }

    public function updatedSelectedCategory(){
        $this->selectedType = "";
    }

    public function render()
    {
        info($this->addOwnDetails);
        if($this->selectedCategory == 1){
            $this->allType = PartType::orderBy('name')->get();
        }elseif($this->selectedCategory == 2){
            $this->allType = OverviewType::orderBy('name')->get();
        }elseif($this->selectedCategory == 3){
            $this->allType = InsuranceType::orderBy('name')->get();
        }

        return view('livewire.add-new-element');
    }

    public function saveAll(){
        if($this->addEvent){
            $this->validate(
                [
                    'element_name' => 'required|string|min:2|max:100',
                    'selectedType' => 'required',
                    'nextDate' => 'required|date|after:today',
                    'nextWorkTimeValue' => 'nullable|numeric|gt:workTVV'
                ],
                [
                    'element_name.required' => 'Nazwa jest wymagana',
                    'element_name.min' => 'Nazwa musi mieć minimum :min znaków',
                    'element_name.max' => 'Nazwa może mieć maksymalnie :max znaków',
                    'selectedType.required' => 'Kategoria jest wymagana',
                    'nextDate.required' => 'Data jest wymagana',
                    'nextDate.after' => 'Data musi być wartością z przyszłości',
                    'nextWorkTimeValue.gt' => 'Przebieg musi być większy niż aktualny'
                ]
            );
        }else{
            $this->validate(
                [
                    'element_name' => 'required|string|min:2|max:100',
                    'selectedType' => 'required',
                ],
                [
                    'element_name.required' => 'Nazwa jest wymagana',
                    'element_name.min' => 'Nazwa musi mieć minimum :min znaków',
                    'element_name.max' => 'Nazwa może mieć maksymalnie :max znaków',
                    'selectedType.required' => 'Kategoria jest wymagana',
                ]
            );
        }


        $user = Auth::user()->id;

        DB::beginTransaction();
        try{
            $element = new Element;
            $element->name = ucfirst(trim($this->element_name));
            $element->object_model_id = $this->object_id;
            if($this->selectedCategory == 1){
                $ELT = new PartType;
            }elseif($this->selectedCategory == 2){
                $ELT = new OverviewType;
            }elseif($this->selectedCategory == 3){
                $ELT = new InsuranceType;
            }
            $element->elements_category_id = $this->selectedCategory;
            $element->elements_typeable_type = get_class($ELT);
            $element->elements_typeable_id = $this->selectedType;
            $element->save();


            if($this->addOwnDetails != null){
                foreach($this->addOwnDetails as $detail){
                    if($detail['own_name'] != null && $detail['value'] != null){
                        $new_detail = new Detail;
                        $new_detail->detail_ownerable_type = get_class($element);
                        $new_detail->detail_ownerable_id = $element->id;
                        $new_detail->own_name = ucfirst(trim($detail['own_name']));
                        $new_detail->value = trim($detail['value']);
                        $new_detail->save();
                    }
                }
            }
            
            if($this->addEvent){
                $event = new Event;
                $event->element_id = $element->id;
                $event->events_type_id = 2;
                $event->expired_date = $this->nextDate;
                if($this->nextWorkTimeValue != null){
                    $event->work_time_value = $this->nextWorkTimeValue;
                }
                $event->save();
            }

            DB::commit();
        }catch (\Exception $ex) {
            DB::rollback();
        }
        $this->element_name = '';
        $this->selectedCategory = '';
        $this->selectedType = '';
        $this->nextDate = '';
        $this->nextWorkTimeValue = '';

        session()->flash('message', 'Element został dodany!');

        switch($this->object->object_type_id){
            case '1': 
                return redirect()->route('vehicles.show', $this->object_id);
                break;
            case '2':
                return redirect()->route('trailers.show', $this->object_id);
                break;
            case '3':
                return redirect()->route('machines.show', $this->object_id);
                break;
            default:
                return redirect()->route('');
                break;
        }
    }

    public function cancelAdd(){
        switch($this->object->object_type_id){
            case '1': 
                return redirect()->route('vehicles.show', $this->object_id);
                break;
            case '2':
                return redirect()->route('trailers.show', $this->object_id);
                break;
            case '3':
                return redirect()->route('machines.show', $this->object_id);
                break;
            default:
                return redirect()->route('');
                break;
        }
    }

    public function switchShow(){
        dd('odebrałem!');
        $this->ifShow = true;
    }
}
