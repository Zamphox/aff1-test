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

    /**
     * MailController constructor.
     * @param MailService $mailService
     */
    function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    /**
     * @param $data
     * @throws \Exception
     */
    public function validateData($data){
        $validation = Validator::make($data, [
            'message' => 'required|string',
            'fire_at' => 'required|date|after:now'
        ]);

        if($validation->fails()){throw new \Exception($validation->errors()->first());}
    }

    /**
     * @param Request $request
     * @return string
     * @throws \Exception
     */
    public function postCreateNewsletterSchedule(Request $request){
        return $this->createNewsletterSchedule($request->all());
    }

    public function createNewsletterSchedule($data){
        try {
            $this->validateData($data);
        } Catch (\Exception $ex){
            return $ex->getMessage();
        }
        $fireAt = Carbon::createFromDate($data['fire_at']);

        $this->mailService->createNewsletterSchedule($data['message'], $fireAt);

        return 'success';
    }
}
