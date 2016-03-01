<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use Mail;
use App\Http\Requests;
use App\Http\Requests\EmailRequest;
use App\Http\Controllers\Controller;

class EmailController extends ApiController
{

    public function send(EmailRequest $request)
    {
        Mail::send('emails.simple', ['content' => $request->message], function ($m) use ($request) {
            $m->to($request->to)->subject($request->subject);
        });

        return $this->success([
            'message' => trans('general.responses.email-sent')
            ]);
    }
}
