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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->mediumText('description')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->string('status')->default(\Modules\Category\Models\Category::ACTIVE_STATUS);
            $table->string('type')->default(\Modules\Category\Models\Category::PRODUCT_TYPE);
            $table->unsignedBigInteger('view')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
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
        Schema::dropIfExists('categories');
    }
};
