<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Requisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequisitionController extends Controller
{
    //
    public function index()
    {
        if(Auth::guard('client')->check()){
            //Get client details
            $client = Auth::guard('client')->user();
            //dd($client);

            $requisition_lpo_number = 'LPO#'.$this->generator(5);
            $items_listing = Item::select('items.*')
            ->orderBy('items.created_at', 'desc')
            ->get();
            $requisitions_listing = Requisition::get();
            // dd($requisitions_listing);

            $data = [
                'saas_name' => 'BillsPack',
                'title' => 'BILLS PACK HOTEL MANAGEMENT SYSTEM | '.$client['company_name'].' Items',
                'company_subscription_package' => $client['company_subscription_package'],
                'company_name' => $client['company_name'],
                'company_email' => $client['company_email'],
                'company_phone' => $client['company_phone'],
                'company_address' => $client['company_address'],
                'company_contact_person_name' => $client['company_contact_person_name'],
                'company_contact_person_phone' => $client['company_contact_person_phone'],

                'grn' => $this->generator(5),

                'requisition_lpo_number' => $requisition_lpo_number,
                'items_listing' => $items_listing,
                'requisitions_listing' => $requisitions_listing
            ];
            //dd($data);

            return view('requisitions.index', $data);
        }

        return redirect('login')->with('error', 'Access restricted to subscribed clients only');
    }

    public function add_requisition(Request $request)
    {
        // dd($request);
        if(!Auth::guard('client')->check()){
            return redirect('login')->with('error', 'Requisition restricted to logged in clients only');
        }

        $request->validate([
            // "client_id" => "required",
            "requisition_title" => "required",
            "requisition_lpo_number" => "required",
            "requisition_item_name" => "required",
            "requisition_item_stock_level" => "required",
            "requisition_urgency" => "required",
            "requisition_department" => "required",
            "requisition_quantity" => "required",
            "requisition_date" => "required",
        ]);

        $data = $request->all();
        $created_requisition = $this->create_requisition($data);
        // dd($created_item);

        if($created_requisition){
            //refresh the current page
            return redirect()->back()->with('success', 'LPO Requisition addition success');
        }
        else{
            //refresh the current page
            return redirect()->back()->with('error', 'LPO Requisition addition failed');
        }
    }

    private function create_requisition($data)
    {
        $client = Auth::guard('client')->user();
        return Requisition::create([
            "client_id" => $client->id,
            "requisition_title" => $data["requisition_title"],
            "requisition_lpo_number" => $data["requisition_lpo_number"],
            "requisition_item_name" => $data["requisition_item_name"],
            "requisition_item_stock_level" => $data["requisition_item_stock_level"],
            "requisition_urgency" => $data["requisition_urgency"],
            "requisition_department" => $data["requisition_department"],
            "requisition_quantity" => $data["requisition_quantity"],
            "requisition_date" => $data["requisition_date"],
            "requisition_notes" => $data["requisition_notes"] ?? 'N/A'
        ]);
    }

    public function update_requisition(Request $request, $requisition_id)
    {
        //dd($request);
        //update
        $update_req = Requisition::where('id', '=', $requisition_id)
                        ->update([
                            "requisition_title" => $request->requisition_title,
                            "requisition_item_name" => $request->requisition_item_name,
                            "requisition_item_stock_level" => $request->requisition_item_stock_level,
                            "requisition_urgency" => $request->requisition_urgency,
                            "requisition_department" => $request->requisition_department,
                            "requisition_quantity" => $request->requisition_quantity,
                            "requisition_date" => $request->requisition_date,
                            "requisition_notes" => $request->requisition_notes,
                            "requisition_status" => $request->requisition_status
                        ]);
                        //dd($update_req);

        //refresh page
        if(!$update_req){
            return  redirect()->back()->with('error', 'Requisition update failed');// redirect('/login')->with('success', 'Your password has been changed!');
        }

        return  redirect()->back()->with('success', 'Requisition record updated');
    }

    public function delete_requisition($requisition_id)
    {
        // dd($requisition_lpo_number);

        // dd($item_id);
        $req = Requisition::find($requisition_id);
        if(!$req->delete()){
            return  redirect()->back()->with('error', 'Requisition record deletion failed');// redirect('/login')->with('success', 'Your password has been changed!');
        }

        return  redirect()->back()->with('success', 'Requisition record deleted');
    }
}
