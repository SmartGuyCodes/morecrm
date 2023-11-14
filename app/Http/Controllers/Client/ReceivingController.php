<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Supplier;
use App\Models\Item;
use App\Models\ReceivingItem;
use App\Models\Receiving;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use TCPDF as OgegoPDF;

class ReceivingController extends Controller
{
    //
    public function index($grn)
    {
        if(Auth::guard('client')->check()){
            //Get client details
            $client = Auth::guard('client')->user();
            // dd($grn);

            $items_listing = Item::where('client_id', '=', $client->id)->get();

            $received_items = ReceivingItem::where('client_id', '=', $client->id)
            ->where('grn_no', '=', $grn)
            ->get();

            $supplier_listing = Supplier::where('client_id', '=', $client->id)->get();
            // dd($supplier_listing);

            //$receiving_listing = Receiving::where('client_id', '=', $client->id)->get();
            $receiving_listing = Receiving::join('suppliers', 'receivings.receiving_supplier_id', '=', 'suppliers.id')
            // ->join('categories', 'items.item_category_id', '=', 'categories.id')
            ->select('receivings.*', 'suppliers.company_name AS supplier_name')//, 'categories.category_name')
            ->orderBy('receivings.created_at', 'desc')
            ->get();
            // dd($receiving_listing);

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
                'grn_form' => $grn,
                'items' => $items_listing,
                'received_items' => $received_items,
                'supplier_listing' => $supplier_listing,
                'receiving_listing' => $receiving_listing
            ];
            //dd($data);

            return view('receive.index', $data);
        }

        return redirect('login')->with('error', 'Access restricted to subscribed clients only');
    }

    public function receiving_listings()
    {
        if(Auth::guard('client')->check()){
            //Get client details
            $client = Auth::guard('client')->user();
            // dd($grn);

            // $items_listing = Item::where('client_id', '=', $client->id)->get();

            // $received_items = ReceivingItem::where('client_id', '=', $client->id)
            // ->where('grn_no', '=', $grn)
            // ->get();

            // $supplier_listing = Supplier::where('client_id', '=', $client->id)->get();
            // dd($supplier_listing);

            //$receiving_listing = Receiving::where('client_id', '=', $client->id)->get();
            $receiving_listing = Receiving::join('suppliers', 'receivings.receiving_supplier_id', '=', 'suppliers.id')
            // ->join('categories', 'items.item_category_id', '=', 'categories.id')
            ->select('receivings.*', 'suppliers.company_name AS supplier_name')//, 'categories.category_name')
            ->orderBy('receivings.created_at', 'desc')
            ->get();
            //dd($receiving_listing);

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
                // 'items' => $items_listing,
                // 'received_items' => $received_items,
                // 'supplier_listing' => $supplier_listing,
                'receiving_listing' => $receiving_listing
            ];
            //dd($data);

            return view('receive.listings', $data);
        }

        return redirect('login')->with('error', 'Access restricted to subscribed clients only');
    }

    public function receiving_profile($uuid)
    {
        // dd($uuid);
        if(Auth::guard('client')->check()){
            //Get client details
            $client = Auth::guard('client')->user();
            // dd($grn);

            $items_listing = Item::where('client_id', '=', $client->id)->get();

            $received_items = ReceivingItem::where('client_id', '=', $client->id)
            ->where('grn_no', '=', $uuid)
            ->get();

            $supplier_listing = Supplier::where('client_id', '=', $client->id)->get();
            // dd($supplier_listing);

            //$receiving_listing = Receiving::where('client_id', '=', $client->id)->get();
            // $receiving_listing = Receiving::join('suppliers', 'receivings.receiving_supplier_id', '=', 'suppliers.id')
            // ->select('receivings.*', 'suppliers.company_name AS supplier_name')//, 'categories.category_name')
            // ->orderBy('receivings.created_at', 'desc')
            // ->get();
            // dd($receiving_listing);

            $receiving = Receiving::where('client_id', '=', $client->id)
            ->where('uuid', '=', $uuid)->first();
            // dd($receiving);

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
                'uuid' => $uuid,
                'items' => $items_listing,
                'received_items' => $received_items,
                'supplier_listing' => $supplier_listing,
                // 'receiving_listing' => $receiving_listing
                'receiving' => $receiving
            ];
            // dd($data);

            return view('receive.profile', $data);
        }

        return redirect('login')->with('error', 'Access restricted to subscribed clients only');
    }

    public function add_receiving_item(Request $request)
    {
        //dd($request);
        //Get the product from the db by identifier
        //Retrieve the product price
        //store then refresh the page
        //Get client details
        $client = Auth::guard('client')->user();

        $item_id = $request->item_id;
        $item = Item::where('id', $item_id)->first();
        $item_name = $item->item_name;
        $item_price = $item->item_selling_price;

        $item_supply_qty = $request->item_qty;
        // dd($item_supply_qty);

        // Check if the product has already been added to the list if not create if yes, update the qty
        $received_item = ReceivingItem::where('item_id', '=', $item_id)
        ->where('grn_no', '=', $request->grn_no)
        ->get();
        // dd($received_item);

        $counter = count($received_item);
        //dd($counter);
        // dd($counter, $request, $received_item);
        if($counter ==  0) {
            $rec = ReceivingItem::create([
                'uuid' => $request->receiving_grn,
                'client_id' => $client['id'],
                'grn_no' => $request->receiving_grn,
                'item_id' => $request->item_id,
                'item_name' => $item_name,
                'item_qty' => $request->item_qty,
                'item_price' => $item_price
            ]);
        }
        else{
            $existing_qty = $received_item[0]->item_qty;
            // dd($existing_qty);
            $rec = ReceivingItem::where('item_id', '=', $item_id)
            ->update([
                'item_qty' => $item_supply_qty + $existing_qty
            ]);
            // dd($rec);
        }

        if($rec){
            //refresh the current page
            return redirect()->back()->with('success', 'Supply item addition success');
        }
        else{
            //refresh the current page
            return redirect()->back()->with('error', 'Supply item addition failed');
        }
    }

    public function delete_receiving_item($id)
    {
        //dd($id);
        $item = ReceivingItem::find($id);
        if(!$item->delete()){
            return  redirect()->back()->with('error', 'Item deletion failed');// redirect('/login')->with('success', 'Your password has been changed!');
        }

        return  redirect()->back()->with('success', 'Item record deleted');
    }

    public function register_receiving(Request $request)
    {
        try {
            // Cache::lock()->block(10, function() use ($request){
                $client = Auth::guard('client')->user();

                // get inputs and create a transaction object and receiving object and then perform a transaction
                //get balance due
                $invoice_status = '';
                $balance_due =  $request->total_product_amount - $request->total_paid_amount_;
                if($balance_due >= 1){
                    $invoice_status = 'unpaid';
                }
                else{
                    $invoice_status = 'paid';
                }
                //dd($balance_due, $invoice_status);
                $invoice_id = $this->generator(7);
                $rec_mode = $request->receiving_mode;
                // $txn_type = '';
                // if ($rec_mode == 'receive') {
                //     $txn_type = '';
                // }
                // else if($rec_mode == 'return') {

                // }

                //store then refresh
                $receiving_data = [
                    'client_id' => $client['id'],
                    'uuid' => $request->receiving_grn,
                    'receiving_grn' => 'GRN#'.$request->receiving_grn,
                    'receiving_supplier_id' => $request->receiving_supplier_id,
                    'receiving_voucher_no' => 'R#'.$request->receiving_grn,
                    'received_by' => $client['company_contact_person_name'],
                    'receiving_department' => $request->receiving_department,
                    'receiving_mode' => $request->receiving_mode,
                    'receiving_notes' => $request->receiving_notes ?? 'N/A',
                    'receiving_date_time' => $request->receiving_date_time,
                    'receiving_products_qty' => $request->receiving_products_qty,
                    'total_paid_amount' => $request->total_paid_amount_ ?? 0,
                    'balance_due' => $balance_due ?? 0,
                    'txn_ref' => $request->txn_ref_ ?? 'N/A',
                    'payment_method' => $request->payment_method,
                ];
                // dd($request, $data);

                $transaction_data = [
                    'txn_ref' => $request->txn_ref_ ?? 'AUTO_'.$invoice_id,
                    'txn_type' => 'expense',
                    'total_amount_paid' => $request->total_paid_amount_ ?? 0,
                    'payment_method' => $request->payment_method,
                    'payment_type' => $request->payment_method,
                    'payment_status' => $invoice_status,
                    'invoice_no' => $invoice_id,
                    'receipt_no' => $request->receiving_grn
                ];

                $invoice_data = [
                    'invoice_customer_id' => $client->id, //=> $invoice_id,
                    'invoice_number' => $invoice_id,
                    'invoice_txn_reference' => $request->txn_ref_ ?? 'AUTO_'.$invoice_id,
                    'invoice_date' => $request->receiving_date_time,
                    'invoice_payment_due_date' => $request->receiving_date_time,
                    'invoice_payment_date' => $request->receiving_date_time,
                    'invoice_amount' => $request->total_paid_amount_ ?? 0,
                    'invoice_status' => $invoice_status
                ];

                // $receiver = Receiving::create($receiving_data);
                // $transactor = Transactions::create($transaction_data);
                // $invoicer = Invoice::create($invoice_data);
                // dd($receiver, $transactor, $invoicer);

                $process = $this->process_receiving_registration($receiving_data, $transaction_data, $invoice_data);
                // dd($process);

                // $pdf_data = [
                //     'receiving_data' => $receiving_data,
                //     'transaction_data' => $transaction_data,
                //     'invoice_data' => $invoice_data
                // ];


                // $generate_pdf = $this->generate_pdf($pdf_data);
                // $received = Receiving::create($receiving_data);
                // $transacted = Transactions::create($transact_dt);
                if($process){
                    $data = [
                        'receiving_data' => $receiving_data,
                        'transaction_data' => $transaction_data,
                        'invoice_data' => $invoice_data
                    ];

                    //refresh the current page
                    return redirect('/receiving-profile/'.$process)->with('success', 'Receiving recorded successfully');
                    // return view('receive.index', $data);
                    // return view('receive.profile', $data);
                }
                else{
                    //refresh the current page
                    return redirect()->back()->with('error', 'Recording receiving failed');
                }
            // });
        }
        catch (Exception $e) {
            //throw $th;
            return redirect()->back()->with('error', 'Error: '.$e->getMessage());
        }
    }

    private function process_receiving_registration($receiving_data, $transaction_data, $invoice_data)
    {
        // dd($receiving_data, $transaction_data, $invoice_data);
        $resp = FALSE;
        // initiate a transaction
        DB::beginTransaction();
        try{
            $rec = Receiving::create($receiving_data);
            Transactions::create($transaction_data);
            Invoice::create($invoice_data);

            DB::commit();

            $resp = $rec->uuid;
        }
        catch(\Exception $e){
            DB::rollBack();

            $resp = TRUE;
        }

        return $resp;
    }

    public function display_grn_pdf($grn)
    {
        //dd($grn);

        $title = "Goods received Note";
        // $listing_data =Item::join('suppliers', 'items.item_supplier_id', '=', 'suppliers.id')
        // ->join('categories', 'items.item_category_id', '=', 'categories.id')
        // ->select('items.*', 'suppliers.company_name AS supplier_name', 'categories.category_name')
        // ->orderBy('items.created_at', 'desc')
        // ->get();
        $grn_data = Receiving::where('uuid', '=', $grn)->get();
        $grn_items =ReceivingItem::where('grn_no', '=', $grn)->get();
        $grn_txn_data = Transactions::where('receipt_no', '=', $grn)->get();
        $pdf_data =  [
            'grn_data' => $grn_data,
            'grn_items' => $grn_items,
            'grn_txn_data' => $grn_txn_data
        ]; // Get the grn details for the pdf
        $grn_view = 'receive.grnPDF';

        return $this->pdf_display($title, $pdf_data, $grn_view, NULL);
    }

    // PRIVATE HELPERS
    private function pdf_display($title= NULL, $listing_data = [], $listing_view = '', $compact_url = NULL)
    {
        $client = Auth::guard('client')->user();
        $pdf = new OgegoPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $data = [
            "company_id" => $client['id'],
            'company_name' => $client['company_name'],
            'company_email' => $client['company_email'],
            'company_phone' => $client['company_phone'],
            'company_address' => $client['company_address'],
            'company_website' => 'www.example.com',
            'company_contact_person_name' => $client['company_contact_person_name'],
            'company_contact_person_phone' => $client['company_contact_person_phone'],
            "title" => $title,
            "listing_data" => $listing_data,
            "listing_view" => $listing_view,
            'grn' => $this->generator(5),
        ];

        //Custom Header and footer
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);
        $pdf->SetMargins(25.0, 40, 25.0); // left = 2.5 cm, top = 4 cm, right = 2.5cm
        $pdf->SetFooterMargin(1.5);  // the bottom margin has to be set with SetFooterMargin
        //$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); // we use a default constant to avoid quality lost, PDF_IMAGE_SCALE_RATIO = 1
        $pdf->setImageScale(0.5);

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        $pdf->AddPage();

        // set text shadow effect
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
        $pdf->Image(public_path('logo.png'), 90, 20, 30, '', 'PNG', '', 'T', false, 300, 'C', false, false, 0, false, false, false);
        $pdf->Write(30, '', '', 0, 'C', true, 21, false, false, 0);
        $pdf->Write(9, $client['company_name'], '', 0, 'C', true, 9, false, false, 0);
        $pdf->Write(8, $client['company_address'], '', 0, 'C', true, 9, false, false, 0);
        $pdf->Write(10, 'Phone: '.$client['company_phone']. ' | Email: '.$client['company_email']. ' | Website: '.$data['company_website'], '', 0, 'C', true, 9, false, false, 0);
        $html = '<h2 style="margin-left:50%;"><strong>'.$data['title'].' </strong></h2><hr>';
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        $pdf->SetFont('helvetica', '', 6);

        // $pdf->writeHTML(view('reports.pdfHeader', $data)->render(), true, false, true, false, '');
        $pdf->writeHTML(view($listing_view, $data)->render(), true, false, true, false, '');
        $pdf->writeHTML(view('reports.pdfFooter', $data)->render(), true, false, true, false, '');
        $pdf->Output($title.'_'.Carbon::now().'report.pdf', 'I');
    }

    public function update_receiving(Request $request, $uuid)
    {
        // dd($uuid, $request);
        $client = Auth::guard('client')->user();

       //store then refresh
        $receiving_data = [
            //'client_id' => $client['id'],
            //'uuid' => $request->receiving_grn,
            //'receiving_grn' => 'GRN#'.$request->receiving_grn,
            //'receiving_supplier_id' => $request->receiving_supplier_id,
            //'receiving_voucher_no' => 'R#'.$request->receiving_grn,
            'received_by' => 'N/A',
            'receiving_department' => $request->receiving_department,
            'receiving_mode' => $request->receiving_mode,
            'receiving_notes' => $request->receiving_notes ?? 'N/A',
            'receiving_date_time' => $request->receiving_date_time,
            'receiving_products_qty' => $request->receiving_products_qty,
            'total_paid_amount' => $request->total_paid_amount_ ?? 0,
            'balance_due' => $request->balance_due ?? 0,
            'txn_ref' => $request->txn_ref_ ?? 'N/A',
            'payment_method' => $request->payment_method,
        ];
        // dd($request, $data);

        // $transact_dt = [
        //     'txn_ref' => $request->txn_ref_ ?? 'N/A',
        //     'txn_type' => 'expense',
        //     'total_amount_paid' => $request->total_paid_amount_ ?? 0,
        //     'payment_method' => $request->payment_method,
        //     'payment_type' => $request->payment_method,
        //     'invoice_no' => 'N/A',
        //     'receipt_no' => $request->receiving_grn
        // ];

        // $received = Receiving::create($receiving_data);
        $received =  Receiving::where('uuid', '=', $uuid)
        ->update($receiving_data);
        // $transacted = Transactions::create($transact_dt);
        if($received){ // && $transacted){
            //refresh the current page
            return redirect('/receiving-listings')->with('success', 'Receiving updated successfully');
        }
        else{
            //refresh the current page
            return redirect()->back()->with('error', 'Updating receiving failed');
        }
    }

    public function delete_receiving($uuid)
    {
       // dd($uuid);

        //dlete all the receiving items associated with the receiving
        //$receiving_items = ReceivingItem::find($uuid);
        //$receiving = Receiving::find($uuid);
        //dd($receiving_items, $receiving);
        if(!Receiving::where('uuid', '=', $uuid)->delete() && !ReceivingItem::where('uuid', '=', $uuid)->delete()){
            return  redirect()->back()->with('error', 'Receiving deletion failed');// redirect('/login')->with('success', 'Your password has been changed!');
        }

        return  redirect('/receiving-listings')->with('success', 'Receiving record deleted');

        //delete the receiving records associated with the uuid above
    }
}
