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
        Schema::create('varian_produk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_id')->nullable();
            $table->foreign('produk_id')->references('id')->on('produk')->nullOnDelete()->cascadeOnUpdate();
            $table->string('ukuran', 10)->nullable();
            $table->string('warna', 50)->nullable();
            $table->integer('stok')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('varian_produk');
    }
};
