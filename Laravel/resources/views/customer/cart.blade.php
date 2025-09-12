@extends('layouts.nonav')

@section('title', 'Cart')

@section('content')
<?php 
    // Calculate order summary values
    $subtotal = 0;
    foreach ($cartitems as $item) {
        $subtotal += $item->price * $item->quantity;
    }
    
    $shipping = 0; // Free shipping
    $taxRate = 0.06; // 6% tax
    $tax = $subtotal * $taxRate;
    $discount = 70.00; // Fixed discount
    $total = $subtotal + $tax + $shipping - $discount;
?>
<!-- Cart Page Content -->
<div class="container mx-auto px-4 py-8 max-w-6xl">
    <!-- Page Title and Breadcrumbs -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Your Shopping Cart</h1>
        <div class="flex items-center text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-[#C13608]">Home</a>
            <span class="mx-2">></span>
            <span class="text-[#C13608]">Cart</span>
        </div>
    </div>

    <!-- Cart Content -->
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Cart Items -->
        <div class="lg:w-2/3">
            @if(count($cartitems) > 0)
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <!-- Cart Header -->
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-5 font-medium text-gray-600">Product</div>
                        <div class="col-span-2 font-medium text-gray-600 text-center">Price</div>
                        <div class="col-span-3 font-medium text-gray-600 text-center">Quantity</div>
                        <div class="col-span-2 font-medium text-gray-600 text-right">Subtotal</div>
                    </div>
                </div>

                <!-- Cart Items List -->
                <div class="divide-y divide-gray-100">
                    @foreach($cartitems as $item)
                    <div class="p-6 cart-item">
                        <div class="grid grid-cols-12 gap-4 items-center">
                            <div class="col-span-5 flex items-center">
                                <button class="text-gray-400 hover:text-red-500 mr-4 remove-item">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <a href="/products/{{$item->category_id}}/{{$item->subcategory_id}}/{{$item->id}}"
                                    class="flex items-center">
                                    <img src="{{ $item->image_url ?? 'https://images.unsplash.com/vector-1738237080330-b9d0755ede07?q=80&w=2148&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }}"
                                        alt="{{ $item->product_name }}" class="w-16 h-16 object-cover rounded-lg" />
                                    <div class="ml-4">
                                        <h3 class="font-medium text-gray-800">{{ $item->product_name }}</h3>
                                    </div>
                                </a>
                            </div>
                            <div class="col-span-2 text-center">
                                <span class="font-medium text-gray-800">UGX {{ number_format($item->price, 2) }}</span>
                            </div>
                            <div class="col-span-3 flex justify-center">
                                <div class="flex items-center border border-gray-200 rounded-lg cart-quantity">
                                    <button class="px-3 py-2 text-gray-600 hover:bg-gray-100 decrease-btn"
                                        data-id="{{ $item->id }}" {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                            <i class="fas fa-minus"></i>
                                    </button>
                                    <div class="relative w-12">
                                        <input type="text"
                                            class="w-full text-center border-0 focus:ring-0 quantity-input bg-transparent"
                                            value="{{ $item->quantity }}" data-id="{{ $item->id }}">
                                        <div
                                            class="quantity-loader absolute inset-0 bg-white bg-opacity-80 hidden justify-center items-center">
                                            <i class="fas fa-spinner fa-spin text-[#C13608]"></i>
                                        </div>
                                    </div>
                                    <button class="px-3 py-2 text-gray-600 hover:bg-gray-100 increase-btn"
                                        data-id="{{ $item->id }}">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-span-2 text-right">
                                <span class="font-bold text-gray-800">UGX {{ number_format($item->price *
                                    $item->quantity, 2) }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Cart Footer -->
                <div class="p-6 bg-gray-50 flex justify-between items-center">
                    <div>
                        <a href="{{ route('home') }}" class="flex items-center text-[#C13608] hover:text-[#D24C0E]">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Continue Shopping
                        </a>
                    </div>
                    <div>
                        <button class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg font-medium update-cart">
                            Update Cart
                        </button>
                    </div>
                </div>
            </div>

            <!-- Coupon Section -->
            <div class="mt-6 bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Apply Coupon Code</h3>
                <div class="flex">
                    <input type="text" placeholder="Enter coupon code"
                        class="flex-1 px-4 py-3 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-[#FFC000]">
                    <button
                        class="px-6 bg-[#C13608] text-white font-medium rounded-r-lg hover:bg-[#D24C0E] transition-colors">
                        Apply
                    </button>
                </div>
            </div>
            @else
            <!-- Empty Cart State -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="text-center py-16 px-4">
                    <div class="mx-auto w-24 h-24 flex items-center justify-center bg-gray-100 rounded-full mb-6">
                        <i class="fas fa-shopping-cart text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Your cart is empty</h3>
                    <p class="text-gray-600 max-w-md mx-auto mb-6">
                        Looks like you haven't added anything to your cart yet. Start shopping to fill it with amazing
                        products!
                    </p>
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center px-6 py-3 bg-[var(--primary)] text-gray-900 font-bold rounded-lg hover:bg-[#D24C0E] transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Start Shopping
                    </a>
                </div>
            </div>
            @endif
        </div>

        <!-- Order Summary -->
        <div class="lg:w-1/3">
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Order Summary</h2>

                @if(count($cartitems) > 0)
                <div class="space-y-4 mb-6">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal</span>
                        <span id="subtotal" class="font-medium">UGX {{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Shipping</span>
                        <span class="font-medium text-green-600">Free</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tax (6%)</span>
                        <span id="tax" class="font-medium">UGX {{ number_format($tax, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Discount</span>
                        <span id="discount" class="font-medium text-green-600">-UGX {{ number_format($discount, 2)
                            }}</span>
                    </div>
                </div>

                <div class="flex justify-between text-lg font-bold pt-4 border-t border-gray-200 mb-6">
                    <span>Total</span>
                    <span id="total">UGX {{ number_format($total, 2) }}</span>
                </div>

                <a href="{{ route('checkout') }}"
                    class="w-full py-4 bg-[#FFC000] hover:bg-[#e6ac00] text-gray-800 font-bold rounded-lg transition-colors flex items-center justify-center">
                    <i class="fas fa-lock mr-2"></i> Proceed to Checkout
                </a>
                @else
                <div class="space-y-4 mb-6">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-medium">UGX 0.00</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Shipping</span>
                        <span class="font-medium text-green-600">Free</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tax (6%)</span>
                        <span class="font-medium">UGX 0.00</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Discount</span>
                        <span class="font-medium text-green-600">-UGX 0.00</span>
                    </div>
                </div>

                <div class="flex justify-between text-lg font-bold pt-4 border-t border-gray-200 mb-6">
                    <span>Total</span>
                    <span>UGX 0.00</span>
                </div>

                <button
                    class="w-full py-4 bg-gray-300 text-gray-500 font-bold rounded-lg cursor-not-allowed flex items-center justify-center"
                    disabled>
                    <i class="fas fa-lock mr-2"></i> Proceed to Checkout
                </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Recently Viewed -->
    <div class="mt-16">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Recently Viewed</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <!-- Product 1 -->
            <div class="bg-white rounded-lg shadow-sm p-4 hover:shadow-md transition-shadow">
                <img src="https://images.unsplash.com/photo-1560769629-975ec94e6a86?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80"
                    alt="Sneakers" class="w-full h-40 object-contain mb-4">
                <h3 class="font-medium text-gray-800 mb-1">Running Shoes</h3>
                <div class="flex justify-between items-center">
                    <span class="font-bold text-[#C13608]">$129.99</span>
                    <button
                        class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-[#FFC000]">
                        <i class="fas fa-shopping-cart text-sm"></i>
                    </button>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="bg-white rounded-lg shadow-sm p-4 hover:shadow-md transition-shadow">
                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80"
                    alt="Backpack" class="w-full h-40 object-contain mb-4">
                <h3 class="font-medium text-gray-800 mb-1">Travel Backpack</h3>
                <div class="flex justify-between items-center">
                    <span class="font-bold text-[#C13608]">$79.99</span>
                    <button
                        class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-[#FFC000]">
                        <i class="fas fa-shopping-cart text-sm"></i>
                    </button>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="bg-white rounded-lg shadow-sm p-4 hover:shadow-md transition-shadow">
                <img src="https://images.unsplash.com/photo-1585155770447-2f66e2a397b5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80"
                    alt="Speaker" class="w-full h-40 object-contain mb-4">
                <h3 class="font-medium text-gray-800 mb-1">Bluetooth Speaker</h3>
                <div class="flex justify-between items-center">
                    <span class="font-bold text-[#C13608]">$89.99</span>
                    <button
                        class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-[#FFC000]">
                        <i class="fas fa-shopping-cart text-sm"></i>
                    </button>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="bg-white rounded-lg shadow-sm p-4 hover:shadow-md transition-shadow">
                <img src="https://images.unsplash.com/photo-1595341888016-a392ef81b7de?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80"
                    alt="Watch" class="w-full h-40 object-contain mb-4">
                <h3 class="font-medium text-gray-800 mb-1">Analog Watch</h3>
                <div class="flex justify-between items-center">
                    <span class="font-bold text-[#C13608]">$299.99</span>
                    <button
                        class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-[#FFC000]">
                        <i class="fas fa-shopping-cart text-sm"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // Cart quantity adjustment
    document.querySelectorAll('.decrease-btn, .increase-btn').forEach(button => {
        button.addEventListener('click', function() {
            const container = this.closest('.cart-quantity');
            const input = container.querySelector('.quantity-input');
            const loader = container.querySelector('.quantity-loader');
            const itemId = input.dataset.id;
            let value = parseInt(input.value);
            let newValue;
            
            event.stopPropagation();
            
            // Show loader
            loader.classList.remove('hidden');
            
            if (this.classList.contains('decrease-btn')) {
                newValue = value - 1;
            } else {
                newValue = value + 1;
            }
            
            // Update immediately for better UX
            input.value = newValue;
            
            // Send update request
            updateCartItem(itemId, newValue, loader);
        });
    });
    
    // Update cart item quantity
    function updateCartItem(itemId, quantity, loader) {
        fetch('{{ route('cart.update') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                item_id: itemId,
                quantity: quantity,
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update order summary
                updateOrderSummary();
                
                // Update button states
                const decreaseBtn = document.querySelector(`.decrease-btn[data-id="${itemId}"]`);
                if (decreaseBtn) {
                    decreaseBtn.disabled = quantity <= 1;
                }
                
                // Notification
                window.dispatchEvent(new CustomEvent('toast', {
                    detail: {
                        type: 'success',
                        message: 'Cart Updated',
                    }
                }));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Notification
            window.dispatchEvent(new CustomEvent('toast', {
                detail: {
                    type: 'error',
                    message: 'An error occurred. Please try again.',
                }
            }));
        })
        .finally(() => {
            // Hide loader after 300ms to prevent flickering
            setTimeout(() => loader.classList.add('hidden'), 300);
        });
    }

    // Function to trigger cart animation
    const cartCountSpan = document.querySelector('.cart-count');
    function triggerCartAnimation() {
        cartCountSpan.classList.remove('cart-animation');
        void cartCountSpan.offsetWidth; // Trigger reflow
        cartCountSpan.classList.add('cart-animation');
    }
    
    // Remove item from cart
    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', function() {
            const itemElement = this.closest('.cart-item');
            const itemId = itemElement.querySelector('.quantity-input').dataset.id;

            event.stopPropagation();
            event.preventDefault();

            const originalContent = this.innerHTML;
            this.innerHTML = `<i class="fas fa-spinner fa-spin"></i>`;
            this.disabled = true;
            
            fetch('{{ route('cart.remove') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    item_id: itemId,
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove element with animation
                    itemElement.style.opacity = '0';
                    setTimeout(() => {
                        itemElement.remove();
                        updateOrderSummary();
                    }, 300);
                    
                    // Trigger cart animation and update count
                    updateCartCount();
                    triggerCartAnimation();

                    // Notification
                    window.dispatchEvent(new CustomEvent('toast', {
                        detail: {
                            type: 'success',
                            message: 'Cart Updated',
                        }
                    }));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Restore button on error
                this.innerHTML = originalContent;
                this.disabled = false;
                
                // Notification
                window.dispatchEvent(new CustomEvent('toast', {
                    detail: {
                        type: 'error',
                        message: 'An error occurred. Please try again.',
                    }
                }));
            });
        });
    });
    
    
    // Calculate and update order summary
    function updateOrderSummary() {
        let subtotal = 0;
        
        // Calculate new subtotal
        document.querySelectorAll('.cart-item').forEach(item => {
            const priceText = item.querySelector('.col-span-2.text-center span').textContent;
            const cleanedPriceText = priceText.replace('UGX ', '').replace(/,/g, '');
            const price = parseFloat(cleanedPriceText);
            const quantity = parseInt(item.querySelector('.quantity-input').value);
            const itemTotal = price * quantity;
            
            subtotal += itemTotal;
        });
        
        // Update summary values
        const taxRate = 0.06;
        const tax = subtotal * taxRate;
        const discount = 70.00;
        const total = subtotal + tax - discount;
        
        document.getElementById('subtotal').textContent = 'UGX ' + subtotal.toLocaleString('en-UG', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        document.getElementById('tax').textContent = 'UGX ' + tax.toLocaleString('en-UG', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        document.getElementById('discount').textContent = '-UGX ' + discount.toLocaleString('en-UG', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        document.getElementById('total').textContent = 'UGX ' + total.toLocaleString('en-UG', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }
</script>
@endsection