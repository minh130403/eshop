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
        Schema::create('sub-orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('product_name');
            $table->unsignedInteger('product_price');
            $table->unsignedDecimal('quantity');
            $table->unsignedInteger('total_price');

            $table->foreign('order_id')->references('id')->on('orders');
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
        Schema::dropIfExists('sub-orders');
    }
};
