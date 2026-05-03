<?php

namespace App\Notifications;

use App\Models\StudentApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewApplicationNotification extends Notification
{
    use Queueable;

    public function __construct(public StudentApplication $application) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'application_id' => $this->application->id,
            'applicant_name' => $this->application->full_name,
            'campus'         => $this->application->campus,
            'course'         => $this->application->course,
        ];
    }
}
