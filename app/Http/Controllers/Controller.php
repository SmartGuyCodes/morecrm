<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use TCPDF as OgegoPDF;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function generate_pdf($pdf_data)
    {
        dd($pdf_data);
        // Set PDF Headers

        // Set PDF content type
    }
    public function generator($limit)
    {
        $code = '';

        for($i = 0; $i < $limit; $i++)
        {
            $code .= mt_rand(1,9);
        }

        return $code;
    }

    public function upload(Request $request)
    {
        //dd($request);
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
            $path = $image->storeAs('public/uploads/items', $filename);

            return $path;
        }
        else{
            Log::error('No image is uploaded');
            return '';
        }
    }
}