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
        Schema::create('subcategory_articles', function (Blueprint $table) {
            $table->id();
            $table->string('img')->nullable();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('link');
            $table->unsignedBigInteger('category_article_id');
             $table->foreign('category_article_id')->references('id')->on('category_articles')->cascadeOnDelete();
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
        Schema::dropIfExists('subcategory_articles');
    }
};
