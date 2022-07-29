<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerWorkingHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_working_hours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('seller_id')->nullable();
            $table->string('day')->nullable();
            $table->string('open_time')->nullable();
            $table->string('close_time')->nullable();
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
        Schema::dropIfExists('seller_working_hours');
    }
}
