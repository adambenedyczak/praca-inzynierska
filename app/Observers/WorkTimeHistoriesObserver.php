<?php

namespace App\Observers;
use App\Models\ObjectModel;
use App\Models\WorkTimeHistory;
use Illuminate\Support\Facades\Auth;

class WorkTimeHistoriesObserver
{
    public function creating(WorkTimeHistory $event){
        $object = $event->object_model_id;
        $current_value = WorkTimeHistory::where('object_model_id', $object)
                                    ->orderBy('created_at', 'desc')
                                    ->first();
        if($current_value == $event->falue){
            return false;
        }
    }    

    public function created(WorkTimeHistory $event){
        $object = $event->object_model_id;
        $updated_object = ObjectModel::where('id', $object)->first();
        $updated_object->current_work_time_value = $event->value;
        $updated_object->save();
    }  
}
