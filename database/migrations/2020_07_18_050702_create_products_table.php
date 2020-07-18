<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('SKU')->unique();
            $table->string('code', 50)->unique();
            $table->string('type', 20);
            $table->integer('price', 20);
            $table->integer('subscription_period_number', 10)->nullable();
            $table->string('subscription_period_date', 50)->nullable();
            $table->string('status',15)->nullable()->default('DRAFT');
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
        Schema::dropIfExists('products');
    }
}