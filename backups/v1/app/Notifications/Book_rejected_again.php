<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Book_rejected_again extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($book)
    {
        $this->book = $book;
        //$this->vendor = $vendor;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toDatabase($notifiable)
    {

        return [
            'title' => 'book rejected again',
            'Message' => 'Your Book has been rejected again by the admin',
            'Book' => $book
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
       // return (new MailMessage)->markdown('emails.vendor_reg');
        return (new MailMessage)->subject('BOOK REJECTED AGAIN')->markdown('emails.book_rejected_again',['book'=>$this->book]);
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
