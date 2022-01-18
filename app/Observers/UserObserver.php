<?php
namespace App\Observers;
use App\Models\User;
use App\Models\EmailAdress;
use App\Models\NotificationRules;
class UserObserver
{
    public function updated(User $user)
    {
        $notificationRules = NotificationRules::where('user_id', $user->id)
                                                ->first();
        if($user->email_verified_at != null && $notificationRules == null){
            EmailAdress::create([
                'email' => $user->email,
                'user_id' => $user->id,
            ]);    
            NotificationRules::create([
                'user_id' => $user->id,
            ]);
        }
    }
}