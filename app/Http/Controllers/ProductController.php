<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function getProduct(Request $request)
    {
        $product = Product::with('images')->findOrFail($request->id);
        return view('productDetail', compact('product'));
    }


}
