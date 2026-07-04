<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('session_id')->nullable();
            $table->decimal('total', 15, 2)->default(0);
            $table->integer('items_count')->default(0);
            $table->timestamps();
            
            $table->unique('user_id');
            $table->index('session_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
};