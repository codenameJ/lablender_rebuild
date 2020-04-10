<?php

namespace App\Notifications;

use App\Request_list;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LendingRequest extends Notification
{
    use Queueable;
    public $request_list;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Request_list $request_list)
    {
        $this->request_list = $request_list;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['database', 'broadcast'];
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
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
            'NewLendingRequest' => $this->request_list,
            'student' => $notifiable
        ];
    }

    // /**
    //  * Get the broadcastable representation of the notification.
    //  *
    //  * @param  mixed  $notifiable
    //  * @return BroadcastMessage
    //  */
    // public function toBroadcast($notifiable)
    // {
    //     return new BroadcastMessage([
    //         'notification'=> $notifiable->notifications()->latest()->first()
    //     ]);
    // }
}
