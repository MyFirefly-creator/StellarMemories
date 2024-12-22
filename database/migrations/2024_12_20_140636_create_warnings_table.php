<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarningsTable extends Migration
{
    public function up()
    {
        Schema::create('warnings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('FotoID');
            $table->unsignedBigInteger('UserID');
            $table->enum('jenis_pelanggaran', [
                'Pelanggaran hak cipta',
                'Konten dewasa atau eksplisit',
                'Konten kebencian atau diskriminatif',
                'Informasi palsu atau menyesatkan',
                'Spam atau aktivitas manipulatif',
                'Pelanggaran privasi orang lain',
                'Kekerasan atau konten yang mengganggu',
                'Produk atau layanan ilegal',
                'Pelanggaran merek dagang',
                'Penyebaran malware atau konten berbahaya'
            ]);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('FotoID')->references('id')->on('Fotos')->onDelete('cascade');
            $table->foreign('UserID')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('warnings');
    }
}
