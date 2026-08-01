<?php

namespace App\Notifications;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomerResetPasswordNotification extends Notification
{
    use Queueable;

    public string $token;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        $settings = Setting::pluck('value', 'key')->toArray();
        $siteName = $settings['site_name'] ?? config('app.name', 'Svaadvika');
        $siteLogo = isset($settings['site_logo']) && $settings['site_logo'] ? asset('storage/' . $settings['site_logo']) : null;

        return (new MailMessage)
            ->subject(__('Password Reset Request - :site_name', ['site_name' => $siteName]))
            ->view('emails.customer_password_reset', [
                'resetUrl' => $resetUrl,
                'customer' => $notifiable,
                'siteName' => $siteName,
                'siteLogo' => $siteLogo,
            ]);
    }
}

