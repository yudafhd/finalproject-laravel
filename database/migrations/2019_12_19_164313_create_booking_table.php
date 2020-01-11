<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('booking_date');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('booking_package_id');
            $table->integer('payment');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('booking_package_id')->references('id')->on('booking_packages');
            $table->string('start_time_at');
            $table->string('admin_booking');
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
        Schema::dropIfExists('booking');
    }
}
