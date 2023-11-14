<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Receiving;
use App\Models\Supplier;
use Carbon\Carbon;
use Faker\Calculator\TCNo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TCPDF as OgegoPDF;

// require_once('tcpdf.php');

class ReportsController extends Controller
{
    // PRIVATE HELPERS
    private function report_pdf_display($title= NULL, $listing_data = [], $listing_view = '', $compact_url = NULL)
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

    private function filtered_report_pdf_display($title, $listing_data = [], $listing_view = '', $startDate, $endDate)
    {
        // dd();
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
            "start_date" => $startDate,
            "end_date" => $endDate,
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

    //PUBLIC METHODs
    // 1. Suppliers Reports
    public function suppliers_list()
    {
        if(Auth::guard('client')->check()){
            //Get client details
            $client = Auth::guard('client')->user();
            $suppliers_list = Supplier::get();
            // dd($suppliers_list);

            $data = [
                'saas_name' => 'BillsPack',
                'title' => 'BILLS PACK HOTEL MANAGEMENT SYSTEM | '.$client['company_name'].' Suppliers List',
                'company_subscription_package' => $client['company_subscription_package'],
                'company_id' => $client['id'],
                'company_name' => $client['company_name'],
                'company_email' => $client['company_email'],
                'company_phone' => $client['company_phone'],
                'company_address' => $client['company_address'],
                'company_contact_person_name' => $client['company_contact_person_name'],
                'company_contact_person_phone' => $client['company_contact_person_phone'],
                'suppliers_list' => $suppliers_list,
                'date' => Carbon::now(),
                'grn' => $this->generator(5),
            ];
            //dd($data);

            // $pdf = OgegoPDF::loadView('reports.suppliersList', $data);
            // return $pdf->download('suppliers_list.pdf');

            return view('reports.suppliersList', $data);
        }

        return redirect('login')->with('error', 'Access restricted to subscribed clients only');
    }

    public function suppliers_list_pdf()
    {
        $title = "Suppliers List";
        $listing_data = Supplier::get();
        $listing_view = 'reports.suppliersListPDF';

        return $this->report_pdf_display($title, $listing_data, $listing_view, NULL);
    }

    public function suppliers_filtered_list(Request $request)
    {
        if(Auth::guard('client')->check()){
            //Get client details
            $client = Auth::guard('client')->user();
            $suppliers_list = Supplier::get();
            // dd($suppliers_list);

            $data = [
                'saas_name' => 'BillsPack',
                'title' => 'BILLS PACK HOTEL MANAGEMENT SYSTEM | '.$client['company_name'].' Suppliers List',
                'company_subscription_package' => $client['company_subscription_package'],
                'company_id' => $client['id'],
                'company_name' => $client['company_name'],
                'company_email' => $client['company_email'],
                'company_phone' => $client['company_phone'],
                'company_address' => $client['company_address'],
                'company_contact_person_name' => $client['company_contact_person_name'],
                'company_contact_person_phone' => $client['company_contact_person_phone'],
                'suppliers_list' => $suppliers_list,
                'date' => Carbon::now(),
                'grn' => $this->generator(5),
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ];
            //dd($data);

            // $pdf = OgegoPDF::loadView('reports.suppliersList', $data);
            // return $pdf->download('suppliers_list.pdf');

            return view('reports.filteredSuppliersList', $data);
        }

        return redirect('login')->with('error', 'Access restricted to subscribed clients only');
    }

    public function suppliers_list_pdf_filtered($startDate, $endDate)
    {
        // dd($request);
        //dd($startDate, $endDate);
        $title = "Suppliers List from ".$startDate." to ".$endDate;
        $listing_data = Supplier::whereBetween('created_at', [$startDate, $endDate])->get();
        $listing_view = 'reports.suppliersListPDF'; //'reports.filteredSuppliersListPDF';

        return $this->filtered_report_pdf_display($title, $listing_data, $listing_view, $startDate, $endDate);
    }

    public function suppliers_report()
    {

        if(Auth::guard('client')->check()){
            //Get client details
            $client = Auth::guard('client')->user();
            //dd($client);

            $data = [
                'saas_name' => 'BillsPack',
                'title' => 'BILLS PACK HOTEL MANAGEMENT SYSTEM | '.$client['company_name'].' Suppliers Report',
                'company_subscription_package' => $client['company_subscription_package'],
                'company_name' => $client['company_name'],
                'company_email' => $client['company_email'],
                'company_phone' => $client['company_phone'],
                'company_address' => $client['company_address'],
                'company_contact_person_name' => $client['company_contact_person_name'],
                'company_contact_person_phone' => $client['company_contact_person_phone'],
                'grn' => $this->generator(5),
            ];
            //dd($data);

            return view('reports.suppliersReport', $data);
        }

        return redirect('login')->with('error', 'Access restricted to subscribed clients only');
    }

    // 2. Items Reports
    public function items_list()
    {
        if(Auth::guard('client')->check()){
            //Get client details
            $client = Auth::guard('client')->user();
            //dd($client);

            $data = [
                'saas_name' => 'BillsPack',
                'title' => 'BILLS PACK HOTEL MANAGEMENT SYSTEM | '.$client['company_name'].' Items List',
                'company_subscription_package' => $client['company_subscription_package'],
                'company_name' => $client['company_name'],
                'company_email' => $client['company_email'],
                'company_phone' => $client['company_phone'],
                'company_address' => $client['company_address'],
                'company_contact_person_name' => $client['company_contact_person_name'],
                'company_contact_person_phone' => $client['company_contact_person_phone'],
                'grn' => $this->generator(5),
            ];
            //dd($data);

            return view('reports.itemsList', $data);
        }

        return redirect('login')->with('error', 'Access restricted to subscribed clients only');
    }

    public function items_list_pdf()
    {
        $title = "Items List";
        $listing_data =Item::join('suppliers', 'items.item_supplier_id', '=', 'suppliers.id')
        ->join('categories', 'items.item_category_id', '=', 'categories.id')
        ->select('items.*', 'suppliers.company_name AS supplier_name', 'categories.category_name')
        ->orderBy('items.created_at', 'desc')
        ->get();
        $listing_view = 'reports.itemsListPDF';

        return $this->report_pdf_display($title, $listing_data, $listing_view, NULL);
    }

    public function items_filtered_list(Request $request)
    {
        //dd($request);
        if(Auth::guard('client')->check()){
            //Get client details
            $client = Auth::guard('client')->user();
            //dd($client);

            $data = [
                'saas_name' => 'BillsPack',
                'title' => 'BILLS PACK HOTEL MANAGEMENT SYSTEM | '.$client['company_name'].' Items List',
                'company_subscription_package' => $client['company_subscription_package'],
                'company_name' => $client['company_name'],
                'company_email' => $client['company_email'],
                'company_phone' => $client['company_phone'],
                'company_address' => $client['company_address'],
                'company_contact_person_name' => $client['company_contact_person_name'],
                'company_contact_person_phone' => $client['company_contact_person_phone'],
                'grn' => $this->generator(5),
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ];
            //dd($data);

            return view('reports.filteredItemsList', $data);
        }

        return redirect('login')->with('error', 'Access restricted to subscribed clients only');
    }

    public function items_list_pdf_filtered($startDate, $endDate)
    {
        // dd($request);
        //dd($startDate, $endDate);
        // $title = "Suppliers List from ".$startDate." to ".$endDate;
        // $listing_data = Supplier::whereBetween('created_at', [$startDate, $endDate])->get();
        // $listing_view = 'reports.suppliersListPDF'; //'reports.filteredSuppliersListPDF';

        // return $this->filtered_report_pdf_display($title, $listing_data, $listing_view, $startDate, $endDate);

        $title = "Items List from ".$startDate." to ".$endDate;
        $listing_data =Item::join('suppliers', 'items.item_supplier_id', '=', 'suppliers.id')
        ->join('categories', 'items.item_category_id', '=', 'categories.id')
        ->select('items.*', 'suppliers.company_name AS supplier_name', 'categories.category_name')
        ->orderBy('items.created_at', 'desc')
        ->whereBetween('items.created_at', [$startDate, $endDate])
        ->get();
        $listing_view = 'reports.itemsListPDF';

        return $this->report_pdf_display($title, $listing_data, $listing_view, NULL);
    }

    // 3. Goods Received Reports
    public function grn_report()
    {

        if(Auth::guard('client')->check()){
            //Get client details
            $client = Auth::guard('client')->user();
            //dd($client);

            $data = [
                'saas_name' => 'BillsPack',
                'title' => 'BILLS PACK HOTEL MANAGEMENT SYSTEM | '.$client['company_name'].' GRN Report',
                'company_subscription_package' => $client['company_subscription_package'],
                'company_name' => $client['company_name'],
                'company_email' => $client['company_email'],
                'company_phone' => $client['company_phone'],
                'company_address' => $client['company_address'],
                'company_contact_person_name' => $client['company_contact_person_name'],
                'company_contact_person_phone' => $client['company_contact_person_phone'],
                'grn' => $this->generator(5),
            ];
            //dd($data);

            return view('reports.grnReport', $data);
        }

        return redirect('login')->with('error', 'Access restricted to subscribed clients only');
    }

    public function grn_report_pdf()
    {
        //dd();

        $title = "GRN Report";
        $listing_data =Receiving::join('suppliers', 'receivings.receiving_supplier_id', '=', 'suppliers.id')
        ->select('receivings.*', 'suppliers.company_name AS supplier_name')//, 'categories.category_name')
        ->orderBy('receivings.created_at', 'desc')
        ->get();
        $listing_view = 'reports.grnReportPDF';

        return $this->report_pdf_display($title, $listing_data, $listing_view, NULL);
    }

    public function grn_filtered_report(Request $request)
    {
        //dd($request);
        if(Auth::guard('client')->check()){
            //Get client details
            $client = Auth::guard('client')->user();
            //dd($client);

            $data = [
                'saas_name' => 'BillsPack',
                'title' => 'BILLS PACK HOTEL MANAGEMENT SYSTEM | '.$client['company_name'].' Items List',
                'company_subscription_package' => $client['company_subscription_package'],
                'company_name' => $client['company_name'],
                'company_email' => $client['company_email'],
                'company_phone' => $client['company_phone'],
                'company_address' => $client['company_address'],
                'company_contact_person_name' => $client['company_contact_person_name'],
                'company_contact_person_phone' => $client['company_contact_person_phone'],
                'grn' => $this->generator(5),
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ];
            //dd($data);

            return view('reports.filteredGrnReport', $data);
        }

        return redirect('login')->with('error', 'Access restricted to subscribed clients only');
    }

    public function grn_report_pdf_filtered($startDate, $endDate)
    {
        // dd($startDate, $endDate);
        $title = "GRN Report from " . $startDate . " to " . $endDate;
        $listing_data =Receiving::join('suppliers', 'receivings.receiving_supplier_id', '=', 'suppliers.id')
        ->select('receivings.*', 'suppliers.company_name AS supplier_name')//, 'categories.category_name')
        ->whereBetween('receivings.created_at', [$startDate, $endDate])
        ->orderBy('receivings.receiving_date_time', 'desc')
        ->get();
        $listing_view = 'reports.grnReportPDF';

        return $this->report_pdf_display($title, $listing_data, $listing_view, NULL);
    }

    // 4. Requisitions reports
    public function requisition_report()
    {

        if(Auth::guard('client')->check()){
            //Get client details
            $client = Auth::guard('client')->user();
            //dd($client);

            $data = [
                'saas_name' => 'BillsPack',
                'title' => 'BILLS PACK HOTEL MANAGEMENT SYSTEM | '.$client['company_name'].' Requisition Report',
                'company_subscription_package' => $client['company_subscription_package'],
                'company_name' => $client['company_name'],
                'company_email' => $client['company_email'],
                'company_phone' => $client['company_phone'],
                'company_address' => $client['company_address'],
                'company_contact_person_name' => $client['company_contact_person_name'],
                'company_contact_person_phone' => $client['company_contact_person_phone'],
                'grn' => $this->generator(5),
            ];
            //dd($data);

            return view('reports.requisitionReport', $data);
        }

        return redirect('login')->with('error', 'Access restricted to subscribed clients only');
    }

    public function requisition_report_pdf()
    {
        dd();
    }

    public function requisition_filtered_report(Request $request)
    {
        dd($request);
    }

    public function requisition_report_pdf_filtered($startDate, $endDate)
    {
        dd($startDate, $endDate);
    }
}
