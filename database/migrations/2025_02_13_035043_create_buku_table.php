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
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 50)->unique();
            $table->string('judul', 200);
            $table->string('penulis', 100);
            
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->foreign('kategori_id')->references('id')->on('kategori')->nullOnDelete()->cascadeOnUpdate();
            
            $table->double('harga');
            $table->integer('stok')->nullable();

            $table->unsignedBigInteger('penerbit_id')->nullable();
            $table->foreign('penerbit_id')->references('id')->on('penerbit')->nullOnDelete()->cascadeOnUpdate();

            $table->string('isbn', 20)->unique();
            $table->integer('tahun_terbit')->nullable();
            $table->integer('jml_halaman')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
