<?php


namespace App\Http\Controllers\Mail;


use App\Http\Controllers\Controller;
use App\Services\MailService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{
    private $mailService;

    function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    public function createNewsletterSchedule(Request $request){
        $validation = Validator::make($request->all(), [
            'message' => 'required|string',
            'fire_at' => 'required|date|after:now'
        ]);
        if($validation->fails()){return $validation->errors();}
        $fireAt = Carbon::createFromDate($request->fire_at);

        $this->mailService->createNewsletterSchedule($request->message, $fireAt);

        return 'success';
    }
}
