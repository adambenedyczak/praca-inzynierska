<?php

namespace App\Observers;

use App\Models\Event;
use App\Models\Element;
use App\Models\Notification;
use Illuminate\Support\Carbon;
use App\Models\WorkTimeHistory;
use App\Models\NotificationRules;
use Illuminate\Support\Facades\Auth;

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
        $event = Event::with('element')->where('id', $event->id)->first();
        $rules = NotificationRules::where('user_id', Auth::id())->first();

        $expired_date = Carbon::createFromFormat('Y-m-d', $event->expired_date);
        $expired_date2 = Carbon::createFromFormat('Y-m-d', $event->expired_date);
        if($event->element->elements_category_id == 1){            
            $first_date = $expired_date->subDays($rules->parts_notifications);
            $next_date = $expired_date2->subDays(1);
        }elseif($event->element->elements_category_id == 2){
            $first_date = $expired_date->subDays($rules->overviews_notifications);
            $next_date = $expired_date2->subDays(1);
        }elseif($event->element->elements_category_id == 3){
            $first_date = $expired_date->subDays($rules->insurances_notifications);
            $next_date = $expired_date2->subDays(1);
        }
        
        $notification = new Notification;
        $notification->events_id = $event->id;
        $notification->elements_category_id = $event->element->elements_category_id;
        $notification->user_id = Auth::id();
        $notification->send = $first_date->format('Y-m-d');
        $notification->next_send = $next_date->format('Y-m-d');
        if( $event->work_time_value != null){
            $notification->work_time_value = $event->work_time_value;
        }
        $notification->save();
    }

    /**
     * Handle the Event "updated" event.
     *
     * @param  \App\Models\Event  $event
     * @return void
     */
    public function updated(Event $event)
    {
        if($event->events_type_id == 1){ //zapisanie przebiegu w historii z eventu wykonanego
            $element = Element::with('object_model')->where('id', $event->element_id)->first();
            $lastVal = WorkTimeHistory::where('object_model_id', $element->object_model_id)
                                ->orderBy('value', 'desc')->first();
            if($lastVal == null){
                $lastVal = 0;
            }else{
                $lastVal = $lastVal->value;
            }
            
            if(isset($event->done_work_time_value) && $event->done_work_time_value > $lastVal){           
                $newWorkTimeHistory = new WorkTimeHistory;
                $newWorkTimeHistory->object_model_id = $element->object_model_id;
                $newWorkTimeHistory->value = $event->done_work_time_value;
                $newWorkTimeHistory->save();
            }          
            $notification = Notification::where('events_id', $event->id)->first();
            $notification->forceDelete();
        }    
        //edycja powiadomień wg zmian w eventach
 
        if($event->events_type_id == 2){
            $changes = $event->getChanges();
            if(array_key_exists('expired_date', $changes)){
                $rules = NotificationRules::where('user_id', Auth::id())->first();   
                $expired_date = Carbon::createFromFormat('Y-m-d', $event->expired_date);
                $expired_date2 = Carbon::createFromFormat('Y-m-d', $event->expired_date);
                if($event->element->elements_category_id == 1){            
                    $first_date = $expired_date->subDays($rules->parts_notifications);
                    $next_date = $expired_date2->subDays(1);
                }elseif($event->element->elements_category_id == 2){
                    $first_date = $expired_date->subDays($rules->overviews_notifications);
                    $next_date = $expired_date2->subDays(1);
                }elseif($event->element->elements_category_id == 3){
                    $first_date = $expired_date->subDays($rules->insurances_notifications);
                    $next_date = $expired_date2->subDays(1);
                }

                $notification = Notification::where('events_id', $event->id)->first();
                $notification->send = $first_date->format('Y-m-d');
                $notification->next_send = $next_date->format('Y-m-d');
                $notification->save();
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
