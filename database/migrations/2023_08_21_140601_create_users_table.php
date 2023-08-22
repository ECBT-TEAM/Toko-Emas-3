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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 125);
            $table->string('username', 125)->unique();
            $table->string('password', 125);
            $table->unsignedBigInteger('cabang_id');
            $table->unsignedBigInteger('role_id');
            $table->integer('status')->default(1);
            $table->timestamps();

            $table->foreign('cabang_id')
                ->references('id')
                ->on('cabangs')
                ->onDelete('restrict');

            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
