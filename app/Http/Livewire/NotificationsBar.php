<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Event;
use Livewire\Component;
use App\Models\EmailAdress;
use App\Models\Notification;
use Illuminate\Support\Carbon;
use App\Models\WorkTimeHistory;
use App\Models\NotificationRules;
use Illuminate\Support\Facades\Auth;

class NotificationsBar extends Component
{

    public $rules;
    public $events;
    public $count_events;
    public $parts_date;
    public $overviews_date;
    public $insurances_date;
    public $current_worktime;

    protected $listeners = ['refreshEvents' => 'render'];

    public function render()
    {
        if (User::where('id', Auth::id())->first()->email_verified_at != null) {
            $this->rules = NotificationRules::where('user_id', Auth::id())->first();
            $this->parts_date = Carbon::now()->addDays($this->rules->parts_notifications)
                ->format('Y-m-d');
            $this->overviews_date = Carbon::now()->addDays($this->rules->overviews_notifications)
                ->format('Y-m-d');
            $this->insurances_date = Carbon::now()->addDays($this->rules->insurances_notifications)
                ->format('Y-m-d');
            $this->events = Event::with('element', 'element.object_model')
                ->where('events_type_id', 2)
                ->where(function ($q) {
                    $q->whereDate('expired_date', '<=', $this->parts_date)
                        ->whereHas('element', function ($query2) {
                            $query2->where('elements_category_id', 1)
                                ->whereHas('object_model', function ($query) {
                                    $query->where('user_id', Auth::id());
                                });
                        });
                })
                ->orWhere(function ($q) {
                    $q->whereDate('expired_date', '<=', $this->overviews_date)
                        ->whereHas('element', function ($query2) {
                            $query2->where('elements_category_id', 2)
                                ->whereHas('object_model', function ($query) {
                                    $query->where('user_id', Auth::id());
                                });
                        });
                })
                ->orWhere(function ($q) {
                    $q->whereDate('expired_date', '<=', $this->insurances_date)
                        ->whereHas('element', function ($query2) {
                            $query2->where('elements_category_id', 3)
                                ->whereHas('object_model', function ($query) {
                                    $query->where('user_id', Auth::id());
                                });
                        });
                })
                ->get();
            $this->count_events = count($this->events);
        }
        return view('livewire.notifications-bar');
    }
}
