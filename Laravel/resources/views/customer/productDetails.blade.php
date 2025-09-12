@extends('layouts.nonav')

@section('title', $product->product_name)

@section('content')

<?php
// $productDetails = [
//     [
//         "id" => 1,
//         "product_name" => "Dell Inspiron 15",
//         "description" => "15.6-inch FHD Laptop, i5, 8GB RAM",
//         "long_description" => "The Dell Inspiron 15 redefines mobile computing with its powerful performance and sleek design. Engineered for productivity and entertainment, this device combines power, efficiency, and reliability in one sleek package.",
//         "price" => 3500000.0,
//         "original_price" => 3990000.0,
//         "discount" => 490000.0,
//         "image_url" => "https://images.unsplash.com/photo-1593642702821-c8da6771f0c6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80",
//         "ratings" => 3.0,
//         "previews" => 477,
//         "stock" => 12,
//         "features" => [
//             "15.6-inch Full HD display",
//             "Intel Core i5 processor",
//             "8GB DDR4 RAM",
//             "256GB SSD storage",
//             "Windows 11 Home",
//             "Backlit keyboard",
//             "10-hour battery life"
//         ],
//         "specifications" => [
//             "Processor" => "Intel Core i5-1135G7",
//             "RAM" => "8GB DDR4",
//             "Storage" => "256GB SSD",
//             "Display" => "15.6\" FHD (1920x1080) Anti-Glare",
//             "Graphics" => "Intel Iris Xe Graphics",
//             "Battery" => "3-Cell, 41WHr, Integrated",
//             "Weight" => "1.83 kg"
//         ]
//     ]
// ];
// $product = $productDetails[0];
?>

<!-- Single Product Page Content -->
<div class="container mx-auto px-4 py-8 max-w-6xl">
    <!-- Breadcrumbs -->
    <div class="mb-6">
        <div class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-[#C13608] inline-flex items-center">
                        <i class="fas fa-home mr-2"></i>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <a href="/products/{{ $category }}" class="text-gray-600 hover:text-[#C13608] ml-1 md:ml-2">{{ $category }}</a>
                    </div>
                </li>
                @if($category == $sub_category)
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="text-[#C13608] font-medium ml-1 md:ml-2">{{ $product->product_name }}</span>
                    </div>
                </li>
                @else
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <a href="/products/{{ $category }}/{{ $sub_category }}" class="text-gray-600 hover:text-[#C13608] ml-1 md:ml-2">{{ $sub_category }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="text-[#C13608] font-medium ml-1 md:ml-2">{{ $product->product_name }}</span>
                    </div>
                </li>
                @endif
            </ol>
        </div>
    </div>

    <!-- Product Section -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
            <!-- Product Gallery -->
            <div class="lg:pr-8">
                <div class="gallery-main rounded-xl overflow-hidden mb-4">
                    <img id="mainImage" src="{{ $product->image_url ?? 'https://images.unsplash.com/vector-1738237080330-b9d0755ede07?q=80&w=2148&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }}" alt="{{ $product->product_name }}" class="w-full h-auto rounded-xl" />
                </div>
                <div class="grid grid-cols-4 gap-3">
                    @for($i = 0; $i < 2; $i++)
                    <div class="gallery-thumb rounded-lg overflow-hidden {{ $i == 0 ? 'active' : '' }}" onclick="changeImage('{{ $product->image_url }}')">
                        <img src="{{ $product->image_url ?? 'https://images.unsplash.com/vector-1738237080330-b9d0755ede07?q=80&w=2148&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }}" alt="Thumbnail {{ $i+1 }}" class="w-full h-24 object-cover" />
                    </div>
                    @endfor
                </div>
            </div>

            <!-- Product Info -->
            <div>
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $product->product_name }}</h1>
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400 mr-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($product->ratings))
                                        <i class="fas fa-star"></i>
                                    @elseif($i == ceil($product->ratings) && ($product->ratings - floor($product->ratings)) > 0)
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-gray-600">({{ $product->previews }} Reviews)</span>
                            <span class="mx-3 text-gray-300">|</span>
                            <span class="text-green-600 font-medium">
                                <i class="fas fa-check-circle mr-1"></i> In Stock
                            </span>
                        </div>
                    </div>
                    <button class="text-gray-400 hover:text-[#C13608]">
                        <i class="far fa-heart text-2xl"></i>
                    </button>
                </div>

                <div class="mb-6">
                    <div class="flex items-center mb-3">
                        <span class="text-2xl font-bold text-[#C13608] mr-4">UGX {{ number_format($product->price, 1) }}</span>
                        {{-- @if($product->original_price > $product->price)
                            <span class="text-lg text-gray-500 line-through">UGX {{ number_format($product->original_price, 0, ',', '.') }}</span>
                            <span class="ml-4 px-2 py-1 bg-red-100 text-red-800 text-sm font-bold rounded">Save Rp {{ number_format($product->discount, 0, ',', '.') }}</span>
                        @endif --}}
                    </div>
                    <p class="text-gray-600 mb-4">{{ $product->description }}</p>
                </div>

                {{-- <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Color Options</h3>
                    <div class="flex space-x-3">
                        <div class="color-option w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center cursor-pointer hover:border-[#C13608] active-color" data-color="black" style="background-color: #1e293b;">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <div class="color-option w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center cursor-pointer hover:border-[#C13608]" data-color="silver" style="background-color: #e2e8f0;">
                            <i class="fas fa-check text-gray-800 text-xs hidden"></i>
                        </div>
                        <div class="color-option w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center cursor-pointer hover:border-[#C13608]" data-color="blue" style="background-color: #1d4ed8;">
                            <i class="fas fa-check text-white text-xs hidden"></i>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Storage Capacity</h3>
                    <div class="flex space-x-3">
                        <button class="storage-option px-4 py-2 border-2 border-gray-300 rounded-lg hover:border-[#C13608] bg-[#FFC000] border-[#C13608] text-[#C13608]" data-storage="256">256GB SSD</button>
                        <button class="storage-option px-4 py-2 border-2 border-gray-300 rounded-lg hover:border-[#C13608]" data-storage="512">512GB SSD</button>
                        <button class="storage-option px-4 py-2 border-2 border-gray-300 rounded-lg hover:border-[#C13608]" data-storage="1024">1TB SSD</button>
                    </div>
                </div> --}}

                <div class="mb-8">
                    <div class="text-gray-600">
                        Only <span class="font-bold text-[#C13608]">{{ $product->stock_quatity }} items</span> left!
                    </div>
                </div>

                <div class="product-cart-controls flex flex-wrap gap-3" data-product-id="{{ $product->id }}">
                     @if (session()->has('cart') && isset(session('cart')[$product->id]))
                     <!-- Add to Cart Button (initially hidden) -->
                    <button class="add-to-cart flex-1 min-w-[200px] py-4 hidden bg-[#FFC000] hover:bg-[#e6ac00] text-gray-800 font-bold rounded-lg transition-colors flex items-center justify-center">
                        <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                    </button>
                    
                    <!-- Quantity Controls (initially visible) -->
                    <div class="added-quantity flex-1 min-w-[200px]">
                        <div class="flex items-center justify-center h-full">
                            <div class="flex items-center border border-gray-300 rounded-lg bg-white">
                                <button class="quantity-minus px-4 py-3 text-gray-600 hover:bg-gray-100 relative">
                                    <i class="fas fa-minus"></i>
                                    <span class="quantity-loader hidden absolute inset-0 flex items-center justify-center bg-white">
                                        <i class="fas fa-spinner fa-spin text-[#C13608]"></i>
                                    </span>
                                </button>
                                <input type="text" class="quantity-value w-12 text-center border-0 focus:ring-0 text-lg outline-none" value="{{ session('cart')[$product->id]['quantity'] }}" readonly>
                                <button class="quantity-plus px-4 py-3 text-gray-600 hover:bg-gray-100 relative">
                                    <i class="fas fa-plus"></i>
                                    <span class="quantity-loader hidden absolute inset-0 flex items-center justify-center bg-white">
                                        <i class="fas fa-spinner fa-spin text-[#C13608]"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <button class="flex-1 min-w-[200px] py-4 bg-[#C13608] hover:bg-[#D24C0E] text-white font-bold rounded-lg transition-colors">
                        Buy Now
                    </button>
                     @else
                     
                    <!-- Add to Cart Button (initially visible) -->
                    <button class="add-to-cart flex-1 min-w-[200px] py-4 bg-[#FFC000] hover:bg-[#e6ac00] text-gray-800 font-bold rounded-lg transition-colors flex items-center justify-center">
                        <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                    </button>
                    
                    <!-- Quantity Controls (initially hidden) -->
                    <div class="added-quantity hidden flex-1 min-w-[200px]">
                        <div class="flex items-center justify-center h-full">
                            <div class="flex items-center border border-gray-300 rounded-lg bg-white">
                                <button class="quantity-minus px-4 py-3 text-gray-600 hover:bg-gray-100 relative">
                                    <i class="fas fa-minus"></i>
                                    <span class="quantity-loader hidden absolute inset-0 flex items-center justify-center bg-white">
                                        <i class="fas fa-spinner fa-spin text-[#C13608]"></i>
                                    </span>
                                </button>
                                <input type="text" class="quantity-value w-12 text-center border-0 focus:ring-0 text-lg outline-none" value="1" readonly>
                                <button class="quantity-plus px-4 py-3 text-gray-600 hover:bg-gray-100 relative">
                                    <i class="fas fa-plus"></i>
                                    <span class="quantity-loader hidden absolute inset-0 flex items-center justify-center bg-white">
                                        <i class="fas fa-spinner fa-spin text-[#C13608]"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <button class="flex-1 min-w-[200px] py-4 bg-[#C13608] hover:bg-[#D24C0E] text-white font-bold rounded-lg transition-colors">
                        Buy Now
                    </button>
                    @endif 
                </div>

                <!-- Product Highlights -->
                {{-- <div class="mt-8 pt-6 border-t border-gray-200">
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                            <span class="text-gray-600">2-year manufacturer warranty</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                            <span class="text-gray-600">Free shipping & returns</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                            <span class="text-gray-600">Compatible with all major accessories</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                            <span class="text-gray-600">Includes charger and documentation</span>
                        </li>
                    </ul>
                </div> --}}
            </div>
        </div>

        <!-- Product Details Tabs -->
        <div class="border-t border-gray-200 mt-4">
            <div class="flex border-b border-gray-200">
                <button class="tab-btn active py-4 px-6 font-medium text-gray-800 border-b-2 border-[#C13608]" data-tab="description">Description</button>
                <button class="tab-btn py-4 px-6 font-medium text-gray-600 hover:text-gray-800" data-tab="specifications">Specifications</button>
                <button class="tab-btn py-4 px-6 font-medium text-gray-600 hover:text-gray-800" data-tab="reviews">Reviews ({{ $product->previews}})</button>
            </div>

            <div class="p-8">
                <!-- Description Tab -->
                <div id="descriptionTab" class="tab-content active">
                    {{-- <h2 class="text-2xl font-bold text-gray-800 mb-4">About this item</h2>
                    <div class="prose max-w-none text-gray-600">
                        <p>{{ $product['long_description'] }}</p>
                        
                        <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">Key Features</h3>
                        <ul class="list-disc pl-5 space-y-2">
                            @foreach($product['features'] as $feature)
                            <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                            <div class="bg-[#f8f9fa] rounded-xl p-6">
                                <div class="flex items-start mb-3">
                                    <div class="text-[#C13608] mr-3 mt-1">
                                        <i class="fas fa-shipping-fast text-2xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-800 mb-1">Free Shipping & Returns</h4>
                                        <p class="text-gray-600">Free standard shipping on all orders. 30-day return policy.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-[#f8f9fa] rounded-xl p-6">
                                <div class="flex items-start mb-3">
                                    <div class="text-[#C13608] mr-3 mt-1">
                                        <i class="fas fa-shield-alt text-2xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-800 mb-1">2-Year Warranty</h4>
                                        <p class="text-gray-600">Comprehensive coverage for manufacturer defects.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Description Tab coming soon</h2>
                </div>
                
                <!-- Specifications Tab -->
                <div id="specificationsTab" class="tab-content hidden">
                    {{-- <h2 class="text-2xl font-bold text-gray-800 mb-4">Technical Specifications</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($product['specifications'] as $key => $value)
                        <div class="border-b pb-2">
                            <span class="font-semibold text-gray-700">{{ $key }}:</span>
                            <span class="text-gray-600 ml-2">{{ $value }}</span>
                        </div>
                        @endforeach
                    </div> --}}
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Specifications Tab coming soon</h2>
                </div>
                
                <!-- Reviews Tab -->
                <div id="reviewsTab" class="tab-content hidden">
                    {{-- <h2 class="text-2xl font-bold text-gray-800 mb-4">Customer Reviews</h2>
                    <div class="space-y-6">
                        <div class="border-b pb-6">
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400 mr-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="font-semibold">Excellent product!</span>
                            </div>
                            <p class="text-gray-600 mb-2">By John D. on August 12, 2025</p>
                            <p class="text-gray-700">This laptop exceeded all my expectations. The performance is phenomenal and battery lasts all day!</p>
                        </div>
                    </div> --}}
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Reviews Tab coming soon</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="mt-16">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">You May Also Like</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Product 1 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" alt="Smart Watch" class="w-full h-56 object-cover">
                    <div class="absolute top-2 left-2 flex">
                        <div class="bg-[#C13608] text-white text-xs font-bold px-2 py-1 rounded-full mr-1">BEST SELLER</div>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Smart Watch Series 5</h3>
                    <p class="text-gray-600 text-sm mb-3">Health Monitor, GPS, Waterproof</p>
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold text-[#C13608]">$249.99</span>
                        <button class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-[#FFC000]">
                            <i class="fas fa-shopping-cart text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Product 2 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" alt="Headphones" class="w-full h-56 object-cover">
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Wireless Headphones Pro</h3>
                    <p class="text-gray-600 text-sm mb-3">Noise Cancelling, 30h Battery</p>
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-lg font-bold text-[#C13608]">$179.99</span>
                            <span class="text-sm text-gray-500 line-through ml-2">$199.99</span>
                        </div>
                        <button class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-[#FFC000]">
                            <i class="fas fa-shopping-cart text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Product 3 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1585155770447-2f66e2a397b5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" alt="Speaker" class="w-full h-56 object-cover">
                    <div class="absolute top-2 left-2 flex">
                        <div class="bg-[#FFC000] text-gray-800 text-xs font-bold px-2 py-1 rounded-full mr-1">-20%</div>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Bluetooth Speaker</h3>
                    <p class="text-gray-600 text-sm mb-3">360° Sound, 15h Battery, Waterproof</p>
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-lg font-bold text-[#C13608]">$89.99</span>
                            <span class="text-sm text-gray-500 line-through ml-2">$109.99</span>
                        </div>
                        <button class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-[#FFC000]">
                            <i class="fas fa-shopping-cart text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Product 4 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1595941069915-4ebc5197c14a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" alt="Wireless Charger" class="w-full h-56 object-cover">
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Fast Wireless Charger</h3>
                    <p class="text-gray-600 text-sm mb-3">15W Fast Charging, Multi-Device</p>
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold text-[#C13608]">$49.99</span>
                        <button class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-[#FFC000]">
                            <i class="fas fa-shopping-cart text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // CSRF Token Setup
    const token = "{{ csrf_token() }}";
    const cartAddUrl = "{{ route('cart.add') }}"; 
    const cartUpdateUrl = "{{ route('cart.update') }}";
    const cartRemoveUrl = "{{ route('cart.remove') }}";
    const cartCountSpan = document.querySelector('.cart-count');

    // Product Gallery
    function changeImage(src) {
        document.getElementById('mainImage').src = src;
        
        // Update active thumbnail
        document.querySelectorAll('.gallery-thumb').forEach(thumb => {
            thumb.classList.remove('active');
        });
        event.currentTarget.classList.add('active');
    }

    // Function to trigger cart animation
    function triggerCartAnimation() {
        cartCountSpan.classList.remove('cart-animation');
        void cartCountSpan.offsetWidth; // Trigger reflow
        cartCountSpan.classList.add('cart-animation');
    }
    
    // // Color selection
    // document.querySelectorAll('.color-option').forEach(option => {
    //     option.addEventListener('click', function() {
    //         // Remove active class from all options
    //         document.querySelectorAll('.color-option').forEach(opt => {
    //             opt.classList.remove('active-color');
    //             opt.querySelector('i').classList.add('hidden');
    //         });
            
    //         // Add active class to clicked option
    //         this.classList.add('active-color');
    //         this.querySelector('i').classList.remove('hidden');
    //     });
    // });
    
    // // Storage selection
    // document.querySelectorAll('.storage-option').forEach(option => {
    //     option.addEventListener('click', function() {
    //         // Remove active styling from all options
    //         document.querySelectorAll('.storage-option').forEach(opt => {
    //             opt.classList.remove('bg-[#FFC000]', 'border-[#C13608]', 'text-[#C13608]');
    //         });
            
    //         // Add active styling to clicked option
    //         this.classList.add('bg-[#FFC000]', 'border-[#C13608]', 'text-[#C13608]');
    //     });
    // });
    
    // Tab switching
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');
            
            // Update tab buttons
            document.querySelectorAll('.tab-btn').forEach(b => {
                b.classList.remove('active', 'text-gray-800', 'border-b-2', 'border-[#C13608]');
                b.classList.add('text-gray-600');
            });
            this.classList.add('active', 'text-gray-800', 'border-b-2', 'border-[#C13608]');
            
            // Show selected tab content
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('active');
            });
            document.getElementById(tabId + 'Tab').classList.remove('hidden');
            document.getElementById(tabId + 'Tab').classList.add('active');
        });
    });
    
    // Show loading spinner on a button
    function showButtonLoader(button) {
        const loader = button.querySelector('.quantity-loader');
        if (loader) {
            loader.classList.remove('hidden');
            button.disabled = true;
        }
    }
    
    // Hide loading spinner on a button
    function hideButtonLoader(button) {
        const loader = button.querySelector('.quantity-loader');
        if (loader) {
            loader.classList.add('hidden');
            button.disabled = false;
        }
    }
    
    // Update cart quantity in the UI
    function updateCartQuantity(quantity) {
        const quantityValue = document.querySelector('.quantity-value');
        if (quantityValue) {
            quantityValue.value = quantity;
        }
    }
    
    // Add to Cart functionality
    document.querySelectorAll('.add-to-cart').forEach(btn => {
        btn.addEventListener('click', function() {
            if (this.getAttribute('data-loading') === 'true') return;
            
            const container = this.closest('.product-cart-controls');
            const productId = container.getAttribute('data-product-id');
            const quantity = 1; 

            
            // Get selected options
            //const color = document.querySelector('.color-option.active-color').getAttribute('data-color');
            // const storage = document.querySelector('.storage-option.bg-[#FFC000]').getAttribute('data-storage');
            
            // Set loading state
            this.setAttribute('data-loading', 'true');
            const originalHtml = this.innerHTML;
            this.innerHTML = `<i class="fas fa-spinner fa-spin mr-2"></i> Adding...`;
            this.disabled = true;

            // AJAX request to add item
            fetch(cartAddUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity,
                    //color: color,
                    // storage: storage
                })
            })
            .then(response => response.json())
            .then(data => {                
                if (data.success) {
                    // Hide "Add to Cart" button
                    this.classList.add('hidden');
                    
                    // Show quantity controls
                    const quantityControls = container.querySelector('.added-quantity');
                    if (quantityControls) {
                        quantityControls.classList.remove('hidden');
                    }
                    
                    updateCartCount();
                    triggerCartAnimation();

                    //Notification
                    window.dispatchEvent(new CustomEvent('toast', {
                        detail: {
                            type: 'success',
                            message: 'Product Added!!!',
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
                
                // Reset button state
                this.innerHTML = originalHtml;
                this.removeAttribute('data-loading');
                this.disabled = false;
            })
            .catch(error => {
                console.error('Error:', error);
                //Notification
                    window.dispatchEvent(new CustomEvent('toast', {
                        detail: {
                            type: 'error',
                            message: 'An error has occurred',
                        }
                    }));

                this.innerHTML = originalHtml;
                this.removeAttribute('data-loading');
                this.disabled = false;
            });
        });
    });
    
    // Quantity increase functionality
    document.addEventListener('click', function(e) {
        if (e.target.closest('.quantity-plus')) {
            const button = e.target.closest('.quantity-plus');
            const container = button.closest('.product-cart-controls');
            const productId = container.getAttribute('data-product-id');
            const quantityInput = button.parentElement.querySelector('.quantity-value');
            let quantity = parseInt(quantityInput.value);
            const max = {{ $product->stock_quatity }};
            
            if (quantity < max) {
                quantity++;
                showButtonLoader(button);
                
                // Update cart item quantity
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
                        updateCartQuantity(quantity);

                        //Notification
                        window.dispatchEvent(new CustomEvent('toast', {
                            detail: {
                                type: 'success',
                                message: 'Cart Updated.' ,
                            }
                        }));

                        hideButtonLoader(button);
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
                    quantityInput.innerHTML = quantity-1;
                });
            }
        }
        
        if (e.target.closest('.quantity-minus')) {
            const button = e.target.closest('.quantity-minus');
            const container = button.closest('.product-cart-controls');
            const productId = container.getAttribute('data-product-id');
            const quantityInput = button.parentElement.querySelector('.quantity-value');
            let quantity = parseInt(quantityInput.value);
            
            if (quantity > 1) {
                quantity--;
                showButtonLoader(button);
                
                // Update cart item quantity
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
                        updateCartQuantity(quantity);

                        //Notification
                        window.dispatchEvent(new CustomEvent('toast', {
                            detail: {
                                type: 'success',
                                message: 'Cart Updated.' ,
                            }
                        }));
                        
                        hideButtonLoader(button);
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
                    quantityInput.innerHTML = quantity+1;
                });
            }else {
                quantity--;
                showButtonLoader(button);
                
                // Update cart item quantity
                fetch(cartRemoveUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        item_id: productId,
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show "Add to Cart" button
                        document.querySelector('.add-to-cart').classList.remove('hidden');
                    
                        // Hide quantity controls
                        const quantityControls = container.querySelector('.added-quantity');
                        if (quantityControls) {
                            quantityControls.classList.add('hidden');
                        }
                    
                        updateCartCount();
                        triggerCartAnimation();

                        //Notification
                        window.dispatchEvent(new CustomEvent('toast', {
                            detail: {
                                type: 'success',
                                message: 'Cart Updated.' ,
                            }
                        }));
                        
                        hideButtonLoader(button);
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
                    quantityInput.innerHTML = quantity-1;
                });
            }
        }
    });
</script>
@endsection