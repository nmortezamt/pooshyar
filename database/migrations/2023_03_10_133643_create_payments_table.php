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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            //address

            $table->string('name');
            $table->string('lname');
            $table->string('state');
            $table->string('city');
            $table->string('address');
            $table->string('address_two')->nullable();
            $table->string('postal_code');
            $table->string('phone');
            $table->string('email');
            $table->string('info')->nullable();
            $table->string('ip')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();


            //product
            $table->string('discount_code')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('discount_percent')->nullable();
            $table->string('order_number')->nullable();
            $table->string('type')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->json('color_id')->nullable();
            $table->json('size_id')->nullable();
            $table->string('product_price')->nullable();
            $table->string('count')->nullable();
            $table->string('total_price')->nullable();
            $table->boolean('status')->default(0);
            $table->string('transactionId')->nullable();
            $table->string('driver')->nullable();


            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();

            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();

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
        Schema::dropIfExists('payments');
    }
};
