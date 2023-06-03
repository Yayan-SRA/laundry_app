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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->foreignId('store_id');
            $table->string('staff_name');
            $table->foreignId('customer_id');
            $table->string('type');
            $table->string('product');
            $table->string('service');
            $table->string('duration');
            $table->integer('price');
            $table->float('quantity');
            $table->string('unit');
            $table->integer('total_price');
            $table->date('target_date_complete');
            $table->date('date_complete')->nullable();
            $table->boolean('cod')->default(false);
            $table->text('note')->nullable();
            $table->boolean('is_done')->default(false);
            $table->boolean('is_paid')->default(false);
            $table->timestamps();

            // $table->id();
            // $table->string('key');
            // $table->foreignId('store_id');
            // $table->foreignId('user_id');
            // $table->foreignId('customer_id');
            // $table->foreignId('type_id');
            // $table->foreignId('product_id');
            // $table->foreignId('service_id');
            // $table->foreignId('duration_id');
            // $table->integer('price');
            // $table->float('quantity');
            // $table->foreignId('unit_id');
            // $table->integer('total_price');
            // $table->date('date_complete');
            // $table->boolean('cod')->default(false);
            // $table->text('note')->nullable();
            // $table->boolean('is_done')->default(false);
            // $table->boolean('is_paid')->default(false);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
