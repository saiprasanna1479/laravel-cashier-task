@include('layout.header')
<!-- Main Content -->
<main class="pt-20 lg:ml-64 p-4">
    <section class="bg-white py-8 antialiased  md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mx-auto max-w-5xl">
                <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                    <h2 class="text-xl font-semibold text-gray-900  sm:text-2xl">My orders</h2>
                </div>
                <div id="product-container">
                    @if($orders->isEmpty())
                       <div class="text-center py-8">
                        <h4 class="text-xl font-semibold text-gray-700 sm:text-2xl">No Orders Available</h4>
                        <p class="mt-2 text-gray-500">Currently there are no orders to display.</p>
                    </div>
                    @else
                    @foreach ($orders as $order)
                    <div class="mt-6 flow-root sm:mt-8">
                        <div class="divide-y divide-gray-200 ">
                            <div class="flex flex-wrap items-center gap-y-4 py-6">
                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500">Order ID:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900">
                                        <a href="#" class="hover:underline">ORD{{ $order->id }}</a>
                                    </dd>
                                </dl>

                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500 ">
                                        Product Name:
                                    </dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900 truncate" title="{{ $order->product_name }}">
                                        {{ $order->product_name }}
                                    </dd>
                                </dl>


                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500 ">Date:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900">{{ $order->created_at->format('d.m.Y') }}</dd>
                                </dl>

                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500 ">Price:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900">${{ number_format($order->total, 2) }}</dd>
                                </dl>
                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500 ">Status:</dt>
                                    @if($order->payment_status =="paid")
                                    <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 ">
                                        <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                        </svg>
                                        Confirmed
                                    </dd>
                                    @else
                                    <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 ">
                                        <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                        </svg>
                                        Cancelled
                                    </dd>
                                    @endif

                                </dl>

                                <div class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">
                                    <a href="{{ route('product', $order->product_id) }}" class="w-full inline-flex justify-center rounded-lg  border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 lg:w-auto">Order Again</a>
                                </div>
                            </div>


                        </div>
                    </div>
                    @endforeach
                    @endif

                </div>


            </div>
        </div>
    </section>
    <div id="loader" style="display: none;">Loading...</div>
</main>

<script>
    document.getElementById('menu-toggle').addEventListener('click', () => {
        document.getElementById('sidebar').classList.toggle('-translate-x-full');
    });
    let page = 2;
    let loading = false;
    let lastPageReached = false;

    window.addEventListener('scroll', () => {
        if (loading || lastPageReached) return;
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100) {
            loadMoreOrders();
        }
    });

    function loadMoreOrders() {
        loading = true;
        document.getElementById('loader').classList.remove('hidden');

        fetch(`/load-more-orders?page=${page}`)
            .then(res => res.json())
            .then(res => {
                if (!res.data || res.data.length === 0) {
                    lastPageReached = true;
                    return;
                }

                let appendResult = '';
                res.data.forEach(order => {
                    appendResult += `
                <div class="mt-6 flow-root sm:mt-8">
                    <div class="divide-y divide-gray-200 ">
                        <div class="flex flex-wrap items-center gap-y-4 py-6">
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500 ">Order ID:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900 ">
                                    <a href="#" class="hover:underline">ORD${order.id}</a>
                                </dd>
                            </dl>

                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500 ">Product Name:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900 truncate" title="${order.product_name}">
                                    ${order.product_name}
                                </dd>
                            </dl>

                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500 ">Date:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900 ">${order.created_at_formatted}</dd>
                            </dl>

                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500 ">Price:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900 ">$${parseFloat(order.total).toFixed(2)}</dd>
                            </dl>

                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500 ">Status:</dt>
                                ${order.payment_status === "paid"
                                    ? `<dd class="me-2 mt-1.5 inline-flex items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 ">
                                            <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                            </svg>
                                            Confirmed
                                        </dd>`
                                    : `<dd class="me-2 mt-1.5 inline-flex items-center rounded bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 ">
                                            <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                            </svg>
                                            Cancelled
                                        </dd>`
                                }
                            </dl>

                            <div class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">
                                <a href="/product/${order.product_id}" class="w-full inline-flex justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 lg:w-auto">
                                    Order Again
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            `;
                });

                document.getElementById('product-container').insertAdjacentHTML('beforeend', appendResult);

                if (res.next_page) {
                    page = res.next_page;
                } else {
                    lastPageReached = true;
                }
            })
            .finally(() => {
                loading = false;
                document.getElementById('loader').classList.add('hidden');
            });

    }
</script>
@include('layout.footer')
