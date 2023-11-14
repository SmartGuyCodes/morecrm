<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Item;
use App\Models\Receiving;
use App\Models\Requisition;
use App\Models\Staff;
use App\Models\Supplier;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
// use OgegoCharts;
// use ArielMejiaDev\LarapexCharts\Facades\LarapexChart
use ArielMejiaDev\LarapexCharts\LarapexChart as OgegoCharts;

class DashboardController extends Controller
{
    //
    public function index()
    {
        if(Auth::guard('client')->check()){
            //Get client details
            $client = Auth::guard('client')->user();
            // dd($client);

            $goods_received_number = 'GRN#'.$this->generator(5);

            //Totals
            $total_categories = $this->get_total_client_categories($client->id);
            $total_items = $this->get_total_client_items($client->id);
            $total_suppliers = $this->get_total_suppliers($client->id);
            $total_requisitions = $this->get_total_requisitions($client->id);
            $total_receivings = $this->get_total_receivings($client->id);
            $total_staff = $this->get_total_staffers();
            //dd($total_suppliers);

            $data = [
                'saas_name' => 'MoreCRM',
                'title' => 'MORE CLIENT MANAGEMENT SYSTEM | Dashboard',
                'company_subscription_package' => $client['company_subscription_package'],
                'company_name' => $client['company_name'],
                'company_email' => $client['company_email'],
                'company_phone' => $client['company_phone'],
                'company_address' => $client['company_address'],
                'company_contact_person_name' => $client['company_contact_person_name'],
                'company_contact_person_phone' => $client['company_contact_person_phone'],
                'total_categories' => $total_categories,
                'total_items' => $total_items,
                'total_suppliers' => $total_suppliers,
                'total_requisitions' => $total_requisitions,
                'total_receivings' => $total_receivings,
                'total_staff' => $total_staff,
                'grn' => $this->generator(5),
                // // 'sales_chart' => $sales_chart,
                // 'monthly_supplies_chart' => $monthly_supplies_chart,
                // 'yearly_sales_chart' => $yearly_sales_chart
            ];
            //dd($data);

            return view('client.index', $data);
        }

        return redirect('login')->with('error', 'Access restricted to subscribed clients only');
    }

    private function get_total_client_categories($client_id)
    {
        $categories = Category::where('client_id', '=', $client_id)->get();
        return count($categories);
    }

    private function get_total_client_items($client_id)
    {
        $items = Item::where('client_id', '=', $client_id)->get();
        return count($items);
    }

    private function get_total_suppliers($client_id)
    {
        $suppliers = Supplier::where('client_id', '=', $client_id)->get();
        return count($suppliers);
    }

    private function get_total_receivings($client_id)
    {
        $receivings = Receiving::where('client_id', '=', $client_id)->get();
        return count($receivings);
    }

    private function get_total_requisitions($client_id)
    {
        $requisitions = Requisition::where('client_id', '=', $client_id)->get();
        return count($requisitions);
    }

    private function get_total_staffers()
    {
        $staffers = Staff::all();
        return count($staffers);
    }
}
