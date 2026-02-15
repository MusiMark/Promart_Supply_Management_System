@extends('layouts.nonav')

@section('title', 'Checkout')

@section('content')
<style>
    /* Smooth show/hide animation for the mobile money phone field */
    #phone-number-form {
        overflow: hidden;
        max-height: 0;
        opacity: 0;
        margin-bottom: 0; /* no space when hidden */
        transition: max-height 0.3s ease, opacity 0.3s ease, margin-bottom 0.3s ease;
    }

    #phone-number-form.show {
        max-height: 200px; /* enough to reveal its contents */
        opacity: 1;
        margin-bottom: 1rem; /* matches Tailwind mb-4 spacing when visible */
    }
</style>
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
<div class="container mx-auto px-4 py-8 max-w-6xl">
    <!-- Page Title and Breadcrumbs -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Secure Checkout</h1>
        <div class="flex items-center text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-[#C13608]">Home</a>
            <span class="mx-2">></span>
            <a href="{{ route('cart') }}" class="hover:text-[#C13608]">Cart</a>
            <span class="mx-2">></span>
            <span class="text-[#C13608]">Checkout</span>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Shipping and Payment Form -->
        <div class="lg:w-2/3">
            <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                @csrf
                
                <!-- Shipping Information -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Shipping Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" id="first_name" name="first_name" value="Mark Musi" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FFC000]">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="email" name="email" value="mark@email.com" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FFC000]">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <input type="tel" id="phone" name="phone" value="1234567890" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FFC000]">
                        </div>
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                            <input type="text" id="address" name="address" value="America Buffalo" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FFC000]">
                        </div>
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                            <input type="text" id="city" name="city" value="New York" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FFC000]">
                        </div>
                        <div>
                            <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State/Province</label>
                            <input type="text" id="state" name="state" value="California" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FFC000]">
                        </div>
                        <div>
                            <label for="zip" class="block text-sm font-medium text-gray-700 mb-1">Zip/Postal Code</label>
                            <input type="text" id="zip" name="zip" value="256" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FFC000]">
                        </div>
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                            <select id="country" name="country" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FFC000]">
                                <option value="">Select Country</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Tanzania">Tanzania</option>
                                <option value="Rwanda" selected>Rwanda</option>
                                <option value="Burundi">Burundi</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Payment Information -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Payment Method</h2>
                    
                    <!-- Payment Method Selection -->
                    <div class="mb-6">
                        <div class="flex items-center mb-4">
                            <input type="radio" id="credit-card" name="payment_method" value="credit_card" class="h-4 w-4 text-[#C13608] focus:ring-[#FFC000]" checked>
                            <label for="credit-card" class="ml-3 block text-sm font-medium text-gray-700">
                                Credit Card
                            </label>
                        </div>
                        <div class="flex items-center mb-4">
                            <input type="radio" id="mobile-money" name="payment_method" value="mobile_money" class="h-4 w-4 text-[#C13608] focus:ring-[#FFC000]">
                            <label for="mobile-money" class="ml-3 block text-sm font-medium text-gray-700">
                                Mobile Money
                            </label>
                        </div>

                        <!-- Mobile Money Form (animated) -->
                        <div id="phone-number-form" class="mb-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2">
                                    <label for="phone-number" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                    <input type="text" id="phone-number" name="phone_number" placeholder="0777777777" value="0777777777"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FFC000]">
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <input type="radio" id="cash-on-delivery" name="payment_method" value="cash_on_delivery" class="h-4 w-4 text-[#C13608] focus:ring-[#FFC000]">
                            <label for="cash-on-delivery" class="ml-3 block text-sm font-medium text-gray-700">
                                Cash on Delivery
                            </label>
                        </div>
                    </div>
                    {{-- Other things to send --}}
                    {{-- Total Amount --}}
                    <input type="text" name="total" class="hidden" value="{{ $total }}">
                    <input type="text" name="id" class="hidden" value="{{ Auth::user()->id }}">
                </div>
            </form>
        </div>
        
        <!-- Order Summary -->
        <div class="lg:w-1/3">
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                <h2 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Order Summary</h2>
                
                                
                <!-- Order Totals -->
                <div class="space-y-4 mb-6">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-medium">UGX {{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Shipping</span>
                        <span class="font-medium text-green-600">Free</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tax (6%)</span>
                        <span class="font-medium">UGX {{ number_format($tax, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Discount</span>
                        <span class="font-medium text-green-600">-UGX {{ number_format($discount, 2) }}</span>
                    </div>
                </div>

                <div class="flex justify-between text-lg font-bold pt-4 border-t border-gray-200 mb-6">
                    <span>Total</span>
                    <span>UGX {{ number_format($total, 2) }}</span>
                </div>

                <button type="submit" form="checkout-form"
                    class="w-full py-4 bg-[#FFC000] hover:bg-[#e6ac00] text-gray-800 font-bold rounded-lg transition-colors flex items-center justify-center">
                    <i class="fas fa-lock mr-2"></i> Place Order
                </button>
            </div>
        </div>
    </div>
    @if ($errors->any())
    <div class="text-red-600 font-bold">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>
@endsection

@section('script')
<script>
    // Toggle payment method fields
    const paymentRadios = document.querySelectorAll('input[name="payment_method"]');
    const phoneNumberForm = document.getElementById('phone-number-form');

    function updatePhoneFormVisibility() {
        const selected = document.querySelector('input[name="payment_method"]:checked');
        if (selected && selected.value === 'mobile_money') {
            phoneNumberForm.classList.add('show');
        } else {
            phoneNumberForm.classList.remove('show');
        }
    }

    paymentRadios.forEach(radio => {
        radio.addEventListener('change', updatePhoneFormVisibility);
    });

    // Initial state on load (handles validation back / pre-filled forms)
    updatePhoneFormVisibility();
    
    // Form validation
    document.getElementById('checkout-form').addEventListener('submit', function(e) {
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
        
        if(paymentMethod === 'mobile_money') {
            const phoneNumber = document.getElementById('phone-number').value;
            
            
            if(phoneNumber || !phoneNumber) {
                e.preventDefault();
                //Notification
                window.dispatchEvent(new CustomEvent('toast', {
                    detail: {
                        type: 'info',
                        message: 'Feature Coming Soon !!',
                    }
                }));
            }
        }
    });
</script>
@endsection