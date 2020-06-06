<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInformationToRpkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rpk', function (Blueprint $table) {
            $table->unsignedBigInteger('village_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('village_id')->references('id')->on('villages');
            $table->foreign('district_id')->references('id')->on('districts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rpk', function (Blueprint $table) {
            $table->dropColumn('village_id');
            $table->dropColumn('district_id');
        });
    }
}