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
        Schema::create('isi_sub_materi', function (Blueprint $table) {
            $table->id();
            $table->string('judul_sub');
            $table->text('text');
            //$table->string('slug');
            $table->unsignedBigInteger('sub_materi_id');
            $table->foreign('sub_materi_id')->references('id')->on('sub_materi')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isi_sub_materi');
    }
};
