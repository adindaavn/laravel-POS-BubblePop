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
        Schema::create('detail_pembelian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pembelian_id')->nullable();
            $table->foreign('pembelian_id')->references('id')->on('pembelian')->nullOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('varian_produk_id')->nullable();
            $table->foreign('varian_produk_id')->references('id')->on('varian_produk')->nullOnDelete()->cascadeOnUpdate();
            $table->double('harga_beli');
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
        Schema::dropIfExists('detail_pembelian');
    }
};
