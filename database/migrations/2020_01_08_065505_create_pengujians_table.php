<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengujiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengujians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('user_id');
            $table->unsignedbigInteger('permohonan_id');
            $table->text('uuid')->nullable();
            $table->date('tanggal_terima')->nullable();
            $table->date('tanggal')->nullable();
            $table->tinyInteger('metode_pembayaran')->default(0);
            $table->string('estimasi')->length(100)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('lainnya')->length(100)->nullable();
            $table->text('keterangan')->nullable();
            $table->string('biaya')->length(100)->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('permohonan_id')->references('id')->on('permohonans')->onDelete('cascade');
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
        Schema::dropIfExists('pengujians');
    }
}
