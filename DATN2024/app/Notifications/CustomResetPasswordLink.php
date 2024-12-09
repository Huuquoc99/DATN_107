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
            ->line('Bạn nhận được email này vì chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.')
            ->action('Reset Password', $apiUrl)
            ->line('Nếu bạn không yêu cầu đặt lại mật khẩu, không cần thực hiện thêm hành động nào nữa.');
    }
}
