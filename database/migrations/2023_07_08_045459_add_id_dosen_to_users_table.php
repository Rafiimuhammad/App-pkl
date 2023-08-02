<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('id_dosen')->nullable();
        });

        Schema::table('logbooks', function (Blueprint $table) {
            $table->tinyInteger('status1')->default('0');
        });

        Schema::table('pendaftaranseminarpkls', function (Blueprint $table) {
            $table->string('filebimbingan');
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
            $table->dropColumn('id_dosen');
        });

        Schema::table('logbooks', function (Blueprint $table) {
            $table->tinyInteger('status1');
        });

        Schema::table('pendaftaranseminarpkls', function (Blueprint $table) {
            $table->string('filebimbingan');
        });
    }
};
