<?php

namespace App\Notifications;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeCustomerNotification extends Notification
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $siteName = $settings['site_name'] ?? config('app.name', 'Svaadvika');
        $siteLogo = isset($settings['site_logo']) && $settings['site_logo'] ? asset('storage/' . $settings['site_logo']) : null;

        return (new MailMessage)
            ->subject(__('Welcome to :site_name!', ['site_name' => $siteName]))
            ->view('emails.welcome_customer', [
                'customer' => $notifiable,
                'siteName' => $siteName,
                'siteLogo' => $siteLogo,
            ]);
    }
}

