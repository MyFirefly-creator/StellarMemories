<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('KomentarFotos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('FotoID');
            $table->unsignedBigInteger('UserID');
            $table->text('IsiKomentar');
            $table->date('TanggalKomentar');
            $table->timestamps();

            $table->foreign('FotoID')->references('id')->on('Fotos')->onDelete('cascade');
            $table->foreign('UserID')->references('id')->on('users')->onDelete('cascade');            
        });
    }

    public function down()
    {
        Schema::dropIfExists('KomentarFotos');
    }
};
