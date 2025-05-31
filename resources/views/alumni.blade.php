@extends('layout')

@section('head')
<style>
    .btn-search {
        padding: 0.75rem 2rem;
        background: linear-gradient(135deg, #4facfe, #43e97b);
        border: none;
        border-radius: 12px;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        height: fit-content;
    }

    .btn-search:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(79, 172, 254, 0.3);
    }
</style>
@section('content')
<div class="container-alumni">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
        <h1 class="mb-4">Daftar Alumni</h1>
        <a href="{{ route('tambah_alumni') }}" class="btn btn-primary"><i class="fas fa-plus"></i>Tambah Alumni Baru</a>
    </div>

    {{-- Search and Sort --}}
    <form method="GET" action="{{ route('alumni') }}">
        <div class="filter-bar">
            <input type="text" name="search" placeholder="Cari nama/NIM/Prodi..." value="{{ request('search') }}">

            <select name="sort_by">
                <option value="" {{ request('sort_by') == null ? 'selected' : '' }}>Urutkan berdasarkan</option>
                <option value="nama_lengkap" {{ request('sort_by') == 'nama_lengkap' ? 'selected' : '' }}>Nama</option>
                <option value="angkatan" {{ request('sort_by') == 'angkatan' ? 'selected' : '' }}>Angkatan</option>
                <option value="tahun_lulus" {{ request('sort_by') == 'tahun_lulus' ? 'selected' : '' }}>Tahun Lulus</option>
            </select>

            <button type="submit" class="btn-search">Terapkan</button>
        </div>
    </form>

    {{-- Tabel --}}
    <table class="table table-striped">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Program Studi</th>
                <th>Angkatan</th>
                <th>Tahun Lulus</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alumni as $alumnus)
            <tr>
                <td>{{ $alumnus->nim }}</td>
                <td>{{ $alumnus->nama_lengkap }}</td>
                <td>{{ $alumnus->program_studi }}</td>
                <td>{{ $alumnus->angkatan }}</td>
                <td>{{ $alumnus->tahun_lulus }}</td>
                <td>
                    <div style="display: flex; gap: 0.5rem; margin-bottom: 0.5rem;">
                        <a href="{{ route('edit_alumni', ['alumni' => $alumnus->id]) }}" class="btn btn-sm btn-primary" style="flex: 1;">Edit</a>
                        <form method="POST" action="{{ route('alumni-destroy', $alumnus) }}" style="margin: 0; flex: 1;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus data ini?')" class="btn btn-sm btn-danger" style="width: 100%;">Hapus</button>
                        </form>
                    </div>
                    <a href="{{ route('detail_alumni', $alumnus) }}" class="btn btn-sm btn-secondary mt-2" style="display: flex; justify-content: center; width: 100%;">Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Tidak ada data alumni ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $alumni->withQueryString()->links() }}

</div>
@endsection

