<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Place an order.
     *
     * This method processes the payment for a product order.
     *
     */
    public function processPayment(Request $request)
    {
        $validated = $request->validate([
            'payment_method_id' => 'required|string',
            'quantity' => 'required|integer|min:1|max:10',
            'amount' => 'required|numeric|min:0',
            'product_id' => 'required|integer|exists:products,id'
        ]);

        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Create PaymentIntent with error handling
            $intent = PaymentIntent::create([
                'amount' => $validated['amount'] * 100,
                'currency' => 'inr',
                'payment_method' => $validated['payment_method_id'],
                'confirm' => true,
                'description' => 'Purchase for Product #' . $request->product_id,
                'metadata' => [
                    'user_id' => auth()->id(),
                    'product_id' => $request->product_id,
                    'quantity' => $validated['quantity']
                ],
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'never'
                ],
            ]);

            // Handle different payment states
            switch ($intent->status) {
                case 'requires_action':
                    return response()->json([
                        'requires_action' => true,
                        'client_secret' => $intent->client_secret
                    ]);

                case 'succeeded':
                    $order = $this->createOrder($intent, $validated, "paid");
                    return response()->json([
                        'success' => true,
                        'order_id' => $order->id,
                        'amount' => $validated['amount']
                    ]);

                default:
                    throw new \Exception('Payment processing failed');
            }
        } catch (\Stripe\Exception\CardException $e) {
            // Specific card errors
            $error = $e->getError();

            return response()->json([
                'error' => $error->message,
                'code' => $error->code
            ], 400);
        } catch (\Stripe\Exception\RateLimitException $e) {
            // Too many requests
            return response()->json(['error' => 'Too many payment attempts. Please try again later.'], 429);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Invalid parameters
            return response()->json(['error' => $e->getMessage()], 400);
        } catch (\Exception $e) {
            // General error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function createOrder($paymentIntent, $validated, $status)
    {
        $product = Product::findOrFail($validated['product_id']);
        return Order::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'product_name' => $product->product_name,
            'quantity' => $validated['quantity'],
            'price' => $product->selling_price,
            'total' => round((float) $validated['quantity'] * (float) $product->selling_price, 2),
            'payment_id' => $paymentIntent->id,
            'payment_status' => $status,
            'status' => 'A'
        ]);
    }

    /**
     * Display the initial order list.
     *
     * Fetches the first 15 orders.
     * This is used for the initial page rendering before infinite scrolling.
     *
     */
    public function getOrders(Request $request)
    {
        $orders = Order::with('product.images')->orderBy('id', 'desc')
            ->paginate(15);

        return view('orders', compact('orders'));
    }

    /**
     * Fetch more orders for infinite scroll.
     *
     * Triggered when the user scrolls down and requests more data.
     * Returns JSON response for appending to the list on the frontend.
     *
     */
    public function loadMoreOrders(Request $request)
    {
        $page = $request->get('page', 1);
        $orders = Order::orderBy('id', 'desc')->paginate(15, ['*'], 'page', $page);

        return response()->json([
            'data' => $orders->items(),
            'next_page' => $orders->hasMorePages() ? $page + 1 : null
        ]);
    }
}
