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
        Schema::create('harga_refs', function (Blueprint $table) {
            $table->id();
            $table->string('harga');
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('karat_id');
            $table->timestamps();

            $table->foreign('karat_id')
                ->references('id')
                ->on('karats')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harga_refs');
    }
};
