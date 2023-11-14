<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ViewCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    //
    public function index()
    {
        if(Auth::guard('client')->check()){
            //Get client details
            $client = Auth::guard('client')->user();
            // dd($client);

            //Fetch a list of categories from the categories view_table
            $categories_list = Category::where('client_id', '=', $client->id)->get();
            // dd($categories_list);

            $data = [
                'saas_name' => 'BillsPack',
                'title' => 'BILLS PACK HOTEL MANAGEMENT SYSTEM | '.$client['company_name'].' Categories',
                'company_id' => $client['id'],
                'company_subscription_package' => $client['company_subscription_package'],
                'company_name' => $client['company_name'],
                'company_email' => $client['company_email'],
                'company_phone' => $client['company_phone'],
                'company_address' => $client['company_address'],
                'company_contact_person_name' => $client['company_contact_person_name'],
                'company_contact_person_phone' => $client['company_contact_person_phone'],
                'categories' => $categories_list,
                'grn' => $this->generator(5),
            ];
            // dd($data);

            return view('category.index', $data);
        }

        return redirect('login')->with('error', 'Access restricted to subscribed clients only');
    }

    public function add_category(Request $request)
    {
        //dd($request);
        //Make sure the client is logged in
        if(!Auth::guard('client')->check()){
            return redirect('login')->with('error', 'Category addition restricted');
        }

        //validate data
        $request->validate([
            'category_name' => 'required'
        ]);

        //submit to db
        $data = $request->all();
        $created_category = $this->create_category($data);
        // dd($created_category);
        if($created_category){
            //refresh the current page
            return redirect()->back()->with('success', 'Category addition success');
        }
        else{
            //refresh the current page
            return redirect()->back()->with('error', 'Category addition failed');
        }
    }

    public function create_category($data)
    {
        $client = Auth::guard('client')->user();
        return Category::create([
            'client_id' => $client['id'],
            'category_name' => $data['category_name'],
            'category_description' => $data['category_description'] ?? 'N/A'
        ]);
    }

    public function update_category(Request $request, $category_id)
    {
        //validate
        $request->validate([
            'category_name' => 'required'
        ]);

        //update
        $update_cat = Category::where('id', '=', $category_id)
                        ->update([
                            'category_name' => $request->category_name,
                            'category_description' => $request->category_description
                        ]);

        //refresh page
        if(!$update_cat){
            return  redirect()->back()->with('error', 'Category update failed');// redirect('/login')->with('success', 'Your password has been changed!');
        }

        return  redirect()->back()->with('success', 'Category record updated');
    }

    public function delete_category($category_id)
    {
        //dd($category_id);
        $category = Category::find($category_id);
        if(!$category->delete()){
            return  redirect()->back()->with('error', 'Category deletion failed');// redirect('/login')->with('success', 'Your password has been changed!');
        }

        return  redirect()->back()->with('success', 'Category record deleted');
    }
}
