<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showDetails($id)
    {
        // Fetch product details based on $id
        $product = Product::findOrFail($id);

        // Pass $product to the view and render the details page
        return view('frontend.details', compact('product'));
    }
}
