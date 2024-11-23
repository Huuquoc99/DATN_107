<?php
namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPasswordNotification extends ResetPassword
{
    /**
     * Xác định các kênh mà notification sẽ được gửi qua.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // Chỉ gửi notification qua email
        return ['mail'];
    }

    /**
     * Tùy chỉnh thông báo qua mail.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = route('admin.password.reset', ['token' => $this->token]);

        return (new MailMessage)
            ->subject('Reset Password Notification')
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', $url) 
            ->line('If you did not request a password reset, no further action is required.');
    }
}