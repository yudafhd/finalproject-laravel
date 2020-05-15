<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul')->nullable();
            $table->text('detail_kegiatan')->nullable();
            $table->text('detail_anggaran')->nullable();
            $table->date('tanggal_terlaksana')->nullable();
            $table->string('sasaran')->nullable();
            $table->string('tujuan')->nullable();
            $table->string('hasil')->nullable();
            $table->string('tempat')->nullable();
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('okp_id');
            $table->foreign('okp_id')->references('id')->on('okps');
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
        Schema::dropIfExists('kegiatans');
    }
}