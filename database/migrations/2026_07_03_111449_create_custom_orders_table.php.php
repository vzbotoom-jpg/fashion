<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('custom_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('size_id')->constrained()->onDelete('cascade');
            $table->string('order_number', 50)->unique();
            $table->integer('quantity');
            $table->text('custom_description');
            $table->string('custom_image')->nullable();
            $table->text('shipping_address');
            $table->string('phone', 20);
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'review', 'design', 'production', 'shipped', 'completed', 'cancelled'])->default('pending');
            $table->decimal('price_quote', 15, 2)->nullable();
            $table->text('admin_notes')->nullable();
            $table->date('estimated_completion_date')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('product_id');
            $table->index('size_id');
            $table->index('order_number');
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('custom_orders');
    }
};