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
            $table->string('product_name');
            $table->longText('desctiption');
            $table->string('mark')->nullable();
            $table->decimal('price');
            $table->string('img1');
            $table->string('img2')->nullable();
            $table->string('img3')->nullable();

            $table->unsignedBigInteger('boutique_id');
            $table->foreign('boutique_id')->references('id')->on('butik');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');

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
