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
            $table->integer('user_id')->nullable();
            $table->integer('seller_id')->nullable();
            $table->enum('payment_type', ['cod', 'paypal', 'stripe'])->nullable();
            $table->integer('sub_total')->nullable();
            $table->integer('shipping')->nullable();
            $table->integer('total')->nullable();
            $table->integer('coupon')->nullable();
            $table->integer('coupon_applied')->nullable();
            $table->integer('shipping_address_id')->nullable();
            $table->integer('billing_address_id')->nullable();
            $table->string('billing_address_type')->nullable();
            $table->string('shipping_address_type')->nullable();
            $table->enum('order_status', [0, 1, 2])->nullable();
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
}
