<?php

use App\Enums\OrderDetailsStatus;
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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->unsignedBigInteger('warranty_id')->nullable;
            $table->unsignedBigInteger('color_id')->nullable;
            $table->integer('main_price');
            $table->integer('final_price');
            $table->integer('discount');
            $table->integer('count');
            $table->string('status')->default(OrderDetailsStatus::InProgress->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_detials');
    }
};
