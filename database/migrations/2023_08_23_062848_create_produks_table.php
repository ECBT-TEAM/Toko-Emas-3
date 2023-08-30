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
        Schema::create('produks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->double('berat', $places = 2);
            $table->string('harga_rugi')->nullable();
            $table->unsignedBigInteger('tipe_id');
            $table->unsignedBigInteger('karat_id');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('kotak_id');
            $table->unsignedBigInteger('status_id')->default(1);
            $table->timestamps();

            $table->foreign('tipe_id')
                ->references('id')
                ->on('tipes')
                ->onDelete('restrict');

            $table->foreign('karat_id')
                ->references('id')
                ->on('karats')
                ->onDelete('restrict');

            $table->foreign('supplier_id')
                ->references('id')
                ->on('suppliers')
                ->onDelete('restrict');

            $table->foreign('kotak_id')
                ->references('id')
                ->on('kotaks')
                ->onDelete('restrict');

            $table->foreign('status_id')
                ->references('id')
                ->on('statuses')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
