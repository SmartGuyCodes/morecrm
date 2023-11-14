<?php

namespace App\Http\Controllers;

use App\Mail\OtpSent;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public $user;

    //Send Login OTP Email
    public function verificationEmail($userEmail, Client $user)
    {
        try
        {
            // Mail::to($userEmail)->send(new SendVerificationEmail($user));
            //Mail::to($userEmail)->send(new EmailOtp($user));
            Mail::to($userEmail)->send(new OtpSent($user));

            $message = "Success! Your OTP Code has been sent";
        }
        catch(\Exception $e)
        {
            $message = "Error: ".$e->getMessage();
        }

        return $message;
    }
}
