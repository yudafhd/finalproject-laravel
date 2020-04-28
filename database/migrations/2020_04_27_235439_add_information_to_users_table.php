<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInformationToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('nis')->nullable();
            $table->date('dob')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('parent_name')->nullable();
            $table->string('short_info')->nullable();
            $table->string('type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nis');
            $table->dropColumn('dob');
            $table->dropColumn('city');
            $table->dropColumn('address');
            $table->dropColumn('parent_name');
            $table->dropColumn('short_info');
            $table->dropColumn('type');
        });
    }
}