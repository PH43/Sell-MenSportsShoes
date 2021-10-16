<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->integer('status')->default(1);
            $table->timestamps();

            // $table->bigIncrements('id');
            // // $table->string('order_no')->index();
            // // $table->unsignedBigInteger('customer_id')->nullable();
            // // $table->string('customer_name')->nullable();
            // // $table->string('customer_email')->nullable();
            // // $table->string('customer_phone')->nullable();
            // // $table->unsignedBigInteger('province_id');
            // // $table->unsignedBigInteger('district_id');
            // // $table->unsignedBigInteger('ward_id');
            // // $table->string('street');
            // // $table->decimal('total_amount', 20, 4); // tien hang + phi - ma giam gia
            // // $table->decimal('sub_amount', 20, 4); // tien hang
            // // $table->decimal('shipping_fee', 20, 4);
            // // $table->unsignedBigInteger('shipping_method_id');
            // // $table->unsignedBigInteger('payment_method_id');
            // $table->unsignedBigInteger('status')->nullable();
            // $table->timestamps();
            
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
}
