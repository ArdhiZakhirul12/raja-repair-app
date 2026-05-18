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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pesanan');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('teknisi_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('no_hp_alternatif')->nullable();
            $table->foreignId('hp_model_id')->constrained()->onDelete('cascade');
            $table->foreignId('metode_pembayaran_id')->constrained()->onDelete('cascade')->nullable();
            $table->string('imei')->nullable();
            $table->longText('kendala');
            $table->string('status');
            $table->integer('claim')->default(0);
            $table->enum('garansi',['0','1','2','3']);
            $table->integer('total');
            $table->string('nomor_antrian');
            $table->integer('diskon')->default(0);
            $table->string('diskon_status');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
