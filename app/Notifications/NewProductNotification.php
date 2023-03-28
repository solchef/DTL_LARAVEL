<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewProductNotification extends Notification implements ShouldQueue
{
    use Queueable;
    private $product;
    /**
     * Create a new notification instance.
     */
    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
         return (new MailMessage)
                    ->line('You have successfully added a new product.')
                    ->action('New product url is', url('/'))
                    ->line('You can manage your products through the link below')
                    ->action('Manage Product', url('/frontend/products'))
                    ->from('noreply@dtlinterview.com', 'Sender');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
           //
        ];
    }
}
