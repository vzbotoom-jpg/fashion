<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('size_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price', 15, 2);
            $table->timestamps();
            
            $table->index('cart_id');
            $table->index('product_id');
            $table->index('size_id');
            $table->unique(['cart_id', 'product_id', 'size_id'], 'cart_item_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
};