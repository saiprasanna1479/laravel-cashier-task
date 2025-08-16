@include('layout.header')
<!-- Main Content -->
<main class="pt-20 lg:ml-64 p-4">
    <section class="bg-white rounded-lg p-8 shadow-lg">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8">Introducing Our Latest Product</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="product-container">
                @foreach ($products as $product)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition overflow-hidden flex flex-col">
                    <div class="relative group">
                        @if(isset($product->images[0]->image) && !empty($product->images[0]->image))
                        <img src="{{ $product->images[0]->image }}" alt="{{ $product->product_name }}" class="object-cover w-full h-56" />
                        @endif

                        <div class="absolute inset-0 bg-white bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                            <a href="{{ route('product', $product->id) }}">
                                <button class="bg-gray-900 text-white py-2 px-5 rounded-full font-semibold shadow hover:bg-gray-800">
                                    View Product
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <h3 class="text-xl font-bold text-gray-900">{{ $product->product_name }}</h3>
                        <p class="text-gray-700 text-sm mt-2 flex-1">{{ $product->description }}</p>
                        <div class="flex items-center justify-between mt-5">
                            <div>
                                <span class="text-sm text-gray-400 line-through">{{ $product->mrp_price }}</span>
                                <span class="text-lg font-bold text-gray-900 ml-2">{{ $product->selling_price }}</span>
                            </div>

                            <a href="{{ route('product', $product->id) }}"
                                class="bg-gray-900 text-white py-2 px-4 rounded-full font-semibold hover:bg-gray-800">
                                Buy Now
                            </a>
                        </div>
                    </div>
                </div>

                <div id="loader" style="display: none;">Loading...</div>
                @endforeach
            </div>
        </div>
    </section>
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
            loadMoreProducts();
        }
    });

    function loadMoreProducts() {
        loading = true;
        document.getElementById('loader').classList.remove('hidden');

        fetch(`/load-more-products?page=${page}`)
            .then(res => res.json())
            .then(res => {
                if (!res.data || res.data.length === 0) {
                    lastPageReached = true;
                    return;
                }
                let appendResult = '';
                res.data.forEach(product => {
                    appendResult += `
                            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition overflow-hidden flex flex-col">
                                <div class="relative group">
                                    ${product.images.length > 0 && product.images[0].image
                                        ? `<img src="${product.images[0].image}" alt="${product.product_name}" class="object-cover w-full h-56" />`
                                        : ''}
                                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                        <button class="bg-white text-gray-900 py-2 px-5 rounded-full font-semibold shadow hover:bg-gray-200">
                                            View Product
                                        </button>
                                    </div>
                                </div>
                                <div class="p-5 flex flex-col flex-1">
                                    <h3 class="text-xl font-bold text-gray-900">${product.product_name}</h3>
                                    <p class="text-gray-500 text-sm mt-2 flex-1">${product.description ?? ''}</p>
                                    <div class="flex items-center justify-between mt-5">
                                        <div>
                                            <span class="text-sm text-gray-500 line-through">${product.mrp_price}</span>
                                            <span class="text-lg font-bold text-gray-900 ml-2">${product.selling_price}</span>
                                        </div>
                                        <button class="bg-gray-900 text-white py-2 px-4 rounded-full font-semibold hover:bg-gray-800">
                                            Buy Now
                                        </button>
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
