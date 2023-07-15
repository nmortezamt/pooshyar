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
            $table->string('img')->nullable();
            $table->string('title');
            $table->string('link');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->text('body')->nullable();
            $table->text('description')->nullable();
            $table->text('description_seo')->nullable();
            $table->string('time');
            $table->integer('price')->nullable();
            $table->integer('price_major')->nullable();
            $table->string('discount_price')->nullable();
            $table->integer('number')->nullable();
            $table->boolean('status')->nullable();
            $table->boolean('publish')->nullable();
            $table->integer('view')->default(0);
            $table->boolean('shipment')->nullable();
            $table->integer('order_count')->default(0);

            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();

            $table->foreign('subcategory_id')->references('id')->on('subcategories')->cascadeOnDelete();

            $table->softDeletes();
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
