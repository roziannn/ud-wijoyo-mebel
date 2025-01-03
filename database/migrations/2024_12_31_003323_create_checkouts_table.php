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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->integer('kode_transaksi'); // random 6 digit
            $table->integer('total_amount');
            $table->enum('payment_status', ['pending', 'selesai', 'gagal'])->default('pending');
            $table->string('bukti_bayar_img')->nullable();
            $table->date('tanggal_pembayaran')->nullable();
            $table->enum('status_pembayaran', ['pending', 'disetujui'])->default('pending');

            $table->string('alamat_pengiriman')->nullable();
            $table->enum('status_pengiriman', ['pending', 'dalam_perjalanan', 'selesai'])->default('pending');


            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
