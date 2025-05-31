<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumni';

    protected $fillable = [
        // Data Pribadi
        'nim',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'email',
        'nomor_telepon',
        'foto_profil',
        
        // Data Akademik
        'fakultas',
        'program_studi',
        'angkatan',
        'tahun_lulus',
        'ipk',
        'nomor_ijazah',
        
        // Data Karier
        'status_pekerjaan',
        'nama_perusahaan',
        'posisi_jabatan',
        'bidang_pekerjaan',
        'tahun_mulai_bekerja',
        'alamat_kantor',
        'pengalaman_kerja_sebelumnya',
        
        // Data Sosial & Jejaring
        'linkedin',
        'instagram',
        'facebook',
        'website_portfolio',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'ipk' => 'decimal:2',
        'angkatan' => 'integer',
        'tahun_lulus' => 'integer',
        'tahun_mulai_bekerja' => 'integer',
    ];

    // Accessor untuk format tanggal lahir
    public function getTanggalLahirFormattedAttribute()
    {
        return $this->tanggal_lahir ? $this->tanggal_lahir->format('d M Y') : '-';
    }

    // Accessor untuk tempat tanggal lahir
    public function getTempatTanggalLahirAttribute()
    {
        return $this->tempat_lahir . ', ' . $this->tanggal_lahir_formatted;
    }

    // Accessor untuk usia
    public function getUsiaAttribute()
    {
        return $this->tanggal_lahir ? Carbon::parse($this->tanggal_lahir)->age : 0;
    }

    // Accessor untuk jenis kelamin full
    public function getJenisKelaminFullAttribute()
    {
        return $this->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
    }

    // Accessor untuk nama fakultas singkat
    public function getFakultasShortAttribute()
    {
        $fakultas_map = [
            'Fakultas Teknik' => 'FT',
            'Fakultas Ekonomi dan Bisnis' => 'FEB',
            'Fakultas Ilmu Komputer' => 'FASILKOM',
            'Fakultas Kedokteran' => 'FK',
            'Fakultas Hukum' => 'FH',
            'Fakultas Pertanian' => 'FAPERTA',
        ];
        
        return $fakultas_map[$this->fakultas] ?? substr($this->fakultas, 0, 3);
    }

    // Accessor untuk status badge color
    public function getStatusBadgeColorAttribute()
    {
        $colors = [
            'Bekerja' => 'success',
            'Wiraswasta' => 'info',
            'Belum Bekerja' => 'warning',
            'Lanjut Studi' => 'primary'
        ];
        
        return $colors[$this->status_pekerjaan] ?? 'secondary';
    }

    // Accessor untuk foto profil URL
    public function getFotoProfilUrlAttribute()
    {
        if ($this->foto_profil) {
            return asset('storage/alumni/photos/' . $this->foto_profil);
        }
        
        // Default avatar berdasarkan jenis kelamin
        $default = $this->jenis_kelamin === 'L' ? 'male-avatar.png' : 'female-avatar.png';
        return asset('assets/images/avatars/' . $default);
    }

    // Scope untuk filter berdasarkan fakultas
    public function scopeByFakultas($query, $fakultas)
    {
        return $query->where('fakultas', $fakultas);
    }

    // Scope untuk filter berdasarkan program studi
    public function scopeByProdi($query, $prodi)
    {
        return $query->where('program_studi', $prodi);
    }

    // Scope untuk filter berdasarkan angkatan
    public function scopeByAngkatan($query, $angkatan)
    {
        return $query->where('angkatan', $angkatan);
    }

    // Scope untuk filter berdasarkan status pekerjaan
    public function scopeByStatus($query, $status)
    {
        return $query->where('status_pekerjaan', $status);
    }

    // Scope untuk pencarian
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('nama_lengkap', 'like', "%{$search}%")
              ->orWhere('nim', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('program_studi', 'like', "%{$search}%")
              ->orWhere('fakultas', 'like', "%{$search}%")
              ->orWhere('nama_perusahaan', 'like', "%{$search}%")
              ->orWhere('posisi_jabatan', 'like', "%{$search}%");
        });
    }

    // Static method untuk mendapatkan daftar fakultas
    public static function getFakultasList()
    {
        return [
            'Fakultas Teknik',
            'Fakultas Ekonomi dan Bisnis',
            'Fakultas Ilmu Komputer',
            'Fakultas Kedokteran',
            'Fakultas Hukum',
            'Fakultas Pertanian',
            'Fakultas Ilmu Sosial dan Politik',
            'Fakultas Pendidikan',
        ];
    }

    // Static method untuk mendapatkan daftar status pekerjaan
    public static function getStatusPekerjaanList()
    {
        return [
            'Bekerja',
            'Wiraswasta',
            'Belum Bekerja',
            'Lanjut Studi'
        ];
    }
}