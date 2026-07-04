<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('size_id')->constrained()->onDelete('cascade');
            $table->integer('stock')->default(0);
            $table->integer('min_stock')->default(5);
            $table->decimal('price', 15, 2);
            $table->timestamps();
            
            $table->unique(['product_id', 'size_id']);
            $table->index('product_id');
            $table->index('size_id');
            $table->index('stock');
            $table->index('min_stock');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_sizes');
    }
};