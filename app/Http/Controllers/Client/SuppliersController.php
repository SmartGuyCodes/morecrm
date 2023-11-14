<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\ViewSuppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuppliersController extends Controller
{
    //
    public function index()
    {
        if(Auth::guard('client')->check()){
            $client = Auth::guard('client')->user();

            //Fetch a list of categories from the categories view_table
            $suppliers_list = Supplier::where('client_id', '=', $client->id)->get();
            // dd($suppliers_list);

            $data = [
                'saas_name' => 'BillsPack',
                'title' => 'BILLS PACK HOTEL MANAGEMENT SYSTEM | '.$client['company_name'].' Items',
                'company_id' => $client['id'],
                'company_subscription_package' => $client['company_subscription_package'],
                'company_name' => $client['company_name'],
                'company_email' => $client['company_email'],
                'company_phone' => $client['company_phone'],
                'company_address' => $client['company_address'],
                'company_contact_person_name' => $client['company_contact_person_name'],
                'company_contact_person_phone' => $client['company_contact_person_phone'],
                'suppliers' => $suppliers_list,

                'grn' => $this->generator(5),
            ];
            //dd($data);

            return view('suppliers.index', $data);
        }

        return redirect('login')->with('error', 'Access restricted to subscribed clients only');
    }

    public function add_supplier(Request $request)
    {
        // dd($request);
        //Make sure the client is logged in
        if(!Auth::guard('client')->check()){
            return redirect('login')->with('error', 'Supplier addition restricted');
        }

        //validate data
        $request->validate([
            'company_name' => 'required',
            'company_postal_address' => 'required',
            'company_physical_address' => 'required',
            'company_email' => 'required',
            'company_phone_no' => 'required',
            'company_contact_person' => 'required',
            'company_contact_person_email' => 'required',
            'company_contact_person_phone' => 'required'
        ]);

        //submit to db
        $data = $request->all();
        $created_supplier= $this->create_supplier($data);
        // dd($created_supplier);
        if($created_supplier){
            //refresh the current page
            return redirect()->back()->with('success', 'Supplier addition success');
        }
        else{
            //refresh the current page
            return redirect()->back()->with('error', 'Supplier addition failed');
        }
    }

    public function create_supplier($data)
    {
        $client = Auth::guard('client')->user();
        return Supplier::create([
            'client_id' => $client['id'],
            'company_name' => $data['company_name'],
            'company_postal_address' => $data['company_postal_address'],
            'company_physical_address' => $data['company_physical_address'],
            'company_email' => $data['company_email'],
            'company_phone_no' => $data['company_phone_no'],
            'company_contact_person' => $data['company_contact_person'],
            'company_contact_person_email' => $data['company_contact_person_email'],
            'company_contact_person_phone' => $data['company_contact_person_phone']
        ]);
    }

    public function update_supplier(Request $request, $supplier_id)
    {
        // dd($request);
        //validate
        $request->validate([
            'company_name' => 'required',
            'company_postal_address' => 'required',
            'company_physical_address' => 'required',
            'company_email' => 'required',
            'company_phone_no' => 'required',
            'company_contact_person' => 'required',
            'company_contact_person_email' => 'required',
            'company_contact_person_phone' => 'required'
        ]);

        //update
        $update_sup = Supplier::where('id', '=', $supplier_id)
                        ->update([
                            'company_name' => $request->company_name,
                            'company_postal_address' => $request->company_postal_address,
                            'company_physical_address' => $request->company_physical_address,
                            'company_email' => $request->company_email,
                            'company_phone_no' => $request->company_phone_no,
                            'company_contact_person' => $request->company_contact_person,
                            'company_contact_person_email' => $request->company_contact_person_email,
                            'company_contact_person_phone' => $request->company_contact_person_phone
                        ]);

        //refresh page
        if(!$update_sup){
            return  redirect()->back()->with('error', 'Supplier update failed');// redirect('/login')->with('success', 'Your password has been changed!');
        }

        return  redirect()->back()->with('success', 'Supplier record updated');
    }

    public function delete_supplier($supplier_id)
    {
        // dd($supplier_id);
        //dd($category_id);
        $supplier = Supplier::find($supplier_id);
        if(!$supplier->delete()){
            return  redirect()->back()->with('error', 'Supplier deletion failed');// redirect('/login')->with('success', 'Your password has been changed!');
        }

        return  redirect()->back()->with('success', 'Supplier record deleted');
    }
}
