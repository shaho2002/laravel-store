<?php

use App\Enums\categoryStatus;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('e_name');
            $table->string('slug')->unique();
            $table->integer('price');
            $table->integer('discount')->default(0);
            $table->integer('count')->default(0);
            $table->integer('max_sell')->default(0);
            $table->integer('viewed')->default(0);
            $table->integer('sold')->default(0);
            $table->string('image');
            $table->string('description')->nullable();
            $table->string('status')->default(categoryStatus::Active);
            $table->softDeletes();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
