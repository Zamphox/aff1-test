<?php

namespace App\Console\Commands;

use App\Http\Controllers\Mail\MailController;
use App\Services\MailService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class SendNewsletters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-newsletters {fire_at} {message}';
    //e.g "php artisan send-newsletters "2020-05-23 14:25:00" "Test newsletter""

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send newsletters to all users that have not declined to receive them';

    private $controller;

    /**
     * Create a new command instance.
     * @param MailController $mailController
     * @return void
     */

    function __construct(MailController $mailController)
    {
        parent::__construct();
        $this->controller = $mailController;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $this->info($this->controller->createNewsletterSchedule($this->arguments()));
    }
}
