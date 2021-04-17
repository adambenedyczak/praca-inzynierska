<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\EmailAdress;
use App\Models\NotificationRules;
use Illuminate\Support\Facades\Auth;

class NotificationSettings extends Component
{
    public $isEnabledNotificationPart;
    public $isEnabledNotificationOverview;
    public $isEnabledNotificationInsurance;
    public $notificationPartTime;
    public $notificationOverviewTime;
    public $notificationInsuranceTime;
    public $notification_rules;
    public $notificationTimeList = [];

    public $emailAdress = [];

    public $addNewMail = false;
    public $newMail;
    public $ifDeleteEmail = -1;
    public $editEmail = -1;
    public $editedEmail;

    public function mount(){

        $this->notificationTimeList = [
            ['time' => '-1', 'description' => 'brak'],
            ['time' => '0', 'description' => 'w dniu zdarzenia'],
            ['time' => '1', 'description' => '1 dzień wcześniej'],
            ['time' => '3', 'description' => '3 dni wczesniej'],
            ['time' => '7', 'description' => '7 dni wcześniej'],
            ['time' => '14', 'description' => '14 dni wczesniej'],
            ['time' => '31', 'description' => '31 dni wcześniej'],
        ];

        $this->notification_rules = NotificationRules::where('user_id', Auth::id())->first();
        $this->notificationPartTime = $this->notification_rules->parts_notifications;
        if($this->notificationPartTime > -1){
            $this->isEnabledNotificationPart = true;
        }else{
            $this->isEnabledNotificationPart = false;
        }

        $this->notificationOverviewTime = $this->notification_rules->overviews_notifications;
        if($this->notificationOverviewTime > -1){
            $this->isEnabledNotificationOverview = true;
        }else{
            $this->isEnabledNotificationOverview = false;
        }

        $this->notificationInsuranceTime = $this->notification_rules->insurances_notifications;
        if($this->notificationInsuranceTime > -1){
            $this->isEnabledNotificationInsurance = true;
        }else{
            $this->isEnabledNotificationInsurance = false;
        }

        $this->emailAdress = EmailAdress::where('user_id', Auth::id())->orderBy('email')->get()->toArray();
        //dd($this->emailAdress, $this->emailAdress[0]['parts_notifications']);
    }

    public function saveNotificationRuleChanges(){
        if($this->isEnabledNotificationPart){
            $this->notification_rules->parts_notifications = $this->notificationPartTime;
        }else{
            $this->notification_rules->parts_notifications = -1;
        }

        if($this->isEnabledNotificationOverview){
            $this->notification_rules->overviews_notifications = $this->notificationOverviewTime;
        }else{
            $this->notification_rules->overviews_notifications = -1;
        }

        if($this->isEnabledNotificationInsurance){
            $this->notification_rules->insurances_notifications = $this->notificationInsuranceTime;
        }else{
            $this->notification_rules->insurances_notifications = -1;
        }
        $this->notification_rules->save();

        session()->flash('message', 'Zmiany zostały zapisane!');
    }

    public function cancelSaveNewEmail(){
        $this->newMail = '';
        $this->addNewMail = false;
    }

    public function saveNewEmail(){
        $this->validate([
            'newMail' => 'required|email|string|max:255',
        ],
        [
            'newMail.required' => 'Adres email nie może być pusty',
            'newMail.email' => 'Adres email jest niepoprawny',
        ]);
        $new_mail = new EmailAdress;
        $new_mail->user_id = $this->notification_rules->user_id;
        $new_mail->email = $this->newMail;
        $new_mail->save();

        $this->emailAdress = EmailAdress::where('user_id', Auth::id())->orderBy('email')->get()->toArray();
        session()->flash('message', 'Adres email został dodany!');
        $this->newMail = '';
        $this->addNewMail = false;
    }

    public function setDeleteEmail($id){
        $this->ifDeleteEmail = $id;
    }

    public function confirmDeleteEmail(){
        $deleted_email = EmailAdress::findOrFail($this->ifDeleteEmail);
        $deleted_email->delete();
        $this->ifDeleteEmail = -1;
        $this->emailAdress = EmailAdress::where('user_id', Auth::id())->orderBy('email')->get()->toArray();
        session()->flash('message', 'Adres email został usunięty!');
    }

    public function cancelDeleteEmail(){
        $this->ifDeleteEmail = -1;
    }

    public function setEditEmail($id){
        $this->editEmail = $id;
        $this->editedEmail = EmailAdress::where('id', $id)->first()->email;
    }

    public function saveEditEmail(){
        $this->validate([
            'editedEmail' => 'required|email|string|max:255',
        ],
        [
            'editedEmail.required' => 'Adres email nie może być pusty',
            'editedEmail.email' => 'Adres email jest niepoprawny',
        ]);
        $edited_email = EmailAdress::where('id', $this->editEmail)->first();
        $edited_email->email = $this->editedEmail;
        $edited_email->save();

        $this->editEmail = -1;
        $this->editedEmail = '';
        $this->emailAdress = EmailAdress::where('user_id', Auth::id())->orderBy('email')->get()->toArray();
        session()->flash('message', 'Adres email został zmieniony!');
    }

    public function cancelEditEmail(){
        $this->editEmail = -1;
        $this->editedEmail = '';
    }

    public function saveEmailsRuleChanges(){
        foreach($this->emailAdress as $email){
            $edited = EmailAdress::findOrFail($email['id']);
            $edited->enable = $email['enable'];
            $edited->parts_notifications = $email['parts_notifications'];
            $edited->overviews_notifications = $email['overviews_notifications'];
            $edited->insurances_notifications = $email['insurances_notifications'];
            $edited->save();
        }        
        $this->emailAdress = EmailAdress::where('user_id', Auth::id())->orderBy('email')->get()->toArray();
        session()->flash('message', 'Zmiany zostały zapisane!');
    }

    public function render()
    {
        //dd($this->notificationTimeList);
        
        return view('livewire.notification-settings')->extends('layouts.app');
    }
}
