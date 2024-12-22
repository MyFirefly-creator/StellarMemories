<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('Albums', function (Blueprint $table) {
            $table->id();
            $table->string('NamaAlbum');
            $table->text('Deskripsi');
            $table->date('TanggalDibuat');
            $table->unsignedBigInteger('UserID');
            $table->timestamps();

            $table->foreign('UserID')->references('id')->on('users')->onDelete('cascade');        });
    }

    public function down()
    {
        Schema::dropIfExists('Albums');
    }
};
