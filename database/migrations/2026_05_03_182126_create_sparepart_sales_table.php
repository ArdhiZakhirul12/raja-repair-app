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
        Schema::create('sparepart_sales', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pesanan');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('metode_pembayaran_id')->constrained()->onDelete('cascade')->nullable();
            $table->string('status');
            $table->integer('total');
            $table->integer('diskon')->default(0);
            $table->string('diskon_status');
            $table->text('keterangan')->nullable();
            $table->text('nominal_bayar');
            $table->text('kembalian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sparepart_sales');
    }
};
