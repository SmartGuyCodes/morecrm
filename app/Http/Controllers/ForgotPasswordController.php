<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function show_forget_password_form()
    {
        if(Auth::guard('client')->check()){
            return redirect('client-dashboard');
        }

        $data = [
            'saas_name' => 'MoreCRM',
            'title' => 'MoreCRM - Login page',
            'description' => 'Get started today'
        ];

        return view('landing.forgot', $data);
    }

    public function submit_forget_password_form(Request $request)
    {
        $request->validate([
            'company_email' => 'required|email|exists:clients'
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->company_email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('emails.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->company_email);
            $message->subject('Reset Password');
        });

        return back()->with('success', 'We have e-mailed your password reset link!');
    }

    public function show_reset_password_form($token)
    {
        if(Auth::guard('client')->check()){
            return redirect('client-dashboard');
        }

        $data = [
            'saas_name' => 'MoreCRM',
            'title' => 'MoreCRM - Login page',
            'description' => 'Get started today',
            'token' => $token
        ];

        return view('landing.forgotPasswordLink', $data);
    }

    public function submit_reset_password_form(Request $request)
    {
        $request->validate([
            'company_email' => 'required|email|exists:clients',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $update_pwd = DB::table('password_resets')
                            ->where([
                                'email' => $request->company_email,
                                'token' => $request->token
                            ])
                            ->first();
        if(!$update_pwd){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        Client::where('company_email', $request->company_email)
                        ->update([
                            'password' => Hash::make($request->password)
                        ]);
        DB::table('password_resets')->where(['email' => $request->company_email])->delete();

        return redirect('/login')->with('success', 'Your password has been changed!');
    }
}
