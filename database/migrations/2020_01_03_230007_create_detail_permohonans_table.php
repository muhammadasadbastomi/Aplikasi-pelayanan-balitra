<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPermohonansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_permohonans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('permohonan_id');
            $table->unsignedBigInteger('pelayanan_id');
            $table->text('uuid')->nullable();
            $table->timestamps();
            $table->double('biaya');
            $table->foreign('permohonan_id')->references('id')->on('permohonans')->onDelete('cascade');
            $table->foreign('pelayanan_id')->references('id')->on('pelayanans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_permohonans');
    }
}
