<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Reviews;

class NewReviewNotification extends Notification
{
    use Queueable;
    public $reviews;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reviews $reviews)
    {
        $this->reviews = $reviews;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            'reviews_id' => $this->reviews->id,
            'reviews_content' => $this->reviews->comment,
             'reviews_user_username' => $this->reviews->user->name,
             'reviews_user_userid' => $this->reviews->user->id,
             'reviews_created_at' => $this->reviews->created_at,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
