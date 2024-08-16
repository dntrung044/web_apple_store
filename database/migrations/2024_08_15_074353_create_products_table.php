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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->text('product_details')->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('more_images')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('price_sale', 10, 2)->nullable();
            $table->string('offer')->nullable();
            $table->string('availability')->nullable();
            $table->integer('inventory')->default(0);
            $table->decimal('total_rating_star', 2, 1)->default(0);
            $table->integer('total_rating_number')->default(0);
            $table->foreignId('category_id')->constrained('product_categories')->onDelete('cascade');
            $table->string('brand')->nullable();
            $table->string('tag')->nullable();
            $table->string('slug')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
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
