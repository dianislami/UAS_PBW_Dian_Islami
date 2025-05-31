<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLowonganPekerjaanTable extends Migration
{
    public function up(): void
    {
        Schema::create('lowongan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('perusahaan');
            $table->string('lokasi');
            $table->enum('sistem_kerja', ['WFO', 'WFH', 'Hybrid']);
            $table->enum('jenis_pekerjaan', ['Magang', 'Kontrak', 'Tetap']);
            $table->string('gaji_min')->nullable(); // bisa simpan dalam IDR
            $table->string('gaji_max')->nullable();
            $table->string('kontak_email')->nullable();
            $table->string('kontak_telepon')->nullable();
            $table->string('link_pendaftaran')->nullable();
            $table->date('tanggal_berakhir')->nullable(); // batas akhir lowongan
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('lowongan_pekerjaan');
    }
}

