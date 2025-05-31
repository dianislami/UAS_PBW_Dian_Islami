@extends('layout')

@section('head')
<style>
    .jobs-section {
        background: rgba(15, 15, 17, 0.6);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 3rem;
        position: relative;
        overflow: hidden;
    }

    .jobs-section::before {
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

    .search-filters {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr auto;
        gap: 1.5rem;
        margin-bottom: 2.5rem;
        align-items: end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
    }

    .filter-group label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
    }

    .filter-group input,
    .filter-group select {
        padding: 0.75rem 1rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .filter-group input:focus,
    .filter-group select:focus {
        outline: none;
        border-color: #4facfe;
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.2);
    }

    .filter-group input::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .filter-group select option {
        background: #1a1a1a;
        color: white;
    }

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

    .jobs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        gap: 2rem;
    }

    .job-card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 20px;
        padding: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .job-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, #7b68ee, #ff6b9d, #4facfe, #43e97b);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .job-card:hover {
        background: rgba(255, 255, 255, 0.08);
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }

    .job-card:hover::before {
        opacity: 1;
    }

    .job-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.5rem;
        gap: 1rem;
    }

    .job-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #4facfe;
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }

    .company-name {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.8);
        font-weight: 500;
    }

    .job-status {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 0.5rem;
    }

    .job-type-badge {
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-align: center;
        min-width: 70px;
    }

    .job-type-magang { background: rgba(255, 107, 157, 0.2); color: #ff6b9d; border: 1px solid rgba(255, 107, 157, 0.3); }
    .job-type-kontrak { background: rgba(255, 193, 7, 0.2); color: #ffc107; border: 1px solid rgba(255, 193, 7, 0.3); }
    .job-type-tetap { background: rgba(67, 233, 123, 0.2); color: #43e97b; border: 1px solid rgba(67, 233, 123, 0.3); }

    .work-mode-badge {
        padding: 0.25rem 0.6rem;
        border-radius: 15px;
        font-size: 0.75rem;
        font-weight: 500;
        background: rgba(123, 104, 238, 0.2);
        color: #7b68ee;
        border: 1px solid rgba(123, 104, 238, 0.3);
    }

    .job-details {
        margin-bottom: 1rem;
        display: flex;
        gap: 10rem;
    }

    .job-location, .job-deadline, .job-posted,
    .job-email, .job-phone {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 0.8rem;
        font-size: 0.95rem;
    }

    .job-salary {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 0.8rem;
        font-size: 0.95rem;
    }

    .job-description {
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.6;
        margin-bottom: 1.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        background: linear-gradient(45deg, #4facfe42, #16cb533d);
        border-left: 3px solid #7abcf5;
        padding: 1rem 1.25rem;
        border-radius: 12px;
    }

    .job-actions {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .btn-apply {
        flex: 1;
        padding: 0.8rem 1.5rem;
        background: linear-gradient(135deg, #4facfe, #43e97b);
        border: none;
        border-radius: 12px;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-apply:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(79, 172, 254, 0.3);
        color: white;
        text-decoration: none;
    }

    .btn-contact {
        padding: 0.8rem;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        color: rgba(255, 255, 255, 0.8);
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-contact:hover {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        text-decoration: none;
    }

    .no-jobs-message {
        text-align: center;
        padding: 4rem 2rem;
        color: rgba(255, 255, 255, 0.6);
    }

    .no-jobs-message i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .no-jobs-message h3 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
        color: rgba(255, 255, 255, 0.7);
    }

    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 3rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }

        .jobs-section {
            padding: 2rem;
        }

        .search-filters {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .jobs-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .job-card {
            padding: 1.5rem;
        }

        .job-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .job-status {
            flex-direction: row;
            align-items: center;
            gap: 0.5rem;
        }

        .job-actions {
            flex-direction: column;
            gap: 0.8rem;
        }

        .btn-apply {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .jobs-section {
            padding: 1.5rem;
        }

        .job-card {
            padding: 1.2rem;
        }

        .job-title {
            font-size: 1.2rem;
        }

        .company-name {
            font-size: 1rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container-alumni">
    <div class="card">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; padding-bottom: 1rem;">
            <h1>Lowongan Kerja</h1>
            <a href="{{ route('tambah_lowongan') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Lowongan
            </a>
        </div>
        
        <div class="jobs-section">
            <!-- Search and Filter Section -->
            <form id="filter-form" method="GET">
                <div class="search-filters">
                    <div class="filter-group">
                        <label for="search">Cari Lowongan</label>
                        <input type="text" id="search" name="search" placeholder="Masukkan kata kunci..." value="{{ request('search') }}" />
                    </div>
                    <div class="filter-group">
                        <label for="location">Lokasi</label>
                        <select id="location" name="location">
                            <option value="">Semua Lokasi</option>
                            @foreach($lowongan->pluck('lokasi')->unique()->filter() as $lokasi)
                                <option value="{{ $lokasi }}" {{ request('location') == $lokasi ? 'selected' : '' }}>
                                    {{ $lokasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="job-type">Jenis Pekerjaan</label>
                        <select id="job-type" name="job_type">
                            <option value="">Semua Jenis</option>
                            <option value="Magang" {{ request('job_type') == 'Magang' ? 'selected' : '' }}>Magang</option>
                            <option value="Kontrak" {{ request('job_type') == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                            <option value="Tetap" {{ request('job_type') == 'Tetap' ? 'selected' : '' }}>Tetap</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-search">
                        <i class="fas fa-search"></i>
                        Cari
                    </button>
                </div>
            </form>

            <!-- Jobs Grid -->
            <div class="jobs-grid" id="jobs-container">
                @forelse($lowongan as $job)
                    <div class="job-card">
                        <div class="job-header">
                            <div>
                                <h3 class="job-title">{{ $job->judul }}</h3>
                                <p class="company-name">{{ $job->perusahaan }}</p>
                            </div>
                            <div class="job-status">
                                <span class="job-type-badge job-type-{{ strtolower($job->jenis_pekerjaan) }}">
                                    {{ $job->jenis_pekerjaan }}
                                </span>
                                <span class="work-mode-badge">{{ $job->sistem_kerja }}</span>
                            </div>
                        </div>
                        
                        <div class="job-details">
                            <div>
                                <div class="job-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $job->lokasi }}</span>
                                </div>

                                @if($job->gaji_min || $job->gaji_max)
                                    <div class="job-salary">
                                        <i class="fas fa-money-bill-wave"></i>
                                        <span>
                                            @if($job->gaji_min && $job->gaji_max)
                                                Rp {{ number_format($job->gaji_min) }} - Rp {{ number_format($job->gaji_max) }}
                                            @elseif($job->gaji_min)
                                                Mulai dari Rp {{ number_format($job->gaji_min) }}
                                            @else
                                                Hingga Rp {{ number_format($job->gaji_max) }}
                                            @endif
                                        </span>
                                    </div>
                                @endif
                                @if($job->tanggal_berakhir)
                                    <div class="job-deadline">
                                        <i class="fas fa-clock"></i>
                                        <span>Berakhir: {{ \Carbon\Carbon::parse($job->tanggal_berakhir)->format('d M Y') }}</span>
                                    </div>
                                @endif
                            </div>

                            <div class="job-contact mt-3">
                                @if($job->kontak_email)
                                    <div class="job-email">
                                        <i class="fas fa-envelope"></i>
                                        <span>{{ $job->kontak_email }}</span>
                                    </div>
                                @endif

                                @if($job->kontak_telepon)
                                    <div class="job-phone">
                                        <i class="fas fa-phone"></i>
                                        <span>{{ $job->kontak_telepon }}</span>
                                    </div>
                                @endif

                                @if($job->created_at)
                                    <div class="job-posted">
                                        <i class="fas fa-calendar-plus"></i>
                                        <span>Diposting: {{ $job->created_at->diffForHumans() }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="job-description">
                            {{ Str::limit($job->deskripsi, 200) }}
                        </div>

                        <div class="job-actions">
                            <a href="{{ $job->link_pendaftaran }}" target="_blank" class="btn-apply">
                                <i class="fas fa-paper-plane"></i>
                                Lamar Sekarang
                            </a>

                            <a href="{{ route('edit_lowongan', $job) }}" class="btn-contact" title="Edit Lowongan">
                                <i class="fas fa-pen"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="no-jobs-message">
                        <i class="fas fa-search"></i>
                        <h3>Tidak ada lowongan yang ditemukan</h3>
                        <p>Belum ada lowongan kerja yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            {{-- @if($lowongan->hasPages())
                <div class="pagination-wrapper">
                    {{ $lowongan->appends(request()->query())->links() }}
                </div>
            @endif --}}
        </div>
    </div>
</div>


<script>
// Auto-submit form when filters change
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('filter-form');
    const inputs = form.querySelectorAll('input, select');
    
    inputs.forEach(input => {
        input.addEventListener('change', function() {
            if (this.type !== 'text') {
                form.submit();
            }
        });
    });
    
    // For text input, submit on Enter key
    document.getElementById('search').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            form.submit();
        }
    });
});
</script>
@endsection