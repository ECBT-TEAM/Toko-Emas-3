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
        Schema::create('transaksi_details', function (Blueprint $table) {
            $table->id();
            $table->uuid('kode_transaksi');
            $table->uuid('produk_id');
            $table->string('harga');
            $table->unsignedBigInteger('jenis_transaksi_id');
            $table->timestamps();

            $table->foreign('jenis_transaksi_id')
                ->references('id')
                ->on('jenis_transaksis')
                ->onDelete('restrict');

            $table->foreign('kode_transaksi')
                ->references('kode_transaksi')
                ->on('transaksis')
                ->onDelete('restrict');

            $table->foreign('produk_id')
                ->references('id')
                ->on('produks')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_details');
    }
};
