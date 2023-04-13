<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonaturTable extends Migration
{
    public function up()
    {
        Schema::create('donatur', function (Blueprint $table) {
            $table->id();
            $table->foreignId('label_id')->nullable()->default(1)->constrained('label');
            $table->string('nama');
            $table->string('email')->nullable();
            $table->string('alamat');
            $table->string('no_telp');
            $table->string('info_telp')->nullable();
            $table->text('respon')->nullable();
            $table->dateTime('terakhir_chat')->nullable();
            $table->text('catatan')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('donatur');
    }
}
