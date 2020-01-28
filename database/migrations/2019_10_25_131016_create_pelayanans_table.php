<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelayanansTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('pelayanans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('uuid')->length(100)->nullable();
            $table->unsignedBigInteger('jenis_pelayanan_id');
            $table->unsignedBigInteger('buah_id')->nullable();
            $table->string('name')->length(100);
            $table->string('satuan');
            $table->double('price');
            $table->foreign('jenis_pelayanan_id')->references('id')->on('jenis_pelayanans')->onDelete('cascade');
            $table->foreign('buah_id')->references('id')->on('buahs')->onDelete('cascade');
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
        Schema::dropIfExists('pelayanans');
    }
}
