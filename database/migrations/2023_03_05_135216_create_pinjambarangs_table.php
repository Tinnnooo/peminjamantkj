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
        Schema::create('pinjambarangs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_barang');
            $table->integer('id_user');
            $table->integer('id_guru');
            $table->integer('qty');
            $table->date('tgl_mulai');
            $table->time('wkt_mulai');
            $table->date('tgl_selesai')->nullable()->default(null);
            $table->time('wkt_selesai')->nullable()->default(null);
            $table->string('lokasi_barang');
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
        Schema::dropIfExists('pinjam_barangs');
    }
};
