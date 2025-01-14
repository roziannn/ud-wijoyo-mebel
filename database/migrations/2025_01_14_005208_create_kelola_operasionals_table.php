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
        Schema::create('kelola_operasionals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kategori_operasional')->constrained('kategori_operasionals')->onDelete('cascade');
            $table->decimal('biaya', 15, 2);
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_pengeluaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelola_operasionals');
    }
};
