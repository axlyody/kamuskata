<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Kamus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kamus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kamus_id');
            $table->string('bahasa_awal_slug');
            $table->string('bahasa_akhir_slug');
            $table->string('submitter')->nullable();
            $table->string('slug')->nullable();
            $table->string('kata');
            $table->string('arti');
            $table->integer('disetujui');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kamus');
    }
}
