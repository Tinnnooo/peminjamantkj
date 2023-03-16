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
        Schema::create('ambilbahans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_bahan');
            $table->bigInteger('id_user');
            $table->date('tgl_ambil')->default(date('Y-m-d'));
            $table->time('wkt_ambil');
            $table->integer('qty');
            $table->string('deskripsi');
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
        Schema::dropIfExists('ambilbahans');
    }
};
