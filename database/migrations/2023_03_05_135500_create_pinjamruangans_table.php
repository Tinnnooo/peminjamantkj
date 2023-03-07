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
            $table->bigIncrements('id_ruangan');
            $table->bigIncrements('id_user');
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
