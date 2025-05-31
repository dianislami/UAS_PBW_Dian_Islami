<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LowonganSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('lowongan')->insert([
            [
                'judul' => 'Frontend Developer',
                'deskripsi' => 'Bertanggung jawab membangun UI website menggunakan React.',
                'perusahaan' => 'Tech Kreatif',
                'lokasi' => 'Jakarta',
                'sistem_kerja' => 'Hybrid',
                'jenis_pekerjaan' => 'Tetap',
                'gaji_min' => '8000000',
                'gaji_max' => '12000000',
                'kontak_email' => 'hr@techkreatif.com',
                'kontak_telepon' => '081234567890',
                'link_pendaftaran' => 'https://techkreatif.com/karir',
                'tanggal_berakhir' => Carbon::now()->addDays(30)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Backend Engineer (Intern)',
                'deskripsi' => 'Membantu mengembangkan API menggunakan Laravel.',
                'perusahaan' => 'Startup Hebat',
                'lokasi' => 'Bandung',
                'sistem_kerja' => 'WFH',
                'jenis_pekerjaan' => 'Magang',
                'gaji_min' => '1000000',
                'gaji_max' => '2000000',
                'kontak_email' => 'intern@startuphebat.id',
                'kontak_telepon' => '082112223333',
                'link_pendaftaran' => 'https://startuphebat.id/internship',
                'tanggal_berakhir' => Carbon::now()->addDays(45)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'UI/UX Designer',
                'deskripsi' => 'Mendesain pengalaman pengguna aplikasi mobile.',
                'perusahaan' => 'Creative Studio',
                'lokasi' => 'Surabaya',
                'sistem_kerja' => 'WFO',
                'jenis_pekerjaan' => 'Kontrak',
                'gaji_min' => '5000000',
                'gaji_max' => '7000000',
                'kontak_email' => 'recruit@creativestudio.co.id',
                'kontak_telepon' => '081999991234',
                'link_pendaftaran' => null,
                'tanggal_berakhir' => Carbon::now()->addDays(60)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
