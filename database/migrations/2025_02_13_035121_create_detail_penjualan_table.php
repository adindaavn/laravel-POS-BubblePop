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
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('penjualan_id')->nullable();
            $table->foreign('penjualan_id')->references('id')->on('penjualan')->nullOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('buku_id')->nullable();
            $table->foreign('buku_id')->references('id')->on('buku')->nullOnDelete()->cascadeOnUpdate();
            
            $table->double('harga_jual');
            $table->integer('jumlah')->nullable();
            $table->double('sub_total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penjualan');
    }
};
