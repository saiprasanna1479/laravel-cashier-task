<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function getProduct(Request $request)
    {
        $product = Product::with('images')->findOrFail($request->id);
        return view('productDetail', compact('product'));
    }


}
