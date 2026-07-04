<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->morphs('payable');
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->string('payment_method');
            $table->string('payment_channel')->nullable();
            $table->string('transaction_id', 100)->nullable();
            $table->string('payment_code', 50)->unique()->nullable();
            $table->enum('status', ['pending', 'completed', 'failed', 'cancelled', 'refunded'])->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->string('payment_proof')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Hanya buat index jika belum ada
            // Hapus atau komentari baris ini jika index sudah dibuat oleh morphs()
            // $table->index(['payable_type', 'payable_id']);
            
            $table->index('order_id');
            $table->index('payment_code');
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};