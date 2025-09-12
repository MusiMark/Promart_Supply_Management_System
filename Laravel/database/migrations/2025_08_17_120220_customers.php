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
        Schema::create('customers', function (Blueprint $table) {
            $table->char('id',20)->primary();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();

            // Enums
            $table->enum('age_group', ['18-25', '26-35', '36-45', '46-55', '56-65', '65+'])->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->enum('income_bracket', ['low', 'middle-low', 'middle', 'middle-high', 'high', 'prefer-not-to-say'])->nullable();
            $table->enum('purchase_frequency', ['weekly', 'monthly', 'quarterly', 'yearly', 'occasional'])->nullable();

            // shopping_preferences with JSON validation
            $table->longText('shopping_preferences')->nullable();

            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
