<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use App\Mail\StaffEmail;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use AfricasTalking\SDK\AfricasTalking;

class StaffController extends Controller
{
    //
    public function index()
    {
        if(Auth::guard('client')->check()){
            $client = Auth::guard('client')->user();

            //Fetch a list of categories from the categories view_table
            $staff_list = Staff::all();
            // dd($staff_list);

            $data = [
                'saas_name' => 'MoreCRM',
                'title' => 'MoreCRM HOTEL MANAGEMENT SYSTEM | '.$client['company_name'].' Items',
                'company_id' => $client['id'],
                'company_subscription_package' => $client['company_subscription_package'],
                'company_name' => $client['company_name'],
                'company_email' => $client['company_email'],
                'company_phone' => $client['company_phone'],
                'company_address' => $client['company_address'],
                'company_contact_person_name' => $client['company_contact_person_name'],
                'company_contact_person_phone' => $client['company_contact_person_phone'],
                'staff' => $staff_list,

                'grn' => $this->generator(5),
            ];
            //dd($data);

            return view('staff.index', $data);
        }

        return redirect('login')->with('error', 'Access restricted to subscribed clients only');
    }

    public function add_staff(Request $request)
    {
        // dd($request);
        //Make sure the client is logged in
        if(!Auth::guard('client')->check()){
            return redirect('login')->with('error', 'Staff addition restricted');
        }

        //validate data
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        //submit to db
        $data = $request->all();
        $created_staff= $this->create_staff($data);
        // dd($created_supplier);
        if($created_staff){
            //refresh the current page
            return redirect()->back()->with('success', 'Staff addition success');
        }
        else{
            //refresh the current page
            return redirect()->back()->with('error', 'Staff addition failed');
        }
    }

    public function create_staff($data)
    {
        $client = Auth::guard('client')->user();
        return Staff::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone']
        ]);
    }

    public function update_staff(Request $request, $id)
    {
        // dd($request);
        //validate
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        //update
        $update_sup = Staff::where('id', '=', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone
            ]);

        //refresh page
        if(!$update_sup){
            return  redirect()->back()->with('error', 'Staff update failed');// redirect('/login')->with('success', 'Your password has been changed!');
        }

        return  redirect()->back()->with('success', 'Staff record updated');
    }

    public function sms_staff($phone)
    {
        // dd($id);
        //dd($category_id);
        $msg = "Hello there ";
        // $sms_sender = $this->send_sms($phone, $msg);
        // $sms_sender = $this->send_sms_demo($phone, $msg);
        $sms_sender = $this->more_sms_sender($phone, $msg);
        // dd($sms_sender);
        if($sms_sender != 'success'){
            return  redirect()->back()->with('error', 'Staff sms sender failed');// redirect('/login')->with('success', 'Your password has been changed!');
        }

        return  redirect()->back()->with('success', 'Staff sms sent');
    }
    public function email_staff($email)
    {
        if(Mail::to($email)->send(new StaffEmail()))
        {
            return  redirect()->back()->with('error', 'Staff emailed');
            //return true;//'Email sent successfully!';
        }
        else
        {
            return  redirect()->back()->with('error', 'Staff email sender failed');
        }

    }

    public function delete_staff($id)
    {
        // dd($id);
        //dd($category_id);
        $staff = Staff::find($id);
        if(!$staff->delete()){
            return  redirect()->back()->with('error', 'Staff deletion failed');// redirect('/login')->with('success', 'Your password has been changed!');
        }

        return  redirect()->back()->with('success', 'Staff record deleted');
    }
    private function more_sms_sender($phone, $msg)
    {
        $username = 'Cityplus';
        $api_key = 'a677a441288794b2d02ca9b9ce03fc996a226b653d3f80b8e3857e29dd3fc171';
        $at = new AfricasTalking($username, $api_key);

        $sms = $at->sms();

        $result = $sms->send([
            // 'to' => $phone,
            // 'message' => $msg,
            'to' => $phone,
            'from' => 'CITYPLUS',
            'message' => $msg,
            'username' => 'Cityplus'
        ]);

        // dd($result);
        return $result['status'];
    }
    private function send_sms($phone, $message)
    {
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded' ,
            'apiKey: 8eca98fcc9f05ce0d8eb9cd6cad4a5c895c6600f066b1ed12e51f281a64cad95' 
        );
        $curl_post_data =[
            'to' => $phone,
            'from' => 'AFRICASTALKING',
            'message' => $message,
            'username' => 'AFRICASTALKING'
        ];
        $data_string = json_encode($curl_post_data);
        $aturl = 'https://api.africastalking.com/version1/messaging';

        try
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $aturl);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            //  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            //  curl_setopt($ch, CURLOPT_HEADER, FALSE); // excludes the header in the output
            curl_setopt($ch, CURLOPT_POST, 1);
            //  curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 
                http_build_query(array(
                    'to' => $phone,
                    'from' => 'MORE-INFO',
                    'message' => $message,
                    'username' => 'MORE_INFO'
                )
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec($ch);
            curl_close ($ch);
            // echo $server_output;die;

            //Save this response in our local SMS db table
            return true;
        }
        catch(\Exception $ex)
        {
            echo $ex->getMessage();
        }
    }
    private function send_sms_demo($phone, $message)
    {
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded' ,
            'apiKey: a677a441288794b2d02ca9b9ce03fc996a226b653d3f80b8e3857e29dd3fc171' 
        );
        $curl_post_data =[
            'to' => $phone,
            'from' => 'CITYPLUS',
            'message' => $message,
            'username' => 'Cityplus'
        ];
        $data_string = json_encode($curl_post_data);
        $aturl = 'https://api.africastalking.com/version1/messaging';
    
        try
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $aturl);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            //  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            //  curl_setopt($ch, CURLOPT_HEADER, FALSE); // excludes the header in the output
            curl_setopt($ch, CURLOPT_POST, 1);
            //  curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 
                http_build_query(array(
                    'to' => $phone,
                    'from' => 'CITYPLUS',
                    'message' => $message,
                    'username' => 'Cityplus'
                )
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec($ch);
            curl_close ($ch);
            // echo $server_output;

            //Save this response in our local SMS db table
            return true;
        }
        catch(\Exception $ex)
        {
            echo $ex->getMessage();
        }
    }
}
