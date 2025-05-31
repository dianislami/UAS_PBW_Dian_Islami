<?php
namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Lowongan;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_alumni' => Alumni::count(),
            'bekerja' => Alumni::where('status_pekerjaan', 'Bekerja')->count(),
            'wiraswasta' => Alumni::where('status_pekerjaan', 'Wiraswasta')->count(),
            'belum_bekerja' => Alumni::where('status_pekerjaan', 'Belum Bekerja')->count(),
            'lanjut_studi' => Alumni::where('status_pekerjaan', 'Lanjut Studi')->count(),
        ];

        $jumlahLowongan = Lowongan::count();

        return view('dashboard', compact('stats', 'jumlahLowongan'));
    }
}