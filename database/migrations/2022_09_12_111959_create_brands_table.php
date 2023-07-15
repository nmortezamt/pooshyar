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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('img')->nullable();
            $table->string('description');
            $table->string('name')->nullable();
            $table->string('link')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('status')->default(1);
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
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
        Schema::dropIfExists('brands');
    }
};
