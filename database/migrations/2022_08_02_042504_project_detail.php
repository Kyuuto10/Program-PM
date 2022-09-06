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
        Schema::create('project_detail',function(Blueprint $table){
            $table->id();
            $table->date('tanggal');
            $table->string('nama_instansi');
            $table->string('nama_lokasi', 100);
            $table->string('nama_teknisi');
            $table->string('produk');
            $table->string('warranty');
            $table->string('priority');
            $table->string('jobdesk');
            $table->text('deskripsi');
            $table->string('status');
            $table->string('image')->nullable();
            $table->string('item');
            $table->date('tgl_pengiriman')->nullable();
            $table->string('status1')->nullable();
            $table->date('tgl_kembali')->nullable();
            $table->string('status2')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExist('project_detail');
    }
};
