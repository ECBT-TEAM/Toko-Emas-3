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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->uuid('kode_transaksi')->primary();
            $table->string('metode_pembayaran');
            $table->string('norek')->nullable();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('kasir_id');
            $table->unsignedBigInteger('cabang_id');
            $table->unsignedBigInteger('jenis_transaksi_id');
            $table->timestamps();

            $table->foreign('member_id')
                ->references('id')
                ->on('members')
                ->onDelete('restrict');

            $table->foreign('kasir_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');

            $table->foreign('cabang_id')
                ->references('id')
                ->on('cabangs')
                ->onDelete('restrict');

            $table->foreign('jenis_transaksi_id')
                ->references('id')
                ->on('jenis_transaksis')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
