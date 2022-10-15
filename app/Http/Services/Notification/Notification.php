<?php

namespace App\Http\Services\Notification;

use Illuminate\Mail\Mailable;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


class Notification{

    public function sendEmail(User $user,Mailable $mailable ){
          return  Mail::to($user->email)->send($mailable);
    }


}