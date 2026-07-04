<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
            $table->string('category', 100)->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('category');
            $table->index('is_active');
            $table->index('order');
        });
    }

    public function down()
    {
        Schema::dropIfExists('galleries');
    }
};