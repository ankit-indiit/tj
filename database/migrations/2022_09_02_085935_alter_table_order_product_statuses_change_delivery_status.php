<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableOrderProductStatusesChangeDeliveryStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('[table_name]', function (Blueprint $table) {
            $table->enum('delivery_status', ['unprocess', 'request', 'approved', 'packed', 'shipped', 'rejected', 'delivered'])->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('[table_name]', function (Blueprint $table) {
            //
        });
    }
}
