@extends('layouts.home')

@section('content')

<div class="container mx-auto px-4 py-8">
    {{-- Page Title & Breadcrumbs --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Shop For {{ $searchTerm }}</h1>
        <div class="flex items-center text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-[#C13608] transition-colors">Home</a>
            <span class="mx-2">></span>
            <a class="transition-colors">Products</a>
            <span class="mx-2">></span>
            <span class="text-[#C13608]">{{ $searchTerm }}</span>
        </div>
    </div>

    {{-- Filter Section --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 bg-white p-4 rounded-lg shadow-sm">
        {{-- Filter Dropdown --}}
        <div class="flex items-center mb-4 md:mb-0">
            <span class="mr-3 text-gray-700">Filter:</span>
            <div class="relative">
                <select
                    class="appearance-none bg-white border border-gray-300 rounded-md py-2 px-4 pr-8 leading-tight focus:outline-none focus:ring-2 focus:ring-[#FFC000] transition-shadow">
                    <option>All Categories</option>
                    <option>Electronics</option>
                    <option>Fashion</option>
                    <option>Home & Kitchen</option>
                    <option>Beauty</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <i class="fas fa-chevron-down text-sm"></i>
                </div>
            </div>
        </div>

        {{-- Sort Dropdown --}}
        <div class="flex items-center">
            <span class="mr-3 text-gray-700">Sort by:</span>
            <div class="relative">
                <select
                    class="appearance-none bg-white border border-gray-300 rounded-md py-2 px-4 pr-8 leading-tight focus:outline-none focus:ring-2 focus:ring-[#FFC000] transition-shadow">
                    <option>Featured</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Customer Rating</option>
                    <option>Newest Arrivals</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <i class="fas fa-chevron-down text-sm"></i>
                </div>
            </div>
        </div>
    </div>


    {{-- Products Grid --}}
    @if($products->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($products as $product)
        <div
            class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">
            <a href="/products/{{$product->category_id}}/{{$product->subcategory_id}}/{{$product->id}}">
                {{-- Image and badges --}}
                <div class="relative">
                    <img src="{{ $product->image_url ?? 'https://images.unsplash.com/vector-1738237080330-b9d0755ede07?q=80&w=2148&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }}"
                        alt="{{ $product->product_name }}" class="w-full h-56 object-cover" />
                    <div class="absolute top-3 left-3 flex flex-col space-y-2">
                        @if(isset($product->badge))
                        <span class="bg-[#C13608] text-white text-xs font-semibold px-3 py-1 rounded-full">
                            {{ $product->badge }}
                        </span>
                        @endif
                        @if(isset($product->discount))
                        <span class="bg-[#FFC000] text-gray-900 text-xs font-semibold px-3 py-1 rounded-full">
                            {{ $product->discount }}
                        </span>
                        @endif
                    </div>
                </div>
                {{-- Product Info --}}
                <div class="p-4 flex flex-col flex-grow">
                    {{-- Ratings --}}
                    <div class="flex items-center mb-2">
                        <div class="flex text-yellow-400">
                            @for($i = 1; $i <= 5; $i++) @if($i <=floor($product->ratings))
                                <i class="fas fa-star text-sm"></i>
                                @elseif($i == ceil($product->ratings) && !is_int($product->ratings))
                                <i class="fas fa-star-half-alt text-sm"></i>
                                @else
                                <i class="far fa-star text-sm"></i>
                                @endif
                                @endfor
                        </div>
                        <span class="text-gray-500 text-xs ml-2">({{ $product->previews }})</span>
                    </div>
                    {{-- Name & Description --}}
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $product->product_name }}</h3>
                    <p class="text-gray-600 text-sm mb-3 flex-grow">{{ $product->description }}</p>

                    {{-- Price --}}
                    <div class="flex items-center justify-between mt-auto">
                        <div>
                            <div class="text-lg font-bold text-[#C13608]">UGX {{ $product->price }}</div>
                        </div>
                        {{-- Cart Controls --}}
                        <div class="product-cart-controls" data-product-id="{{ $product->id }}">
                            @if (session()->has('cart') && isset(session('cart')[$product->id]))
                            {{-- Add Button --}}
                            <button
                                class="add-to-cart bg-[#FFC000] hover:bg-[#e6ac00] text-gray-800 font-medium py-2 px-4 rounded-full transition flex items-center hidden"
                                data-loading="false" data-quantity="0">
                                <i class="fas fa-shopping-cart mr-2 text-sm"></i> Add
                            </button>
                            {{-- Quantity Controls (hidden initially) --}}
                            <div class="quantity-controls flex items-center space-x-2" data-quantity="0">
                                <button
                                    class="decrease-qty bg-gray-200 hover:bg-gray-300 rounded-full w-8 h-8 flex items-center justify-center transition-colors">
                                    <i class="fas fa-minus text-xs"></i>
                                </button>
                                <span class="qty w-6 text-center">{{ session('cart')[$product->id]['quantity']}}</span>
                                <button
                                    class="increase-qty bg-gray-200 hover:bg-gray-300 rounded-full w-8 h-8 flex items-center justify-center transition-colors">
                                    <i class="fas fa-plus text-xs"></i>
                                </button>
                                <span class="added-text ml-2 text-sm text-gray-700 hidden md:inline">Added</span>
                            </div>
                            @else
                            {{-- Add Button --}}
                            <button
                                class="add-to-cart bg-[#FFC000] hover:bg-[#e6ac00] text-gray-800 font-medium py-2 px-4 rounded-full transition flex items-center unset-all"
                                data-loading="false" data-quantity="0">
                                <i class="fas fa-shopping-cart mr-2 text-sm"></i> Add
                            </button>
                            {{-- Quantity Controls (hidden initially) --}}
                            <div class="quantity-controls flex items-center space-x-2 hidden" data-quantity="0">
                                <button
                                    class="decrease-qty bg-gray-200 hover:bg-gray-300 rounded-full w-8 h-8 flex items-center justify-center transition-colors">
                                    <i class="fas fa-minus text-xs"></i>
                                </button>
                                <span class="qty w-6 text-center">0</span>
                                <button
                                    class="increase-qty bg-gray-200 hover:bg-gray-300 rounded-full w-8 h-8 flex items-center justify-center transition-colors">
                                    <i class="fas fa-plus text-xs"></i>
                                </button>
                                <span class="added-text ml-2 text-sm text-gray-700 hidden md:inline">Added</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @else
    {{-- No Products Found Section --}}
    <div class="flex flex-col items-center justify-center py-16 bg-white rounded-xl shadow-sm">
        <div class="text-center max-w-md mx-auto">
            <div class="mb-6">
                <!-- Improved sad cart with face inside (cart bigger, face same size) -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 mx-auto" viewBox="0 0 24 24" fill="none">
                    <!-- Cart Body -->
                    <path
                        d="M3 3H5L5.4 5M7 13H17L21 5H5.4M7 13L5.4 5M7 13L4.707 15.293C4.077 15.923 4.523 17 5.414 17H17M17 17C15.895 17 15 17.895 15 19C15 20.105 15.895 21 17 21C18.105 21 19 20.105 19 19C19 17.895 18.105 17 17 17ZM9 19C9 20.105 8.105 21 7 21C5.895 21 5 20.105 5 19C5 17.895 5.895 17 7 17C8.105 17 9 17.895 9 19Z"
                        stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />

                    <!-- Face inside cart body (scaled to keep same size) -->
                    <g transform="translate(12.5 8.75) scale(0.6) translate(-4.5 -6.75)" stroke="var(--accent1)"
                        stroke-width="1.5" stroke-linecap="round">
                        <!-- Eyes -->
                        <path d="M1.5 3.5L3.5 5.5" />
                        <path d="M1.5 5.5L3.5 3.5" />
                        <path d="M5.5 3.5L7.5 5.5" />
                        <path d="M5.5 5.5L7.5 3.5" />

                        <!-- Sad frown -->
                        <path d="M1 11C1 11 4 7 8 11" stroke-linejoin="round" />
                    </g>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-3">No Products Found</h2>
            <p class="text-gray-600 mb-6">
                We couldn't find any products matching "{{ $searchTerm }}". Try different keywords or browse our
                categories.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}"
                    class="px-6 py-3 bg-[#FFC000] hover:bg-[#e6ac00] text-gray-800 font-medium rounded-lg transition-colors flex items-center justify-center">
                    <i class="fas fa-home mr-2"></i> Return Home
                </a>

            </div>
        </div>
    </div>
    @endif

    @php
    // Safe defaults: prefer passed variables, otherwise get them from the paginator
    $searchTerm = $searchTerm ?? request('q', '');
    $currentPage = $currentPage ?? ($products->currentPage() ?? 1);
    $totalPages = $totalPages ?? ($products->lastPage() ?? 1);

    // compute start/end if not passed
    $startPage = $startPage ?? max(1, $currentPage - 2);
    $endPage = $endPage ?? min($totalPages, $currentPage + 2);

    if ($currentPage <= 2) { $endPage=min(5, $totalPages); } if ($currentPage>= $totalPages - 1) {
        $startPage = max(1, $totalPages - 4);
        }

        // helper to produce page URL while preserving all current query params (including q)
        function page_url($page) {
        return request()->fullUrlWithQuery(['page' => $page]);
        }
        @endphp

        {{-- Pagination --}}
        @if($totalPages > 1)
        <div class="mt-12 flex justify-center">
            <nav class="flex items-center space-x-1" aria-label="Search results pagination">
                {{-- Previous --}}
                @if($currentPage > 1)
                <a href="{{ page_url($currentPage - 1) }}"
                    class="inline-flex items-center justify-center w-10 h-10 text-[#C13608] rounded-full hover:bg-[#FFC000] hover:text-white transition-colors">
                    <i class="fas fa-chevron-left text-sm"></i>
                </a>
                @else
                <span
                    class="inline-flex items-center justify-center w-10 h-10 text-[#C13608] rounded-full opacity-50 cursor-not-allowed">
                    <i class="fas fa-chevron-left text-sm"></i>
                </span>
                @endif

                {{-- First + ellipsis --}}
                @if($startPage > 1)
                <a href="{{ page_url(1) }}"
                    class="inline-flex items-center justify-center w-10 h-10 text-gray-700 rounded-full hover:bg-gray-100 transition-colors">1</a>
                @if($startPage > 2)
                <span class="inline-flex items-center justify-center w-10 h-10 text-gray-500">...</span>
                @endif
                @endif

                {{-- Page Numbers --}}
                @for($i = $startPage; $i <= $endPage; $i++) @if($i==$currentPage) <span
                    class="inline-flex items-center justify-center w-10 h-10 text-white bg-[#C13608] rounded-full">{{ $i
                    }}</span>
                    @else
                    <a href="{{ page_url($i) }}"
                        class="inline-flex items-center justify-center w-10 h-10 text-gray-700 rounded-full hover:bg-gray-100 transition-colors">{{
                        $i }}</a>
                    @endif
                    @endfor

                    {{-- Last + ellipsis --}}
                    @if($endPage < $totalPages) @if($endPage < $totalPages - 1) <span
                        class="inline-flex items-center justify-center w-10 h-10 text-gray-500">...</span>
                        @endif
                        <a href="{{ page_url($totalPages) }}"
                            class="inline-flex items-center justify-center w-10 h-10 text-gray-700 rounded-full hover:bg-gray-100 transition-colors">{{
                            $totalPages }}</a>
                        @endif

                        {{-- Next --}}
                        @if($currentPage < $totalPages) <a href="{{ page_url($currentPage + 1) }}"
                            class="inline-flex items-center justify-center w-10 h-10 text-[#C13608] rounded-full hover:bg-[#FFC000] hover:text-white transition-colors">
                            <i class="fas fa-chevron-right text-sm"></i>
                            </a>
                            @else
                            <span
                                class="inline-flex items-center justify-center w-10 h-10 text-[#C13608] rounded-full opacity-50 cursor-not-allowed">
                                <i class="fas fa-chevron-right text-sm"></i>
                            </span>
                            @endif
            </nav>
        </div>
        @endif
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {
    // Define routes and CSRF token
    const cartAddUrl = "{{ route('cart.add') }}";
    const cartUpdateUrl = "{{ route('cart.update') }}";
    const cartRemoveUrl = "{{ route('cart.remove') }}";
    const token = "{{ csrf_token() }}";
    const cartCountSpan = document.querySelector('.cart-count');

    // Function to trigger cart animation
    function triggerCartAnimation() {
        cartCountSpan.classList.remove('cart-animation');
        void cartCountSpan.offsetWidth; // Trigger reflow
        cartCountSpan.classList.add('cart-animation');
    }

    // Handle "Add to Cart"
    document.querySelectorAll('.add-to-cart').forEach(btn => {
        btn.addEventListener('click', function(event) {
            if (this.getAttribute('data-loading') === 'true') return;
            
            // stops the click from bubbling to the <a>
            event.stopPropagation(); 
            event.preventDefault();

            const container = this.closest('.product-cart-controls');
            const productId = container.getAttribute('data-product-id');
            const qtyDiv = container.querySelector('.quantity-controls');
            const qtySpan = qtyDiv.querySelector('.qty');
            const addedText = qtyDiv.querySelector('.added-text');
            
            // Set loading state
            this.setAttribute('data-loading', 'true');
            this.innerHTML = `<i class="fas fa-spinner fa-spin mr-2"></i> Adding...`;

            // AJAX request to add item
            fetch(cartAddUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update UI
                    updateCartCount();
                    triggerCartAnimation();
                    
                    qtyDiv.classList.remove('hidden');
                    this.classList.add('hidden');
                    qtySpan.textContent = 1;
                    
                    // Add animation
                    qtyDiv.classList.add('animate-pulse');
                    setTimeout(() => qtyDiv.classList.remove('animate-pulse'), 500);

                    //Notification
                    window.dispatchEvent(new CustomEvent('toast', {
                        detail: {
                            type: data.type, // directly use server's type
                            message: data.toastNotification
                        }
                    }));
                } else {
                    //Notification
                    window.dispatchEvent(new CustomEvent('toast', {
                        detail: {
                            type: 'error',
                            message: data.message,
                        }
                    }));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                //Notification
                window.dispatchEvent(new CustomEvent('toast', {
                    detail: {
                        type: 'error',
                        message: 'An error occurred. Please try again.',
                    }
                }));
            })
            .finally(() => {
                this.setAttribute('data-loading', 'false');
                this.innerHTML = `<i class="fas fa-shopping-cart mr-2 text-sm"></i> Add`;
            });
        });
    });


    // Handle quantity controls
    document.querySelectorAll('.quantity-controls').forEach(div => {
        const qtySpan = div.querySelector('.qty');
        const addedText = div.querySelector('.added-text');
        const increaseBtn = div.querySelector('.increase-qty');
        const decreaseBtn = div.querySelector('.decrease-qty');
        const container = div.closest('.product-cart-controls');
        const productId = container.getAttribute('data-product-id');

        // Handle quantity increase
        increaseBtn.addEventListener('click', (event) => {
            const currentQty = parseInt(qtySpan.textContent);
            const newQuantity = currentQty + 1;
            
            // stops the click from bubbling to the <a>
            event.stopPropagation(); 
            event.preventDefault();

            // Disable buttons during request
            increaseBtn.disabled = true;
            decreaseBtn.disabled = true;
            
            qtySpan.innerHTML = `<i class="fa-solid fa-arrow-rotate-right fa-spin"></i>`;
            updateCartItem(productId, newQuantity, qtySpan);
        });

        // Handle quantity decrease
        decreaseBtn.addEventListener('click', (event) => {
            const currentQty = parseInt(qtySpan.textContent);
            const newQuantity = currentQty - 1;

            // stops the click from bubbling to the <a>
            event.stopPropagation(); 
            event.preventDefault();
            
            // Disable buttons during request
            increaseBtn.disabled = true;
            decreaseBtn.disabled = true;
            
            if (newQuantity <= 0) {
                removeCartItem(productId, container);
            } else {
                qtySpan.innerHTML = `<i class="fa-solid fa-arrow-rotate-right fa-spin"></i>`;
                updateCartItem(productId, newQuantity, qtySpan);
            }
        });
    });

    // Update cart item quantity
    function updateCartItem(productId, quantity, qtySpan) {
        fetch(cartUpdateUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({
                item_id: productId,
                quantity: quantity,
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                //cartCountSpan.textContent = data.cart_total;
                qtySpan.textContent = quantity;

                 //Notification
                window.dispatchEvent(new CustomEvent('toast', {
                    detail: {
                        type: 'success',
                        message: 'Cart Updated.' ,
                    }
                }));
            } else {
                // Save message and refresh
                localStorage.setItem('notification', JSON.stringify({
                    type: 'error',
                    message: data.message
                }));
                location.reload(); // Refresh the page
            }
        })
        .catch(error => {
            console.error('Error:', error);
            //Notification
            window.dispatchEvent(new CustomEvent('toast', {
                detail: {
                    type: 'error',
                    message: 'An error occurred. Please try again.',
                }
            }));
            qtySpan.innerHTML = quantity-1;
        })
        .finally(() => {
            const controls = qtySpan.closest('.quantity-controls');
            controls.querySelector('.increase-qty').disabled = false;
            controls.querySelector('.decrease-qty').disabled = false;
        });
    }

    // Remove item from cart
    function removeCartItem(productId, container) {
        fetch(cartRemoveUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({ item_id: productId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartCount();
                triggerCartAnimation();
                
                // Show Add button, hide controls
                container.querySelector('.add-to-cart').classList.remove('hidden');
                container.querySelector('.quantity-controls').classList.add('hidden');

                //Notification
                window.dispatchEvent(new CustomEvent('toast', {
                    detail: {
                        type: 'success',
                        message: 'Cart Updated' ,
                    }
                }));
            } else {
                //Notification
                window.dispatchEvent(new CustomEvent('toast', {
                    detail: {
                        type: 'error',
                        message: data.message ,
                    }
                }));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            //Notification
            window.dispatchEvent(new CustomEvent('toast', {
                detail: {
                    type: 'error',
                    message: 'An error occurred. Please try again.',
                }
            }));
        })
        .finally(() => {
            const controls = container.querySelector('.quantity-controls');
            controls.querySelector('.increase-qty').disabled = false;
            controls.querySelector('.decrease-qty').disabled = false;
        });
    }

    document.querySelectorAll('.quantity-controls').forEach(div => {});

});
</script>
@endsection