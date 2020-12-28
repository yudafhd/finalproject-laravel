<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFotoToKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->string('foto_acara1')->nullable();
            $table->string('foto_acara2')->nullable();
            $table->string('foto_acara3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            Schema::dropIfExists('foto_acara1');
            Schema::dropIfExists('foto_acara2');
            Schema::dropIfExists('foto_acara3');
        });
    }
}
