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
        if($current_value == $event->value){
            return false;
        }
    }    
}
