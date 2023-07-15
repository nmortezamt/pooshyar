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
        Schema::create('answer_comment_articles', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->unsignedBigInteger('comment_id');
            $table->unsignedBigInteger('article_id');
            $table->foreign('comment_id')->references('id')->on('comment_articles')
            ->cascadeOnDelete();
            $table->foreign('article_id')->references('id')->on('articles')
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
        Schema::dropIfExists('answer_comment_articles');
    }
};
