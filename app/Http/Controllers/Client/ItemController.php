<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Akaunting\Money\Currency;
use Akaunting\Money\Money;

class ItemController extends Controller
{
    //
    public function index()
    {
        if(Auth::guard('client')->check()){
            $client = Auth::guard('client')->user();

            $items_listing = Item::join('suppliers', 'items.item_supplier_id', '=', 'suppliers.id')
            ->join('categories', 'items.item_category_id', '=', 'categories.id')
            ->select('items.*', 'suppliers.company_name AS supplier_name', 'categories.category_name')
            ->orderBy('items.created_at', 'desc')
            ->get();
            // dd($items_listing);

            $category_listing = Category::where('client_id', '=', $client->id)->get();
            $suppliers_listing = Supplier::where('client_id', '=', $client->id)->get();
            // dd(count($category_listing), count($suppliers_listing));
            // dd($items_listing);

            $data = [
                'saas_name' => 'BillsPack',
                'title' => 'BILLS PACK HOTEL MANAGEMENT SYSTEM | '.$client['company_name'].' Items',
                'company_subscription_package' => $client['company_subscription_package'],
                'company_id' => $client['id'],
                'company_name' => $client['company_name'],
                'company_email' => $client['company_email'],
                'company_phone' => $client['company_phone'],
                'company_address' => $client['company_address'],
                'company_contact_person_name' => $client['company_contact_person_name'],
                'company_contact_person_phone' => $client['company_contact_person_phone'],

                'grn' => $this->generator(5),

                'company_categories' => $category_listing , //Category::where('client_id', '=', $client->id)->get(),
                'company_suppliers' => $suppliers_listing ,//Supplier::where('client_id', '=', $client->id)->get(),

                'items' => $items_listing //ViewItems::where('client_id', '=', $client->id)->get()
            ];
            //dd($data);

            return view('item.index', $data);
        }

        return redirect('login')->with('error', 'Access restricted to subscribed clients only');
    }

    public function add_item(Request $request)
    {
        // dd($request);

        //Make sure the client is logged in
        if(!Auth::guard('client')->check()){
            return redirect('login')->with('error', 'Item addition restricted');
        }

        //validate data
        $request->validate([
            'item_name' => 'required',
            'item_type' => 'required',
            'item_category_id' => 'required',
            'item_location' => 'required',
            'item_supplier_id' => 'required',
            'item_quantity' => 'required',
            'item_reorder_level' => 'required',
            'item_buying_price' => 'required',
            'item_selling_price' => 'required',
            'item_package_type' => 'required',
            'item_batch_no' => 'required',
            'item_expiry_date' => 'required'
        ]);

        //Store the image if it exists
        $item_image_url = '';
        if($request->hasFile('item_image')){
            Log::info("Item_image exists");
            // Log::emergency($message);
            // Log::alert($message);
            // Log::critical($message);
            // Log::error($message);
            // Log::warning($message);
            // Log::notice($message);
            // Log::info($message);
            // Log::debug($message);
            $request->validate([
                'item_image' => 'required|image|mimes:jpeg,png,jpg'
            ]);

            // Get  the file image
            $image = $request->file('item_image');

            // get a unique file name
            $filename = time() . '.' .$image->getClientOriginalExtension();

            // Upload the image
            // $item_image_url = $image->storeAs('image', $filename);
            $item_image_url = $image->storeAs('public/uploads/items', $filename);
        }
        // $item_image_url = $this->upload($request->item_image);

        //submit to db
        $data = $request->all();
        // dd($data);
        $created_item = $this->create_item($data, $item_image_url);
        // dd($created_item);

        if($created_item){
            //refresh the current page
            return redirect()->back()->with('success', 'Item addition success');
        }
        else{
            //refresh the current page
            return redirect()->back()->with('error', 'Item addition failed');
        }
    }

    public function create_item($data, $item_image_url)
    {
        $client = Auth::guard('client')->user();

        if(isset($data['item_catering_levy']) && $data['item_catering_levy'] === 'on'){
            $data['item_catering_levy'] = true;
        }
        else{
            $data['item_catering_levy'] = false;
        }

        if(isset($data['item_excise_duty']) && $data['item_excise_duty'] === 'on'){
            $data['item_excise_duty'] = true;
        }
        else{
            $data['item_excise_duty'] = false;
        }

        if(isset($data['item_vat']) && $data['item_vat'] === 'on'){
            $data['item_vat'] = true;
        }
        else{
            $data['item_vat'] = false;
        }

        //Generate QR code for this item and store the record in the db
        // $qr_code_path = public_path('qrcode/'.time().'.png');
        // $item_qr_code = QrCode::size(300)->generate($data, $qr_code_path);
        // $qr_code_path = public_path('qr_code/'.time().'.png');
        // $item_qr_code = QrCode::size(300)->generate($data, $qr_code_path);

        $item_expiry_date = $data['item_expiry_date'];
        // $date = new Carbon($item_expiry_date);
        return Item::create([
            'client_id' => $client['id'],
            // 'item_qr_code' => $qr_code_path,
            'item_name' => $data['item_name'],
            'item_description' => $data['item_description'] ?? 'N/A',
            'item_image' => $item_image_url ?? '',//$data[''],
            'item_type' => $data['item_type'],
            'item_category_id' => $data['item_category_id'],
            'item_location' => $data['item_location'],
            'item_supplier_id' => $data['item_supplier_id'],
            'item_quantity' => $data['item_quantity'],
            'item_reorder_level' => $data['item_reorder_level'],
            'item_buying_price' => $data['item_buying_price'],
            'item_selling_price' => $data['item_selling_price'],

            'item_catering_levy' => $data['item_catering_levy'],
            'item_excise_duty' => $data['item_excise_duty'],
            'item_vat' => $data['item_vat'],

            'item_package_type' => $data['item_package_type'],
            'item_batch_no' => $data['item_batch_no'],
            'item_expiry_date' => $item_expiry_date
        ]);
    }

    public function update_item(Request $request, $item_id)
    {
        //dd($request);
        //validate
        $request->validate([
            'item_name' => 'required'
        ]);


        if(isset($request->item_catering_levy) && $request->item_catering_levy === 'on'){
            $item_catering_levy = true;
        }
        else{
            $item_catering_levy = false;
        }

        if(isset($request->item_excise_duty) && $request->item_excise_duty === 'on'){
            $item_excise_duty = true;
        }
        else{
            $item_excise_duty = false;
        }

        if(isset($request->item_vat) && $request->item_vat === 'on'){
            $item_vat = true;
        }
        else{
            $item_vat = false;
        }
        //update
        $update_cat = Item::where('id', '=', $item_id)
                        ->update([
                            'item_name' => $request->item_name,
                            'item_description' => $request->item_description,
                            'item_name' => $request->item_name,
                            'item_description' => $request->item_description,
                            // 'item_image' => '',//$data[''],
                            'item_type' => $request->item_type,
                            'item_category_id' => $request->item_category_id,
                            'item_location' => $request->item_location,
                            'item_supplier_id' => $request->item_supplier_id,
                            'item_quantity' => $request->item_quantity,
                            'item_reorder_level' => $request->item_reorder_level,
                            'item_buying_price' => $request->item_buying_price,
                            'item_selling_price' => $request->item_selling_price,
                            'item_catering_levy' => $item_catering_levy,
                            'item_excise_duty' => $item_excise_duty,
                            'item_vat' => $item_vat,
                            'item_package_type' => $request->item_package_type,
                            'item_batch_no' => $request->item_batch_no,
                            'item_expiry_date' => $request->item_expiry_date
                        ]);

        //refresh page
        if(!$update_cat){
            return  redirect()->back()->with('error', 'Item update failed');// redirect('/login')->with('success', 'Your password has been changed!');
        }

        return  redirect()->back()->with('success', 'Item record updated');
    }

    public function delete_item($item_id)
    {
        // dd($item_id);
        $item = Item::find($item_id);
        if(!$item->delete()){
            return  redirect()->back()->with('error', 'Item deletion failed');// redirect('/login')->with('success', 'Your password has been changed!');
        }

        return  redirect()->back()->with('success', 'Item record deleted');
    }
}
