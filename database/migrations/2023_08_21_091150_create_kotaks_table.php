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
        Schema::create('kotaks', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor');
            $table->string('jenis', '10');
            $table->double('berat', $places = 2);
            $table->unsignedBigInteger('blok_id');
            $table->unsignedBigInteger('kategori_id');
            $table->timestamps();

            $table->foreign('blok_id')
                ->references('id')
                ->on('bloks')
                ->onDelete('restrict');

            $table->foreign('kategori_id')
                ->references('id')
                ->on('kategoris')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kotaks');
    }
};
