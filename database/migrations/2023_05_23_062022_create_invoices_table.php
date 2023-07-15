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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->nullable();
            $table->string('name_product')->nullable();
            $table->string('type')->nullable();
            $table->json('color_product')->nullable();
            $table->json('size_product')->nullable();
            $table->string('count_product')->nullable();
            $table->string('price_product')->nullable();
            $table->string('name_customer')->nullable();
            $table->string('family_customer')->nullable();
            $table->string('phone_customer')->nullable();
            $table->string('email_customer')->nullable();
            $table->string('user_id_customer')->nullable();
            $table->string('discount_code')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('discount_percent')->nullable();
            $table->string('transactionId')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('total_price')->nullable();

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
        Schema::dropIfExists('invoices');
    }
};
