<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sub_materi', function (Blueprint $table) {
            $table->id();
            $table->string('judul_sub');
            $table->unsignedBigInteger('materi_id');
            $table->foreign('materi_id')->references('id')->on('materi')->onDelete('cascade');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_materi');
    }
};
