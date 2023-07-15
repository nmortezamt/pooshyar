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
        Schema::create('answer_comment_products', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->unsignedBigInteger('comment_id');
            $table->unsignedBigInteger('product_id');
            $table->foreign('comment_id')->references('id')->on('comment_products')
            ->cascadeOnDelete();
            $table->foreign('product_id')->references('id')->on('products')
            ->cascadeOnDelete();
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
        Schema::dropIfExists('answer_comment_products');
    }
};
