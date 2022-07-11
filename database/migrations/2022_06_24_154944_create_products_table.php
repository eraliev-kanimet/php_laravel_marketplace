<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name')->unique();
            $table->string('image');
        });

        Schema::create('manufacturers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('image');
        });

        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('color')->unique();
        });

        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->json('description');
        });

        Schema::create('delivery', function (Blueprint $table) {
            $table->id();
            $table->boolean('free')->default(true);
            $table->boolean('fitting')->default(false);
            $table->integer('return');
        });

        Schema::create('product_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->json('properties');
            $table->foreignId('category_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('manufacturer_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('delivery_id')->constrained('delivery')->cascadeOnUpdate()->cascadeOnDelete();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('product_templates')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('size_id')->nullable()->constrained('sizes')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('color_id')->nullable()->constrained('colors')->cascadeOnUpdate()->cascadeOnDelete();
            $table->json('images');
            $table->boolean('status');
            $table->float('price');
            $table->integer('delivery');
            $table->integer('discount');
            $table->integer('stock');
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('manufacturers');
        Schema::dropIfExists('colors');
        Schema::dropIfExists('sizes');
        Schema::dropIfExists('delivery');
        Schema::dropIfExists('product_templates');
        Schema::dropIfExists('products');
    }
};