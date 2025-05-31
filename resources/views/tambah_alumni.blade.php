@extends('layout')

@section('head')
    <style>

    h2 {
        color: #ffffff;
        border-bottom: 1px solid #444;
        padding-bottom: 0.5rem;
        margin-bottom: 2rem;
        text-align: center;
    }

    h3 {
        color: #ffffff;
        border-bottom: 1px solid #444;
        padding-bottom: 0.5rem;
        margin-bottom: 1rem;
    }

    .container-alumni label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .container-alumni input,
    .container-alumni select,
    .container-alumni textarea {
        width: 100%;
        padding: 0.5rem;
        margin-bottom: 1rem;
        border: 1px solid #444;
        border-radius: 0.5rem;
        background-color: #1e1e2f;
        color: #f1f1f1;
    }

    .container-alumni input[type="file"] {
        background-color: transparent;
        color: #f1f1f1;
    }

    .container-alumni .alert {
        background-color: #ff4d4d;
        padding: 1rem;
        border-radius: 0.5rem;
        color: #fff;
    }

    .container-alumni button[type="submit"] {
        background-color: #6c63ff;
        color: #fff;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .container-alumni button[type="submit"]:hover {
        background-color: #574b90;
    }

    .card-alumni {
        padding: 2rem;
        margin-bottom: 2rem;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 1rem;
        color: #f1f1f1;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
</style>
@endsection

@section('no-sidebar')
@endsection

@section('content')
<div class="container-alumni">
    <div class="welcome-section">
        <h2>Tambah Data Alumni</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Ups!</strong> Ada kesalahan saat input:<br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        

        <form action="{{ route('alumni_store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Data Pribadi --}}
            <div class="card-alumni">
                <h3>Data Pribadi</h3>
                <div>
                    <label>NIM</label>
                    <input type="text" name="nim" value="{{ old('nim') }}" required>
                </div>

                <div>
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                </div>

                <div>
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                </div>

                <div>
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                </div>

                <div>
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div>
                    <label>Alamat</label>
                    <textarea name="alamat" required>{{ old('alamat') }}</textarea>
                </div>

                <div>
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div>
                    <label>No. Telepon</label>
                    <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon') }}" required>
                </div>

                <div>
                    <label>Foto Profil</label>
                    <input type="file" class="form-control" name="foto_profil" id="foto_profil">
                </div>
            </div>

            {{-- Data Akademik --}}
            <div class="card-alumni">
                <h3>Data Akademik</h3>
                <div>
                    <label>Fakultas</label>
                    <input type="text" name="fakultas" value="{{ old('fakultas') }}" required>
                </div>

                <div>
                    <label>Program Studi</label>
                    <input type="text" name="program_studi" value="{{ old('program_studi') }}" required>
                </div>

                <div>
                    <label>Angkatan</label>
                    <input type="number" name="angkatan" value="{{ old('angkatan') }}" required>
                </div>

                <div>
                    <label>Tahun Lulus</label>
                    <input type="number" name="tahun_lulus" value="{{ old('tahun_lulus') }}" required>
                </div>

                <div>
                    <label>IPK</label>
                    <input type="text" name="ipk" value="{{ old('ipk') }}">
                </div>

                <div>
                    <label>Nomor Ijazah</label>
                    <input type="text" name="nomor_ijazah" value="{{ old('nomor_ijazah') }}">
                </div>
            </div>

            {{-- Data Karier --}}
            <div class="card-alumni">
                <h3>Data Karier</h3>
                <div>
                    <label>Status Pekerjaan</label>
                    <select name="status_pekerjaan" required>
                        <option value="">Pilih Status Pekerjaan</option>
                        @foreach (['Bekerja','Wiraswasta','Belum Bekerja','Lanjut Studi'] as $status)
                            <option value="{{ $status }}" {{ old('status_pekerjaan') == $status ? 'selected' : '' }}>
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}">
                </div>

                <div>
                    <label>Posisi/Jabatan</label>
                    <input type="text" name="posisi_jabatan" value="{{ old('posisi_jabatan') }}">
                </div>

                <div>
                    <label>Bidang Pekerjaan</label>
                    <input type="text" name="bidang_pekerjaan" value="{{ old('bidang_pekerjaan') }}">
                </div>

                <div>
                    <label>Tahun Mulai Bekerja</label>
                    <input type="number" name="tahun_mulai_bekerja" value="{{ old('tahun_mulai_bekerja') }}">
                </div>

                <div>
                    <label>Alamat Kantor</label>
                    <textarea name="alamat_kantor">{{ old('alamat_kantor') }}</textarea>
                </div>

                <div>
                    <label>Pengalaman Kerja Sebelumnya</label>
                    <textarea name="pengalaman_kerja_sebelumnya">{{ old('pengalaman_kerja_sebelumnya') }}</textarea>
                </div>
            </div>

            {{-- Data Sosial --}}
            <div class="card-alumni">
                <h3>Media Sosial & Portofolio</h3>
                <div>
                    <label>LinkedIn</label>
                    <input type="url" name="linkedin" value="{{ old('linkedin') }}">
                </div>

                <div>
                    <label>Instagram</label>
                    <input type="text" name="instagram" value="{{ old('instagram') }}">
                </div>

                <div>
                    <label>Facebook</label>
                    <input type="text" name="facebook" value="{{ old('facebook') }}">
                </div>

                <div>
                    <label>Website / Portfolio</label>
                    <input type="url" name="website_portfolio" value="{{ old('website_portfolio') }}">
                </div>
            </div>

            <div style="justify-content: space-between; display: flex;">
                <a href="{{ route('alumni') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
    
</div>
@endsection