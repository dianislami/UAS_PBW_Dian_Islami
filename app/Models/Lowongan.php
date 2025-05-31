<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Lowongan extends Model
{
    use HasFactory;

    protected $table = 'lowongan';

    protected $fillable = [
        'judul',
        'deskripsi',
        'perusahaan',
        'lokasi',
        'sistem_kerja',
        'jenis_pekerjaan',
        'gaji_min',
        'gaji_max',
        'kontak_email',
        'kontak_telepon',
        'link_pendaftaran',
        'tanggal_berakhir',
    ];

    protected $casts = [
        'tanggal_berakhir' => 'date',
        'gaji_min' => 'integer',
        'gaji_max' => 'integer',
    ];

    // Scope untuk lowongan yang masih aktif
    public function scopeActive($query)
    {
        return $query->where(function($q) {
            $q->whereNull('tanggal_berakhir')
              ->orWhere('tanggal_berakhir', '>=', Carbon::today());
        });
    }

    // Accessor untuk format gaji
    public function getFormattedSalaryAttribute()
    {
        if ($this->gaji_min && $this->gaji_max) {
            return 'Rp ' . number_format($this->gaji_min) . ' - Rp ' . number_format($this->gaji_max);
        } elseif ($this->gaji_min) {
            return 'Mulai dari Rp ' . number_format($this->gaji_min);
        } elseif ($this->gaji_max) {
            return 'Hingga Rp ' . number_format($this->gaji_max);
        }
        
        return 'Gaji dapat dinegosiasi';
    }

    // Cek apakah lowongan masih aktif
    public function getIsActiveAttribute()
    {
        if (!$this->tanggal_berakhir) {
            return true;
        }
        
        return $this->tanggal_berakhir >= Carbon::today();
    }

    // Format tanggal berakhir
    public function getFormattedDeadlineAttribute()
    {
        if (!$this->tanggal_berakhir) {
            return null;
        }
        
        return $this->tanggal_berakhir->format('d M Y');
    }
}