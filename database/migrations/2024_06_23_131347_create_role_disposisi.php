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
        Schema::create('role_disposisi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('disposisi_id');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();

            $table->foreign('disposisi_id')->references('id')->on('disposisi_surat')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_disposisi');
    }
};
