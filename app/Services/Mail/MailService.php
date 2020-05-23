<?php


namespace App\Services\Mail;

use App\Jobs\Mail\SendNewsletterToUser;
use App\Models\Mail\MailSchedule;
use App\Models\User;
use App\Services\MailService as MailServiceInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Queue;


class MailService implements MailServiceInterface
{
    const QUEUE_NAME = null;

    /**
     * @param String $message
     * @param Carbon $fire_at
     * @mixin Builder
     */
    public function createNewsletterSchedule(String $message, Carbon $fire_at){
        $targetUsers = User::where('agrees_to_newsletter', 1)
            ->whereNotNull('email_verified_at')
            ->get();

        $schedule = new MailSchedule([
            'message' => $message,
            'fire_at' => $fire_at
        ]);

        foreach($targetUsers as $user){
            $this->addNewsletterEmailToQueue($user, $schedule, $message);
        }
    }

    /**
     * @param User $user
     * @param MailSchedule $schedule
     * @param $message
     */
    private function addNewsletterEmailToQueue(User $user, MailSchedule $schedule, $message){
        Queue::push(SendNewsletterToUser::class, ['user' => $user, 'message' => $message, 'schedule' => $schedule], self::QUEUE_NAME);
    }
}
