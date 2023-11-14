<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    //
    public function index()
    {
        if(Auth::guard('client')->check()){
            //Get client details
            $client = Auth::guard('client')->user();
            //dd($client);

            $data = [
                'saas_name' => 'BillsPack',
                'title' => 'BILLS PACK HOTEL MANAGEMENT SYSTEM | '.$client['company_name'].' Settings',
                'company_subscription_package' => $client['company_subscription_package'],
                'company_name' => $client['company_name'],
                'company_email' => $client['company_email'],
                'company_phone' => $client['company_phone'],
                'company_address' => $client['company_address'],
                'company_contact_person_name' => $client['company_contact_person_name'],
                'company_contact_person_phone' => $client['company_contact_person_phone'],

                'grn' => $this->generator(5),
            ];
            // dd($data);

            return view('settings.general', $data);
        }

        return redirect('login')->with('error', 'Access restricted to subscribed clients only');
    }
}
