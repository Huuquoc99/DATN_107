<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPasswordLink extends ResetPassword
{
    /**
     * Tùy chỉnh đường link gửi trong email.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $apiUrl = env('APP_URL') . '/password/reset?token=' . $this->token;

        return (new MailMessage)
            ->subject('Reset Password Notification')
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', $apiUrl)
            ->line('If you did not request a password reset, no further action is required.');
    }
}
