<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('disposisi_surat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_id');
            $table->string('catatan');
            $table->string('status');
            $table->timestamps();

            $table->foreign('surat_id')->references('id')->on('surat_eksternal')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposisi_surat');
    }
};
