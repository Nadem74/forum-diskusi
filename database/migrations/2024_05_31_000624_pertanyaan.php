<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pertanyaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pertanyaan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('isi');
            $table->bigInteger('kategori_id')->unsigned();
            $table->integer('jawaban_tepat_id')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('pertanyaan', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate("cascade");
        });

         Schema::table('pertanyaan', function (Blueprint $table) {
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade')->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
