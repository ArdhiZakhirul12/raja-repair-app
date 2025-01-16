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
            $table->string('no_hp_alternatif')->nullable();
            $table->foreignId('hp_model_id')->constrained()->onDelete('cascade');
            $table->foreignId('metode_pembayaran_id')->constrained()->onDelete('cascade')->nullable();
            $table->string('imei');
            $table->longText('kendala');
            $table->string('status');
            $table->integer('diskon')->default(0);
            $table->enum('garansi',['0','1']);
            $table->integer('total');
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
