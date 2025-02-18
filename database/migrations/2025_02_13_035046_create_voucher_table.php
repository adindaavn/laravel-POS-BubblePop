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
        Schema::create('voucher', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 50)->unique();
            $table->enum('tipe', ['fixed', 'percent']);
            $table->double('nilai');
            $table->double('min_belanja')->nullable();
            $table->double('max_diskon')->nullable();
            $table->date('valid_dari')->nullable();
            $table->date('valid_sampai')->nullable();
            $table->boolean('is_active')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher');
    }
};
