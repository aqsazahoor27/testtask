<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends VerifyEmailNotification
{
 
    protected function verificationUrl($notifiable)
    {
        return  env('APP_URL') . '/verifyEmail?' . http_build_query(
                [
                    'verifyLink' => URL::temporarySignedRoute(
                        'verification.verify',
                        Carbon::now()->addMinutes(60),
                        [
                            'id' => $notifiable->getKey(),
                            'hash' => sha1($notifiable->getEmailForVerification())
                        ]
                    )
                ]
        );

    }

}