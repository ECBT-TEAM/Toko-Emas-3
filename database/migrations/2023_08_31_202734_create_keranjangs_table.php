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
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->id();
            $table->uuid('produk_id');
            $table->string('harga', 125);
            $table->unsignedBigInteger('jenis_transaksi_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('status')->nullable();
            $table->timestamps();

            $table->foreign('produk_id')
                ->references('id')
                ->on('produks')
                ->onDelete('restrict');

            $table->foreign('jenis_transaksi_id')
                ->references('id')
                ->on('jenis_transaksis')
                ->onDelete('restrict');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjangs');
    }
};
