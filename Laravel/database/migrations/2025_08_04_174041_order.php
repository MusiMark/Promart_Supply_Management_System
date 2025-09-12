<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order', function (Blueprint $table) {
            $table->char('id',20)->primary();
            $table->char('user_id', 20);
            $table->enum('status', ['pending','cancelled','delivered']);
            $table->double('amount');
            $table->timestamp('delivery_date')->nullable();
            $table->enum('payment_method', ['credit_card','mobile_money','cash_on_delivery']);
            $table->string('shipping_address');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('order_details', function (Blueprint $table) {
            $table->string('order_id');
            $table->string('product_id')->constrained()->onDelete('restrict');
            $table->integer('quantity');
            $table->double('price');
            $table->string('notes')->nullable();
            $table->foreign('order_id')->references('id')->on('order')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
        Schema::dropIfExists('order_details');
    }
};
