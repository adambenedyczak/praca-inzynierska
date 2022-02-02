<?php

namespace App\Observers;

use App\Models\Event;
use App\Models\Notification;
use Illuminate\Support\Carbon;
use App\Models\NotificationRules;
use Illuminate\Support\Facades\Auth;

class NotificationRulesObserver
{
    public function updated(NotificationRules $event)
    {
        $changes = $event->getChanges();
        if (array_key_exists('parts_notifications', $changes)) {
            $newPartNotificationTime = $changes['parts_notifications'];
        } else {
            $newPartNotificationTime = null;
        }
        if (array_key_exists('overviews_notifications', $changes)) {
            $newOverviewNotificationTime = $changes['overviews_notifications'];
        } else {
            $newOverviewNotificationTime = null;
        }
        if (array_key_exists('insurances_notifications', $changes)) {
            $newInsuranceNotificationTime = $changes['insurances_notifications'];
        } else {
            $newInsuranceNotificationTime = null;
        }

        $notifications = Notification::where('user_id', Auth::id())
            ->get()
            ->groupBy('elements_category_id');
        if ($newPartNotificationTime != null && $newPartNotificationTime >= 0 && isset($notifications[1])) {
            foreach ($notifications[1] as $notification) {
                $expired_time = Event::where('id', $notification->events_id)->first()->expired_date;
                $expired_date = Carbon::createFromFormat('Y-m-d', $expired_time);
                $expired_date2 = Carbon::createFromFormat('Y-m-d', $expired_time);

                $first_date = $expired_date->subDays($newPartNotificationTime);
                $next_date = $expired_date2->subDays(1);

                $notification->send = $first_date->format('Y-m-d');
                $notification->next_send = $next_date->format('Y-m-d');
                $notification->save();
            }
        } elseif ($newPartNotificationTime == -1 && isset($notifications[1])) {
            foreach ($notifications[1] as $notification) {
                $notification->send = null;
                $notification->next_send = null;
                $notification->save();
            }
        }
        if ($newOverviewNotificationTime != null && $newOverviewNotificationTime >= 0 && isset($notifications[2])) {
            foreach ($notifications[2] as $notification) {
                $expired_time = Event::where('id', $notification->events_id)->first()->expired_date;
                $expired_date = Carbon::createFromFormat('Y-m-d', $expired_time);
                $expired_date2 = Carbon::createFromFormat('Y-m-d', $expired_time);

                $first_date = $expired_date->subDays($newOverviewNotificationTime);
                $next_date = $expired_date2->subDays(1);

                $notification->send = $first_date->format('Y-m-d');
                $notification->next_send = $next_date->format('Y-m-d');
                $notification->save();
            }
        } elseif ($newOverviewNotificationTime == -1 && isset($notifications[2])) {
            foreach ($notifications[2] as $notification) {
                $notification->send = null;
                $notification->next_send = null;
                $notification->save();
            }
        }
        if ($newInsuranceNotificationTime != null && $newInsuranceNotificationTime >= 0 && isset($notifications[3])) {
            foreach ($notifications[3] as $notification) {
                $expired_time = Event::where('id', $notification->events_id)->first()->expired_date;
                $expired_date = Carbon::createFromFormat('Y-m-d', $expired_time);
                $expired_date2 = Carbon::createFromFormat('Y-m-d', $expired_time);

                $first_date = $expired_date->subDays($newInsuranceNotificationTime);
                $next_date = $expired_date2->subDays(1);

                $notification->send = $first_date->format('Y-m-d');
                $notification->next_send = $next_date->format('Y-m-d');
                $notification->save();
            }
        } elseif ($newInsuranceNotificationTime == -1 && isset($notifications[3])) {
            foreach ($notifications[3] as $notification) {
                $notification->send = null;
                $notification->next_send = null;
                $notification->save();
            }
        }
    }
}
