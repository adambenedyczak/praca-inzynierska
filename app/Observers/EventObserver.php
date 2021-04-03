<?php

namespace App\Observers;

use App\Models\Event;
use App\Models\Element;
use App\Models\WorkTimeHistory;

class EventObserver
{
    /**
     * Handle the Event "created" event.
     *
     * @param  \App\Models\Event  $event
     * @return void
     */
    public function created(Event $event)
    {
        
    }

    /**
     * Handle the Event "updated" event.
     *
     * @param  \App\Models\Event  $event
     * @return void
     */
    public function updated(Event $event)
    {
        if($event->events_type_id == 1){
            $element = Element::with('object')->where('id', $event->element_id)->first();
            $lastVal = WorkTimeHistory::where('object_model_id', $element->object_model_id)
                                ->orderBy('value', 'desc')->first();
            if(isset($event->done_work_time_value) && $event->done_work_time_value > $lastVal){                
                $newWorkTimeHistory = new WorkTimeHistory;
                $newWorkTimeHistory->object_model_id = $element->object_model_id;
                $newWorkTimeHistory->value = $event->done_work_time_value;
                $newWorkTimeHistory->save();
            }            
        }        
    }

    /**
     * Handle the Event "deleted" event.
     *
     * @param  \App\Models\Event  $event
     * @return void
     */
    public function deleted(Event $event)
    {
        //
    }

    /**
     * Handle the Event "restored" event.
     *
     * @param  \App\Models\Event  $event
     * @return void
     */
    public function restored(Event $event)
    {
        //
    }

    /**
     * Handle the Event "force deleted" event.
     *
     * @param  \App\Models\Event  $event
     * @return void
     */
    public function forceDeleted(Event $event)
    {
        //
    }
}
