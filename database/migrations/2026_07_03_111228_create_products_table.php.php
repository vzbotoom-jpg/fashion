<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('slug', 200)->unique();
            $table->string('sku', 50)->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 15, 2);
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('collection_id')->nullable()->constrained('collections')->onDelete('set null');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('meta_title', 200)->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords', 200)->nullable();
            $table->timestamps();
            
            $table->index('slug');
            $table->index('sku');
            $table->index('category_id');
            $table->index('collection_id');
            $table->index('is_featured');
            $table->index('is_active');
            $table->index('price');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};