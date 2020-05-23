<?php


namespace App\Services;


use Carbon\Carbon;

interface MailService
{

    /**
     * @param String $message
     * @param Carbon $fire_at
     * @return mixed
     */
    public function createNewsletterSchedule(String $message, Carbon $fire_at);
}
