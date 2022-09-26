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
        Schema::create('data',function(Blueprint $table){
            $table->id();
            $table->date('tanggal');
            $table->string('nama_instansi');
            $table->string('nama_lokasi', 100);
            $table->integer('id_teknisi');
            $table->integer('id_produk');
            $table->string('warranty');
            $table->integer('id_prioritas');
            $table->integer('id_jobdesk');
            $table->text('deskripsi');
            $table->integer('id_status');
            $table->string('item');
            $table->date('tgl_pengiriman')->nullable();
            $table->string('status_pengiriman')->nullable();
            $table->date('tgl_kembali')->nullable();
            $table->string('status_kembali')->nullable();
            $table->string('comment')->nullable();
            $table->string('id_user');
            $table->date('date_modified');
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
        Schema::dropIfExist('data');
    }
};
