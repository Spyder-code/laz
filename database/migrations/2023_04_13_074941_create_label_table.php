<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabelTable extends Migration
{
    public function up()
    {
        Schema::create('label', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('warna');
            $table->string('deskripsi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('label');
    }
}
