<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Event;
use App\Models\WorkTimeHistory;
use App\Observers\UserObserver;
use App\Observers\EventObserver;
use App\Models\NotificationRules;
use Illuminate\Auth\Events\Registered;
use App\Observers\NotificationRulesObserver;
use App\Observers\WorkTimeHistoriesObserver;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::observe(EventObserver::class);
        User::observe(UserObserver::class);
        NotificationRules::observe(NotificationRulesObserver::class);
        WorkTimeHistory::observe(WorkTimeHistoriesObserver::class);
    }
}
