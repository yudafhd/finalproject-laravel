<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOkpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('okps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama')->nullable();
            $table->string('bidang')->nullable();
            $table->string('alamat')->nullable();
            $table->string('long')->nullable();
            $table->string('lat')->nullable();
            $table->date('tanggal_daftar')->nullable();
            $table->integer('no_okp')->nullable();
            $table->string('status')->nullable();
            $table->string('foto')->nullable();
            $table->string('visi')->nullable();
            $table->string('misi')->nullable();
            $table->text('latar_belakang')->nullable();
            $table->date('tanggal_berdiri')->nullable();
            $table->string('pendiri')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('okps');
    }
}