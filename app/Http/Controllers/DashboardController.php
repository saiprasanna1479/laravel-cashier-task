<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{

    /**
     * Display the initial product list.
     *
     * Fetches the first 15 products with their related product images.
     * This is used for the initial page rendering before infinite scrolling.
     *
     */
    public function index(Request $request)
    {
        $products = Product::with(['images' => function ($query) {
            $query->where('status', 'A');
        }])
            ->orderBy('id', 'desc')
            ->where(['status' => 'A'])
            ->paginate(15);

        return view('dashboard', compact('products'));
    }

    /**
     * Fetch more products for infinite scroll.
     *
     * Triggered when the user scrolls down and requests more data.
     * Returns JSON response for appending to the list on the frontend.
     *
     */
    public function loadMoreProducts(Request $request)
    {
        $page = $request->get('page', 1);
        $products = Product::with(['images' => function ($query) {
            $query->where('status', 'A');
        }])
            ->orderBy('id', 'desc')
            ->where(['status' => 'A'])
            ->paginate(15, ['*'], 'page', $page);

        return response()->json([
            'data' => $products->items(),
            'next_page' => $products->hasMorePages() ? $page + 1 : null
        ]);
    }
}
