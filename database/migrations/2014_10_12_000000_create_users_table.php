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
            $table->string('nama_pembeli');
            $table->string('subtotal_pembelian')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('status_pembelian')->nullable();
            // timestime tgl_pembelian
            $table->date('tanggal_pembelian')->nullable();
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
