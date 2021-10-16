<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_name');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->integer('price');
            $table->unsignedBigInteger('order_id');

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();

            // $table->bigIncrements('id');
            // $table->unsignedBigInteger('order_id');
            // $table->unsignedBigInteger('product_id');
            // $table->string('name');
            // $table->decimal('price', 20, 4);
            // $table->integer('quantity');
            // $table->string('image')->nullable();
            // $table->decimal('total', 20, 4);

            // $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            // $table->timestamps();
        });// 2 ip * 10 => 20

           // 3 ss * 20 => 60
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
