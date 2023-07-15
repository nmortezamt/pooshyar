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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('link');
            $table->boolean('status');
            $table->integer('view')->nullable();
            $table->text('body');
            $table->text('description');
            $table->string('keyword');
            $table->string('img')->nullable();
            $table->unsignedBigInteger('category_article_id');
            $table->unsignedBigInteger('subcategory_article_id');
            $table->foreign('category_article_id')->references('id')->on('category_articles')->onDelete('cascade');
            $table->foreign('subcategory_article_id')->references('id')->on('subcategory_articles')->onDelete('cascade');
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
        Schema::dropIfExists('articles');
    }
};
