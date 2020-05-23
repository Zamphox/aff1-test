<?php


namespace App\Jobs\Mail;

use App\Mail\Newsletter;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;


class SendNewsletterToUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @param $job
     * @param $data array
     * @return void
     */
    public function fire($job, $data)
    {
        $scheduledFor = $data['schedule']['fire_at'];
        $message = $data['schedule']['message'];
        $user = $data['user'];

        Mail::to($user['email'])
            ->later(Carbon::createFromDate($scheduledFor)->setTimezone($user['timezone']), new Newsletter($message));

        $job->delete();
    }
}
