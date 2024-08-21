<?php

namespace App\Jobs;

use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNotificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $notification;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = [
            'name' => $this->notification->name,
            'email' => $this->notification->email,
            'message' => $this->notification->message,
        ];

        Mail::send([], [], function ($message) use ($data) {
            $message->to('nata.mark140895@gmail.com')
                ->subject('New message from ' . $data['name'])
                ->html('Имя: ' . $data['name'] . '<br>Email: ' . $data['email'] . '<br>Сообщение: ' . $data['message']);
        });

        // Обновляем статус уведомления как отправленного
        $this->notification->update(['is_sent' => true]);
    }
}
