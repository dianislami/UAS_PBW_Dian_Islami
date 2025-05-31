<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AlumniSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        $fakultasList = ['Fakultas Teknik', 'Fakultas Ekonomi', 'Fakultas Ilmu Komputer'];
        $prodiList = ['Informatika', 'Sistem Informasi', 'Teknik Sipil', 'Manajemen'];
        $statusKerjaList = ['Bekerja', 'Wiraswasta', 'Belum Bekerja', 'Lanjut Studi'];

        for ($i = 0; $i < 20; $i++) {
            $angkatan = $faker->numberBetween(2015, 2021);
            $tahunLulus = $angkatan + $faker->numberBetween(3, 5);
            $statusKerja = $faker->randomElement($statusKerjaList);

            DB::table('alumni')->insert([
                'nim' => $faker->unique()->numerify('20########'),
                'nama_lengkap' => $faker->name,
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date(),
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'alamat' => $faker->address,
                'email' => $faker->unique()->safeEmail,
                'nomor_telepon' => $faker->phoneNumber,
                'foto_profil' => 'default.png',
                'fakultas' => $faker->randomElement($fakultasList),
                'program_studi' => $faker->randomElement($prodiList),
                'angkatan' => $angkatan,
                'tahun_lulus' => $tahunLulus,
                'ipk' => $faker->randomFloat(2, 2.50, 4.00),
                'nomor_ijazah' => $faker->unique()->numerify('IJZ##########'),
                'status_pekerjaan' => $statusKerja,
                'nama_perusahaan' => in_array($statusKerja, ['Bekerja', 'Wiraswasta']) ? $faker->company : null,
                'posisi_jabatan' => in_array($statusKerja, ['Bekerja', 'Wiraswasta']) ? $faker->jobTitle : null,
                'bidang_pekerjaan' => in_array($statusKerja, ['Bekerja', 'Wiraswasta']) ? $faker->word : null,
                'tahun_mulai_bekerja' => in_array($statusKerja, ['Bekerja', 'Wiraswasta']) ? $faker->year($max = 'now') : null,
                'alamat_kantor' => in_array($statusKerja, ['Bekerja', 'Wiraswasta']) ? $faker->address : null,
                'pengalaman_kerja_sebelumnya' => $faker->optional()->sentence,
                'linkedin' => $faker->optional()->url,
                'instagram' => $faker->optional()->userName,
                'facebook' => $faker->optional()->userName,
                'website_portfolio' => $faker->optional()->url,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
