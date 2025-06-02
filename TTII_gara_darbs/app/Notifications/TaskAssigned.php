<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Task;

class TaskAssigned extends Notification
{
    use Queueable;

    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Jauns uzdevums piešķirts')
                    ->greeting('Sveiki!')
                    ->line('Jums ir piešķirts jauns uzdevums: ' . $this->task->title)
                    ->action('Skatīt uzdevumu', url(route('tasks.show', $this->task->id)))
                    ->line('Paldies, ka izmantojat mūsu sistēmu!');
    }
}
