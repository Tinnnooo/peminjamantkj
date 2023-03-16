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
        Schema::create('pinjamruangans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_ruangan');
            $table->integer('id_user');
            $table->integer('id_guru');
            $table->date('tgl_mulai');
            $table->time('wkt_mulai');
            $table->date('tgl_selesai');
            $table->time('wkt_selesai');
            $table->string('status');
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
        Schema::dropIfExists('pinjamruangans');
    }
};
