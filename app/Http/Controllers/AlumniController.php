<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        $query = Alumni::query();

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by fakultas
        if ($request->filled('fakultas')) {
            $query->byFakultas($request->fakultas);
        }

        // Filter by program studi
        if ($request->filled('program_studi')) {
            $query->byProdi($request->program_studi);
        }

        // Filter by angkatan
        if ($request->filled('angkatan')) {
            $query->byAngkatan($request->angkatan);
        }

        // Filter by status pekerjaan
        if ($request->filled('status_pekerjaan')) {
            $query->byStatus($request->status_pekerjaan);
        }

        // Sorting
        $sortBy = $request->get('sort_by');
        $sortOrder = $request->get('sort_order', 'asc');

        if (!empty($sortBy)) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            // Default sorting
            $query->orderBy('nama_lengkap', 'asc');
        }

        // Pagination
        $perPage = $request->get('per_page', 12);
        $alumni = $query->paginate($perPage);

        // Data untuk filter dropdown
        $fakultasList = Alumni::getFakultasList();
        $statusList = Alumni::getStatusPekerjaanList();
        
        // Get unique program studi and angkatan from database
        $prodiList = Alumni::distinct()->pluck('program_studi')->sort()->values();
        $angkatanList = Alumni::distinct()->pluck('angkatan')->sort()->values();

        // Statistics
        $stats = [
            'total_alumni' => Alumni::count(),
            'bekerja' => Alumni::where('status_pekerjaan', 'Bekerja')->count(),
            'wiraswasta' => Alumni::where('status_pekerjaan', 'Wiraswasta')->count(),
            'belum_bekerja' => Alumni::where('status_pekerjaan', 'Belum Bekerja')->count(),
            'lanjut_studi' => Alumni::where('status_pekerjaan', 'Lanjut Studi')->count(),
        ];

        return view('alumni', compact(
            'alumni', 
            'fakultasList', 
            'prodiList', 
            'angkatanList', 
            'statusList', 
            'stats'
        ));
    }

    public function show(Alumni $alumni)
    {
        return view('detail_alumni', compact('alumni'));
    }

    public function create()
    {
        $fakultasList = Alumni::getFakultasList();
        $statusList = Alumni::getStatusPekerjaanList();
        
        return view('tambah_alumni', compact('fakultasList', 'statusList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Data Pribadi
            'nim' => 'required|string|unique:alumni,nim',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:alumni,email',
            'nomor_telepon' => 'required|string|max:20',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            
            // Data Akademik  
            'fakultas' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'angkatan' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'tahun_lulus' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'ipk' => 'nullable|numeric|min:0|max:4',
            'nomor_ijazah' => 'nullable|string|max:255',
            
            // Data Karier
            'status_pekerjaan' => 'required|in:Bekerja,Wiraswasta,Belum Bekerja,Lanjut Studi',
            'nama_perusahaan' => 'nullable|string|max:255',
            'posisi_jabatan' => 'nullable|string|max:255',
            'bidang_pekerjaan' => 'nullable|string|max:255',
            'tahun_mulai_bekerja' => 'nullable|integer|min:1900|max:' . (date('Y') + 10),
            'alamat_kantor' => 'nullable|string',
            'pengalaman_kerja_sebelumnya' => 'nullable|string',
            
            // Data Sosial
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'website_portfolio' => 'nullable|url',
        ]);

        // Handle file upload
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('alumni/photos', $filename, 'public');
            $validated['foto_profil'] = $filename;
        }
        

        Alumni::create($validated);

        return redirect()->route('alumni')
            ->with('success', 'Data alumni berhasil ditambahkan!');
    }

    public function edit(Alumni $alumni)
    {
        $fakultasList = Alumni::getFakultasList();
        $statusList = Alumni::getStatusPekerjaanList();

        return view('edit_alumni', compact('alumni', 'fakultasList', 'statusList'));
    }

    public function update(Request $request, Alumni $alumni)
    {
        $validated = $request->validate([
            // Data Pribadi
            'nim' => 'required|string|unique:alumni,nim,' . $alumni->id,
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:alumni,email,' . $alumni->id,
            'nomor_telepon' => 'required|string|max:20',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            
            // Data Akademik  
            'fakultas' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'angkatan' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'tahun_lulus' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'ipk' => 'nullable|numeric|min:0|max:4',
            'nomor_ijazah' => 'nullable|string|max:255',
            
            // Data Karier
            'status_pekerjaan' => 'required|in:Bekerja,Wiraswasta,Belum Bekerja,Lanjut Studi',
            'nama_perusahaan' => 'nullable|string|max:255',
            'posisi_jabatan' => 'nullable|string|max:255',
            'bidang_pekerjaan' => 'nullable|string|max:255',
            'tahun_mulai_bekerja' => 'nullable|integer|min:1900|max:' . (date('Y') + 10),
            'alamat_kantor' => 'nullable|string',
            'pengalaman_kerja_sebelumnya' => 'nullable|string',
            
            // Data Sosial
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'website_portfolio' => 'nullable|url',
        ]);

        // Handle file upload
        if ($request->hasFile('foto_profil')) {
            // Delete old photo
            if ($alumni->foto_profil && Storage::disk('public')->exists('alumni/photos/' . $alumni->foto_profil)) {
                Storage::disk('public')->delete('alumni/photos/' . $alumni->foto_profil);
            }
            
            $file = $request->file('foto_profil');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('alumni/photos', $filename, 'public');

            $validated['foto_profil'] = $filename;
            // $alumni->foto_profil = $filename;
        }

        $alumni->update($validated);

        return redirect()->route('alumni')
            ->with('success', 'Data alumni berhasil diperbarui!');
    }

    public function destroy(Alumni $alumni)
    {
        // Delete photo if exists
        if ($alumni->foto_profil) {
            Storage::delete('public/alumni/photos/' . $alumni->foto_profil);
        }

        $alumni->delete();

        return redirect()->route('alumni')
            ->with('success', 'Data alumni berhasil dihapus!');
    }

    // API endpoint untuk mendapatkan program studi berdasarkan fakultas
    public function getProdiByFakultas(Request $request)
    {
        $fakultas = $request->get('fakultas');
        $prodi = Alumni::where('fakultas', $fakultas)
                      ->distinct()
                      ->pluck('program_studi')
                      ->sort()
                      ->values();
        
        return response()->json($prodi);
    }

    // Export data alumni
    public function export(Request $request)
    {
        // Implementation for exporting alumni data (Excel/PDF)
        // This would require additional packages like maatwebsite/excel
    }
}