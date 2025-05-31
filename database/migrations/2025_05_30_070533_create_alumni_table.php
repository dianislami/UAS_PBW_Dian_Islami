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
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            
            // Data Pribadi
            $table->string('nim')->unique();
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat');
            $table->string('email')->unique();
            $table->string('nomor_telepon');
            $table->string('foto_profil')->nullable();
            
            // Data Akademik
            $table->string('fakultas');
            $table->string('program_studi');
            $table->year('angkatan');
            $table->year('tahun_lulus');
            $table->decimal('ipk', 3, 2)->nullable();
            $table->string('nomor_ijazah')->nullable();
            
            // Data Karier
            $table->enum('status_pekerjaan', ['Bekerja', 'Wiraswasta', 'Belum Bekerja', 'Lanjut Studi'])->default('Belum Bekerja');
            $table->string('nama_perusahaan')->nullable();
            $table->string('posisi_jabatan')->nullable();
            $table->string('bidang_pekerjaan')->nullable();
            $table->year('tahun_mulai_bekerja')->nullable();
            $table->text('alamat_kantor')->nullable();
            $table->text('pengalaman_kerja_sebelumnya')->nullable();
            
            // Data Sosial & Jejaring
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('website_portfolio')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index(['fakultas', 'program_studi']);
            $table->index(['angkatan', 'tahun_lulus']);
            $table->index('status_pekerjaan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};