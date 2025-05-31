<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function index(Request $request)
    {
        $query = Lowongan::query();

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('perusahaan', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan lokasi
        if ($request->filled('location')) {
            $query->where('lokasi', 'like', "%{$request->location}%");
        }

        // Filter berdasarkan jenis pekerjaan
        if ($request->filled('job_type')) {
            $query->where('jenis_pekerjaan', $request->job_type);
        }

        $lowongan = $query->latest()->paginate(12);

        // Jika request AJAX (untuk filtering), return partial view
        if ($request->ajax()) {
            return view('lowongan.partials.job-cards', compact('lowongan'))->render();
        }

        return view('lowongan', compact('lowongan'));
    }

    public function create()
    {
        return view('tambah_lowongan');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'perusahaan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'sistem_kerja' => 'required|in:WFO,WFH,Hybrid',
            'jenis_pekerjaan' => 'required|in:Magang,Kontrak,Tetap',
            'gaji_min' => 'nullable|string',
            'gaji_max' => 'nullable|string',
            'kontak_email' => 'nullable|email',
            'kontak_telepon' => 'nullable|string|max:20',
            'link_pendaftaran' => 'nullable|url',
            'tanggal_berakhir' => 'nullable|date',
        ]);

        Lowongan::create($validated);

        return redirect()->route('lowongan')->with('success', 'Lowongan berhasil ditambahkan!');
    }

    public function show(Lowongan $lowongan)
    {
        return view('lowongan.show', compact('lowongan'));
    }

    public function edit(Lowongan $lowongan)
    {
        return view('edit_lowongan', compact('lowongan'));
    }

    public function update(Request $request, Lowongan $lowongan)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'perusahaan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'sistem_kerja' => 'required|in:WFO,WFH,Hybrid',
            'jenis_pekerjaan' => 'required|in:Magang,Kontrak,Tetap',
            'gaji_min' => 'nullable|string',
            'gaji_max' => 'nullable|string',
            'kontak_email' => 'nullable|email',
            'kontak_telepon' => 'nullable|string|max:20',
            'link_pendaftaran' => 'nullable|url',
            'tanggal_berakhir' => 'nullable|date',
        ]);

        $lowongan->update($validated);

        return redirect()->route('lowongan')->with('success', 'Lowongan berhasil diperbarui!');
    }

    public function destroy(Lowongan $lowongan)
    {
        $lowongan->delete();
        return redirect()->route('lowongan')->with('success', 'Lowongan berhasil dihapus!');
    }
}