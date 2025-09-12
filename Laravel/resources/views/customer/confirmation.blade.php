<!-- resources/views/order_confirmation.blade.php -->
@extends('layouts.nonav')

@section('title', 'Order Confirmation')

@section('content')
<div class="container mx-auto px-4 py-12 max-w-3xl text-center">
    <div class="bg-white rounded-xl shadow-md p-8">
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-check text-3xl text-green-600"></i>
        </div>
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Order Confirmed!</h1>
        <p class="text-gray-600 mb-2">Your order 1234567890 has been placed successfully.</p>
        <p class="text-gray-600 mb-8">We've sent a confirmation email to 213456@5rewdtygfhu</p>
        
        <div class="bg-gray-50 rounded-lg p-6 mb-8 text-left">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Order Summary</h2>
            <!-- Display order summary similar to checkout -->
        </div>
        
        <div class="flex justify-center gap-4">
            <a href="{{ route('home') }}" 
               class="px-6 py-3 bg-[#C13608] text-white rounded-lg hover:bg-[#D24C0E] transition-colors">
                Continue Shopping
            </a>
            <a href="#" 
               class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors">
                View Order Details
            </a>
        </div>
    </div>
</div>
@endsection