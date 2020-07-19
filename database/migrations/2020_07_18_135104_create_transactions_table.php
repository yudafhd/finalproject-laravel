<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('purchase_price');
            $table->tinyInteger('purchase_subscription_period_number')->nullable();
            $table->string('purchase_subscription_period_date', 50)->nullable(); $table->string('order_id', 50)->nullable();
            $table->string('transaction_id', 50)->nullable();
            $table->string('status_message')->nullable();
            $table->string('payment_type', 50)->nullable();
            $table->string('bank', 50)->nullable();
            $table->string('fraud_status', 50)->nullable();
            $table->dateTime('transaction_time')->nullable();
            $table->string('snap_token', 100)->nullable();
            $table->string('status', 15)->nullable();
            $table->json('record_json_response')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}