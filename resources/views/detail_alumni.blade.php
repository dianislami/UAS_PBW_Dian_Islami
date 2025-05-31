@extends('layout')

@section ('head')
<style>
    .info-section {
        background: rgba(15, 15, 17, 0.6);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 3rem;
        position: relative;
        overflow: hidden;
    }

    .info-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #7b68ee, #ff6b9d, #4facfe, #43e97b);
        background-size: 200% 100%;
        animation: gradient 4s ease infinite;
    }

    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .alumni-profile-container {
        display: flex;
        gap: 3rem;
        margin-bottom: 1rem;
        align-items: flex-start;
    }

    .profile-photo-section {
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .profile-photo {
        width: 250px;
        height: 250px;
        border-radius: 20px;
        object-fit: cover;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        border: 3px solid rgba(255, 255, 255, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .profile-photo:hover {
        transform: scale(1.02);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
    }

    .no-photo-placeholder {
        width: 250px;
        height: 250px;
        background: linear-gradient(135deg, rgba(123, 104, 238, 0.1), rgba(255, 107, 157, 0.1));
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.6);
        font-size: 1.1rem;
        border: 2px dashed rgba(255, 255, 255, 0.2);
        text-align: center;
    }

    .alumni-info-section {
        flex: 1;
        min-width: 0;
    }

    .alumni-name {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #7b68ee, #ff6b9d);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
        line-height: 1.2;
    }

    .info-grid {
        display: flex;
        flex-direction: column;
        gap: 2rem;
        margin-top: 0;
    }

    .info-card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        padding: 1.5rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .info-card:hover {
        background: rgba(255, 255, 255, 0.08);
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .info-card h3 {
        color: #4facfe;
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-card h3::before {
        content: '';
        width: 4px;
        height: 20px;
        background: linear-gradient(135deg, #4facfe, #43e97b);
        border-radius: 2px;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        gap: 1rem;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: rgba(255, 255, 255, 0.8);
        min-width: 120px;
        flex-shrink: 0;
    }

    .info-value {
        color: rgba(255, 255, 255, 0.9);
        text-align: right;
        flex: 1;
        word-break: break-word;
    }

    .social-links {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .social-link {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.5rem 1rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .social-link:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
        color: white;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .alumni-profile-container {
            flex-direction: column;
            gap: 2rem;
            align-items: center;
        }

        .profile-photo-section {
            min-width: auto;
            width: 100%;
        }

        .profile-photo,
        .no-photo-placeholder {
            width: 200px;
            height: 200px;
        }

        .alumni-name {
            font-size: 2rem;
            text-align: center;
        }

        .info-grid {
            flex-direction: column;
            gap: 1.5rem;
        }

        .info-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .info-value {
            text-align: left;
        }

        .info-section {
            padding: 2rem;
        }
    }

    @media (max-width: 480px) {
        .alumni-name {
            font-size: 1.8rem;
        }

        .info-section {
            padding: 1.5rem;
        }

        .info-card {
            padding: 1rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container-alumni">
    <div class="card">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; padding-bottom: 1rem;">
            <h1>Detail Alumni</h1>
            <a href="{{ route('alumni') }}" class="btn btn-secondary mt-4">Kembali</a>
        </div>
        
        <div class="info-section">
            <div class="alumni-profile-container">
                <!-- Profile Photo Section -->
                <div class="profile-photo-section">
                    @if ($alumni->foto_profil)
                        <img src="{{ asset('storage/alumni/photos/' . $alumni->foto_profil) }}" 
                             alt="Foto Profil {{ $alumni->nama_lengkap }}" 
                             class="profile-photo">
                    @else
                        <div class="no-photo-placeholder">
                            <div>
                                <i class="fas fa-user" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                                <br>Tidak ada foto
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Alumni Information Section -->
                <div class="alumni-info-section">
                    <h1 class="alumni-name">{{ $alumni->nama_lengkap }}</h1>
                    <p style="color: rgba(255, 255, 255, 0.7); font-size: 1.1rem; margin-bottom: 2rem;">
                        {{ $alumni->program_studi }} • Angkatan {{ $alumni->angkatan }}
                    </p>
                </div>
            </div>

            <div style="border-bottom: 1px solid rgba(255, 255, 255, 0.1); margin-bottom: 1.3rem;"></div>

            <!-- Information Cards Section (Full Width Below) -->
            <div class="info-grid">
                        <!-- Personal Information -->
                        <div class="info-card">
                            <h3>Informasi Personal</h3>
                            <div class="info-item">
                                <span class="info-label">NIM:</span>
                                <span class="info-value">{{ $alumni->nim }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Tempat, Tanggal Lahir:</span>
                                <span class="info-value">{{ $alumni->tempat_lahir }}, {{ \Carbon\Carbon::parse($alumni->tanggal_lahir)->format('d-m-Y') }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Jenis Kelamin:</span>
                                <span class="info-value">{{ $alumni->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Email:</span>
                                <span class="info-value">{{ $alumni->email }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Nomor Telepon:</span>
                                <span class="info-value">{{ $alumni->nomor_telepon }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Alamat:</span>
                                <span class="info-value">{{ $alumni->alamat }}</span>
                            </div>
                        </div>

                        <!-- Academic Information -->
                        <div class="info-card">
                            <h3>Informasi Akademik</h3>
                            <div class="info-item">
                                <span class="info-label">Fakultas:</span>
                                <span class="info-value">{{ $alumni->fakultas }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Program Studi:</span>
                                <span class="info-value">{{ $alumni->program_studi }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Angkatan:</span>
                                <span class="info-value">{{ $alumni->angkatan }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Tahun Lulus:</span>
                                <span class="info-value">{{ $alumni->tahun_lulus }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">IPK:</span>
                                <span class="info-value">{{ $alumni->ipk ?? '-' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Nomor Ijazah:</span>
                                <span class="info-value">{{ $alumni->nomor_ijazah ?? '-' }}</span>
                            </div>
                        </div>

                        <!-- Career Information -->
                        <div class="info-card">
                            <h3>Informasi Karir</h3>
                            <div class="info-item">
                                <span class="info-label">Status Pekerjaan:</span>
                                <span class="info-value">{{ $alumni->status_pekerjaan }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Nama Perusahaan:</span>
                                <span class="info-value">{{ $alumni->nama_perusahaan ?? '-' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Posisi/Jabatan:</span>
                                <span class="info-value">{{ $alumni->posisi_jabatan ?? '-' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Bidang Pekerjaan:</span>
                                <span class="info-value">{{ $alumni->bidang_pekerjaan ?? '-' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Tahun Mulai Bekerja:</span>
                                <span class="info-value">{{ $alumni->tahun_mulai_bekerja ?? '-' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Alamat Kantor:</span>
                                <span class="info-value">{{ $alumni->alamat_kantor ?? '-' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Pengalaman Kerja:</span>
                                <span class="info-value">{{ $alumni->pengalaman_kerja_sebelumnya ?? '-' }}</span>
                            </div>
                        </div>

                        <!-- Social Media -->
                        <div class="info-card">
                            <h3>Social Media</h3>
                            <div class="social-links">
                                @if($alumni->linkedin && $alumni->linkedin !== '-')
                                    <a href="{{ $alumni->linkedin }}" target="_blank" class="social-link">
                                        <i class="fab fa-linkedin"></i> LinkedIn
                                    </a>
                                @endif
                                @if($alumni->instagram && $alumni->instagram !== '-')
                                    <a href="{{ $alumni->instagram }}" target="_blank" class="social-link">
                                        <i class="fab fa-instagram"></i> Instagram
                                    </a>
                                @endif
                                @if($alumni->facebook && $alumni->facebook !== '-')
                                    <a href="{{ $alumni->facebook }}" target="_blank" class="social-link">
                                        <i class="fab fa-facebook"></i> Facebook
                                    </a>
                                @endif
                                @if($alumni->website_portfolio && $alumni->website_portfolio !== '-')
                                    <a href="{{ $alumni->website_portfolio }}" target="_blank" class="social-link">
                                        <i class="fas fa-globe"></i> Portfolio
                                    </a>
                                @endif
                            </div>
                            @if((!$alumni->linkedin || $alumni->linkedin === '-') && 
                                (!$alumni->instagram || $alumni->instagram === '-') && 
                                (!$alumni->facebook || $alumni->facebook === '-') && 
                                (!$alumni->website_portfolio || $alumni->website_portfolio === '-'))
                                <p style="color: rgba(255, 255, 255, 0.6); font-style: italic;">Tidak ada social media yang terdaftar</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection