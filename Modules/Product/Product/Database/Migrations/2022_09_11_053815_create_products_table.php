<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->text('body')->nullable();
            $table->text('description')->nullable();
            $table->text('description_seo')->nullable();
            $table->integer('price')->nullable();
            $table->integer('price_major')->nullable();
            $table->string('discount_price')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('status')->default(\Modules\Product\Product\Models\Product::INACTIVE_STATUS);
            $table->boolean('is_published')->default(false);
            $table->unsignedBigInteger('view')->default(0);
            $table->string('order_count')->default(0);
            $table->string('img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
