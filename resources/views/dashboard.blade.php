@extends('layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')
    <!-- Main Content -->
    <main class="main-content">
        <!-- Welcome Section -->
        <section class="welcome-section">
            <div class="welcome-content">
                <div class="welcome-text">
                    <h1>Dashboard Alumni</h1>
                    <p>Selamat datang di sistem manajemen alumni. Monitor aktivitas jaringan alumni, kelola data, dan tingkatkan konektivitas antar alumni.</p>
                </div>
            </div>
        </section>

        <!-- Stats Grid -->
        <section class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div>
                        <div class="stat-number">{{ $stats['total_alumni'] }}</div>
                        <div class="stat-label">Total Alumni</div>
                    </div>
                    <div class="stat-icon" style="background: linear-gradient(45deg, #7b68ee, #ff6b9d);">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="stat-change">+12% bulan ini</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div>
                        <div class="stat-number">{{ $stats['bekerja'] }}</div>
                        <div class="stat-label">Alumni Bekerja</div>
                    </div>
                    <div class="stat-icon" style="background: linear-gradient(45deg, #4facfe, #00f2fe);">
                        <i class="fas fa-briefcase"></i>
                    </div>
                </div>
                <div class="stat-change">+8% bulan ini</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div>
                        <div class="stat-number">{{ $stats['wiraswasta'] }}</div>
                        <div class="stat-label">Alumni Wiraswasta</div>
                    </div>
                    <div class="stat-icon" style="background: linear-gradient(45deg, #43e97b, #38f9d7);">
                        <i class="fas fa-building"></i>
                    </div>
                </div>
                <div class="stat-change">+15% bulan ini</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div>
                        <div class="stat-number">{{ $stats['lanjut_studi'] }}</div>
                        <div class="stat-label">Alumni Lanjut Studi</div>
                    </div>
                    <div class="stat-icon" style="background: linear-gradient(45deg, #43e97b, #38f9d7);">
                        <i class="fas fa-network-wired"></i>
                    </div>
                </div>
                <div class="stat-change">+15% bulan ini</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div>
                        <div class="stat-number">{{ $jumlahLowongan }}</div>
                        <div class="stat-label">Lowongan Aktif</div>
                    </div>
                    <div class="stat-icon" style="background: linear-gradient(45deg, #ffa726, #ff7043);">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div class="stat-change">+22% bulan ini</div>
            </div>
        </section>

        <!-- Quick Actions -->
        <section class="content-card">
            <div class="card-header">
                <div>
                    <h2 class="card-title">Aksi Cepat</h2>
                    <p class="card-subtitle">Fitur yang sering digunakan</p>
                </div>
            </div>
            <div style="padding: 2rem;">
                <div class="quick-actions">
                    <a href="{{ route('tambah_alumni') }}" class="quick-action">
                        <i class="fas fa-user-plus"></i>
                        <h3>Registrasi Alumni</h3>
                        <p>Daftarkan alumni baru ke sistem</p>
                    </a>
                    <a href="{{ route('tambah_lowongan') }}" class="quick-action">
                        <i class="fas fa-plus-circle"></i>
                        <h3>Posting Lowongan</h3>
                        <p>Tambah lowongan kerja baru</p>
                    </a>
                    <a href="#" class="quick-action">
                        <i class="fas fa-envelope"></i>
                        <h3>Kirim Newsletter</h3>
                        <p>Broadcasting ke semua alumni</p>
                    </a>
                    <a href="#" class="quick-action">
                        <i class="fas fa-calendar-alt"></i>
                        <h3>Event Management</h3>
                        <p>Kelola acara alumni</p>
                    </a>
                </div>
            </div>
        </section>
    </main>
@endsection