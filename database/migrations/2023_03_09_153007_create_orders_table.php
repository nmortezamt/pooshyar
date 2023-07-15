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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('ip')->nullable();
            $table->string('discount_code')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('discount_percent')->nullable();
            $table->string('type')->nullable();
            $table->string('price');
            $table->string('product_price');
            $table->string('count')->nullable();
            $table->string('transactionId')->nullable();
            $table->integer('order_count')->nullable();
            $table->boolean('payment')->default(0);
            $table->json('color_id')->nullable();
            $table->json('size_id')->nullable();

            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();

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
        Schema::dropIfExists('orders');
    }
};
