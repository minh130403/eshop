<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('avatar_id')->nullable();
            $table->string('slug');
            $table->unsignedInteger('price')->nullable();
            $table->unsignedInteger('sale_price')->nullable();
            $table->boolean('is_sale')->default(false);
            $table->boolean('is_new')->default(true);  
            $table->timestamps();

            $table->foreign('avatar_id')->references('id')->on('images')->nullOnDelete();
            // DB::statement('ALTER TABLE products ADD CONSTRAINT chk_price CHECK (price > sale_price)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
