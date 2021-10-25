<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Mail\SendMail;
use App\Models\EmailAdress;
use App\Models\SentMessage;
use App\Models\Notification;
use App\Mail\NotificationMail;
use App\Models\MessageContent;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class NotificationsScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scheduler:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Przypomnienia o zdarzeniach';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //tutaj kod
        $users = User::whereNotNull('email_verified_at')->get();
        $today = Carbon::now()->format('Y-m-d');
        foreach($users as $user){
            $notificationsParts = Notification::with('user', 'event.element.object_model', 'event.element.element_category')
                                        ->where('user_id', '=', $user->id)
                                        ->where('elements_category_id', '=', '1')
                                        ->where('send', '<=', $today)
                                        ->get();
            $notificationsOverviews = Notification::with('user', 'event.element.object_model', 'event.element.element_category')
                                        ->where('user_id', '=', $user->id)
                                        ->where('elements_category_id', '=', '2')
                                        ->where('send', '<=', $today)
                                        ->get();
            $notificationsInsurances = Notification::with('user', 'event.element.object_model', 'event.element.element_category')
                                        ->where('user_id', '=', $user->id)
                                        ->where('elements_category_id', '=', '3')
                                        ->where('send', '<=', $today)
                                        ->get();
            $emailAdresses = EmailAdress::where('user_id', $user->id)
                                        ->where('enable', '1')
                                        ->get();
            
            foreach($emailAdresses as $emailAdress){
                $notifications = collect();
                if($emailAdress->parts_notifications == '1'){
                    $notifications = $notifications->merge($notificationsParts);  
                }
                if($emailAdress->overviews_notifications == '1'){
                    $notifications = $notifications->merge($notificationsOverviews);  
                }
                if($emailAdress->insurances_notifications == '1'){
                    $notifications = $notifications->merge($notificationsInsurances);  
                }
                if($notifications->count() > 0){
                    Mail::to($emailAdress->email)
                        ->send(new NotificationMail($notifications));   
                    $sentMessage = new SentMessage;
                    $sentMessage->user_id = $user->id;
                    $sentMessage->email = $emailAdress->email;
                    $sentMessage->when_sent = Carbon::now();
                    $sentMessage->save();

                    foreach($notifications as $notification){
                        $messageContent = new MessageContent;
                        $messageContent->object_id = $notification->event->element->object_model->id;
                        $messageContent->object_name = $notification->event->element->object_model->name;	
                        $messageContent->object_type_id	= $notification->event->element->object_model->object_type_id;
                        $messageContent->element_category_id = $notification->event->element->elements_category_id;
                        $messageContent->element_category_name = $notification->event->element->element_category->name;
                        $messageContent->element_type_name = $notification->event->element->elements_typeable->name;
                        $messageContent->element_expired_date = $notification->event->expired_date;
                        $messageContent->element_expired_time_value	= $notification->event->work_time_value;
                        $messageContent->sent_messages_id = $sentMessage->id;
                        $messageContent->save();
                    }
                }
            }         
            $notifications = collect();
            $notifications = $notifications->merge($notificationsParts);  
            $notifications = $notifications->merge($notificationsOverviews);  
            $notifications = $notifications->merge($notificationsInsurances);  
            if($notifications->count() > 0){
                foreach($notifications as $notification){
                    $notification->send = $notification->next_send;
                    $notification->next_send = NULL;
                    $notification->save();     
                }   
            }       
        }
    }
}
