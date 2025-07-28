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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tagihan')->constrained('tagihans');
            $table->foreignId('id_pelanggan')->constrained('pelanggans');
            $table->foreignId('id_user')->constrained('users'); // admin/operator input pembayaran
            $table->date('tanggal_pembayaran');
            $table->string('bulan_bayar', 10);
            $table->decimal('biaya_admin', 12, 2)->default(0);
            $table->decimal('total_bayar', 14, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
