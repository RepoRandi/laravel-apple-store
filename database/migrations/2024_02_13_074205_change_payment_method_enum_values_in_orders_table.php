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
        Schema::table('orders', function (Blueprint $table) {
            // Menghapus nilai ewallet dari enum
            $table->enum('payment_method', ['bank_transfer', 'gopay'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Menambahkan kembali nilai ewallet ke enum jika diperlukan
            $table->enum('payment_method', ['bank_transfer', 'ewallet'])->change();
        });
    }
};
