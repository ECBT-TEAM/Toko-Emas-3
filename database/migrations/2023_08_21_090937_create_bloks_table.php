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
        Schema::create('bloks', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor');
            $table->unsignedBigInteger('cabang_id');
            $table->timestamps();

            $table->foreign('cabang_id')
                ->references('id')
                ->on('cabangs')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bloks');
    }
};
