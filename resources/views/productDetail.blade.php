@include('layout.header')

<main class="pt-20 lg:ml-64">
    <section class="bg-white ">
        <div class="container mx-auto px-4 py-8 max-w-7xl">
            <!-- Breadcrumbs -->
            <nav class="mb-6 hidden md:block" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="{{ url('/dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors">Home</a>
                    </li>
                    <li class="text-gray-400">/</li>
                    <li>
                        <a href="{{ url('/dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors">Products</a>
                    </li>
                    <li class="text-gray-400">/</li>
                    <li aria-current="page">
                        <span class="text-gray-700 font-medium">{{ $product->product_name }}</span>
                    </li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Product Gallery -->
                <div class="space-y-4">
                    <!-- Main Image -->
                    <div class="relative overflow-hidden rounded-xl bg-gray-100 aspect-square">
                        <img id="mainImage" src="{{ $product->images[0]->image }}" alt="{{ $product->product_name }}"
                            class="w-full h-full object-contain p-4 transition-opacity duration-300">

                        @if($product->mrp_price > $product->selling_price)
                        <span class="absolute top-4 left-4 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-md">
                            SAVE {{ round(100 - ($product->selling_price / $product->mrp_price * 100)) }}%
                        </span>
                        @endif
                    </div>

                    <!-- Thumbnails -->
                    <div class="grid grid-cols-4 gap-3">
                        @foreach($product->images as $image_key => $image)
                        @if($image_key != 0)
                        <button onclick="document.getElementById('mainImage').src='{{ $image->image }}'"
                            class="aspect-square overflow-hidden rounded-lg border-2 border-transparent hover:border-blue-500 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <img src="{{ $image->image }}" alt="Thumbnail {{ $image_key + 1 }}"
                                class="w-full h-full object-cover">
                        </button>
                        @endif
                        @endforeach
                    </div>
                </div>

                <!-- Product Details -->
                <div class="space-y-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->product_name }}</h1>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center">
                                <!-- Star rating would go here -->
                                <div class="flex text-yellow-400">
                                    <!-- Sample stars -->
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-500 text-sm ml-2">(24 reviews)</span>
                            </div>
                            <span class="text-green-600 text-sm font-medium">In Stock</span>
                        </div>
                    </div>

                    <!-- Pricing -->
                    <div class="space-y-2">
                        <div class="flex items-center space-x-4">
                            <p class="text-3xl font-bold text-gray-900">₹{{ number_format($product->selling_price, 2) }}</p>
                            @if($product->mrp_price > $product->selling_price)
                            <p class="text-lg text-gray-500 line-through">₹{{ number_format($product->mrp_price, 2) }}</p>
                            @endif
                        </div>
                        <p class="text-sm text-gray-500">Inclusive of all taxes</p>
                    </div>

                    <!-- Description -->
                    <div class="prose max-w-none text-gray-700">
                        <p>{{ $product->description }}</p>
                    </div>

                    <!-- Quantity Selector -->
                    <div class="flex items-center space-x-4">
                        <label for="quantity" class="text-sm font-medium text-gray-700">Quantity:</label>
                        <div class="flex items-center border border-gray-300 rounded-md">
                            <button type="button" onclick="updateQuantity(-1)" class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                </svg>
                            </button>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="10"
                                class="w-16 py-1 text-center border-0 bg-transparent text-gray-900 focus:ring-2 focus:ring-blue-500"
                                onchange="validateQuantity()" oninput="updateTotalPrice()">
                            <button type="button" onclick="updateQuantity(1)" class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-r-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <form action="#" method="POST" id="payment-form" class="space-y-6 w-full">
                            @csrf
                            <div>
                                <input type="hidden" id="product-id" value="{{ $product->id }}">
                                <label for="card-element" class="block text-sm font-medium text-gray-700 mb-2">
                                    Credit or Debit Card
                                </label>
                                <div id="card-element" class="p-4 border border-gray-300 rounded-lg bg-white shadow-sm">
                                    <!-- Stripe Elements will be inserted here -->
                                </div>
                                <div id="card-errors" class="mt-2 text-sm text-red-600" role="alert"></div>
                            </div>
                            <button type="submit"
                                class="w-full md:w-full bg-green-600 hover:bg-green-700 text-white py-3 px-8 rounded-lg font-semibold transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                Pay <span id="total-price">₹{{ number_format($product->selling_price, 2) }}</span> Securely
                            </button>
                        </form>
                    </div>


                    <!-- Additional Info -->
                    <div class="pt-4 border-t border-gray-200">
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <h3 class="font-medium text-gray-900">SKU</h3>
                                <p class="text-gray-500">PRD-{{ $product->id }}</p>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-900">Category</h3>
                                <p class="text-gray-500">Electronics</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</main>
<!-- Add this success modal to your HTML -->
<div id="payment-success-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white  rounded-lg p-8 max-w-md w-full mx-4">
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h3 class="mt-3 text-lg font-medium text-gray-900">Payment Successful!</h3>
            <div class="mt-2 text-sm text-gray-500">
                <p>Thank you for your order. Your payment of <span id="success-amount" class="font-semibold"></span> was completed successfully.</p>
                <p class="mt-2">Order ID: <span id="success-order-id" class="font-mono"></span></p>
            </div>
            <div class="mt-4">
                <a href="/orders" class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    View Your Orders
                </a>
                <button onclick="closeSuccessModal()" class="ml-3 inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Continue Shopping
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Add this failure modal to your HTML -->
<div id="payment-failed-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white  rounded-lg p-8 max-w-md w-full mx-4">
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <h3 class="mt-3 text-lg font-medium text-gray-900">Payment Failed</h3>
            <div class="mt-2 text-sm text-gray-500">
                <p id="failure-message">We couldn't process your payment. Please try again.</p>
                <p class="mt-2">Error Reference: <span id="error-reference" class="font-mono text-xs"></span></p>
            </div>
            <div class="mt-4">
                <button onclick="retryPayment()" class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Try Again
                </button>
                <button onclick="closeFailedModal()" class="ml-3 inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    // Store the original price
    const unitPrice = '{{ $product->selling_price }}';

    // Update quantity with + and - buttons
    function updateQuantity(change) {
        const quantityInput = document.getElementById('quantity');
        let newQuantity = parseInt(quantityInput.value) + change;

        // Ensure quantity stays within bounds
        newQuantity = Math.max(1, Math.min(10, newQuantity));

        quantityInput.value = newQuantity;
        updateTotalPrice();
    }

    // Validate quantity when manually typed
    function validateQuantity() {
        const quantityInput = document.getElementById('quantity');
        let quantity = parseInt(quantityInput.value);

        if (isNaN(quantity) || quantity < 1) {
            quantity = 1;
        } else if (quantity > 10) {
            quantity = 10;
        }

        quantityInput.value = quantity;
        updateTotalPrice();
    }

    const stripe = Stripe("{{ env('STRIPE_KEY') }}");
    const elements = stripe.elements();

    // Custom styling for Stripe Elements
    const style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    const cardElement = elements.create('card', {
        style: style
    });
    cardElement.mount('#card-element');

    const form = document.getElementById('payment-form');
    const cardErrors = document.getElementById('card-errors');



    // Update your existing Stripe submission handler
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const submitButton = form.querySelector('button[type="submit"]');
        const cardErrors = document.getElementById('card-errors');
        const quantity = parseInt($('#quantity').val());
        const totalAmount = unitPrice * quantity;

        // Reset UI
        submitButton.disabled = true;
        submitButton.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Processing...';
        cardErrors.textContent = '';

        try {
            const {
                paymentMethod,
                error
            } = await stripe.createPaymentMethod({
                type: 'card',
                card: cardElement
            });

            if (error) {
                throw new Error(error.message);
            }

            // Create payment intent on your server
            const response = await fetch("{{ route('processPayment') }}", {
                method: 'POST',
               headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    payment_method_id: paymentMethod.id,
                    quantity: quantity,
                    amount: totalAmount,
                    product_id: "{{ $product->id }}"
                })
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.error || 'Payment processing failed');
            }

            if (result.requires_action) {
                // Handle 3D Secure authentication
                const {
                    error: confirmError
                } = await stripe.confirmCardPayment(
                    result.client_secret
                );

                if (confirmError) {
                    throw new Error(confirmError.message);
                }

                // If 3DS succeeds, show success
                showSuccessModal(totalAmount, result.order_id);
            } else if (result.success) {
                showSuccessModal(totalAmount, result.order_id);
            } else {
                throw new Error('Payment failed unexpectedly');
            }

        } catch (error) {
            // Classify different error types
            let errorMessage = error.message;
            let errorCode = 'STRIPE_ERROR';

            if (error.message.includes('card was declined')) {
                errorMessage = 'Your card was declined. Please try another payment method.';
                errorCode = 'CARD_DECLINED';
            } else if (error.message.includes('expired card')) {
                errorMessage = 'Your card has expired. Please use a different card.';
                errorCode = 'CARD_EXPIRED';
            } else if (error.message.includes('insufficient funds')) {
                errorMessage = 'Insufficient funds. Please try another payment method.';
                errorCode = 'INSUFFICIENT_FUNDS';
            }

            showFailedModal(errorMessage, errorCode);
            cardErrors.textContent = errorMessage;

        } finally {
            submitButton.disabled = false;
            submitButton.textContent = `Pay ₹${totalAmount.toFixed(2)} Securely`;
        }
    });

    // Handle real-time validation errors from the card Element
    cardElement.on('change', (event) => {
        if (event.error) {
            cardErrors.textContent = event.error.message;
        } else {
            cardErrors.textContent = '';
        }
    });
    // Initialize with correct price
    document.addEventListener('DOMContentLoaded', function() {
        updateTotalPrice();
    });
    // Update the total price display
    function updateTotalPrice() {
        const quantity = parseInt(document.getElementById('quantity').value);
        const totalPrice = unitPrice * quantity;
        document.getElementById('total-price').textContent = `₹${totalPrice.toFixed(2)}`;


    }

    function closeSuccessModal() {
        document.getElementById('payment-success-modal').classList.add('hidden');
    }

    function showSuccessModal(amount, orderId) {
        document.getElementById('success-amount').textContent = '₹' + amount.toFixed(2);
        document.getElementById('success-order-id').textContent = orderId;
        document.getElementById('payment-success-modal').classList.remove('hidden');
    }

    function closeFailedModal() {
        document.getElementById('payment-failed-modal').classList.add('hidden');
    }

    function showFailedModal(message, errorCode) {
        document.getElementById('failure-message').textContent = message;
        document.getElementById('error-reference').textContent = errorCode || 'UNKNOWN_ERROR';
        document.getElementById('payment-failed-modal').classList.remove('hidden');
    }

    function retryPayment() {
        closeFailedModal();
        // Optional: Scroll to payment form
        document.getElementById('payment-form').scrollIntoView({
            behavior: 'smooth'
        });
    }
</script>

@include('layout.footer')
