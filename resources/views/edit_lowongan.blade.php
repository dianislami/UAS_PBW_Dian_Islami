@extends('layout')

@section('head')
<style>
    .form-section {
        background: rgba(15, 15, 17, 0.6);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 3rem;
        position: relative;
        overflow: hidden;
    }

    .form-section::before {
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

    .form-header {
        margin-bottom: 2.5rem;
        text-align: center;
    }

    .form-header h1 {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        background: linear-gradient(45deg, #ffffff, rgba(255, 255, 255, 0.8));
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .form-header p {
        color: rgba(255, 255, 255, 0.7);
        font-size: 1.1rem;
    }

    .form-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .form-group-full {
        grid-column: 1 / -1;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 1.5rem;
    }

    .form-group label {
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-group label .required {
        color: #ff6b9d;
        font-size: 0.8rem;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 1rem 1.25rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.08);
        color: white;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #4facfe;
        background: rgba(255, 255, 255, 0.12);
        box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.2);
        transform: translateY(-2px);
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .form-group select option {
        background: #1a1a1a;
        color: white;
        padding: 0.5rem;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 120px;
        font-family: inherit;
        line-height: 1.6;
    }

    .salary-group {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        gap: 1rem;
        align-items: end;
    }

    .salary-separator {
        color: rgba(255, 255, 255, 0.6);
        font-weight: 600;
        font-size: 1.1rem;
        padding-bottom: 1rem;
        text-align: center;
    }

    .form-actions {
        display: flex;
        gap: 1.5rem;
        justify-content: start;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .btn-submit {
        padding: 1rem 2.5rem;
        background: linear-gradient(135deg, #4facfe, #43e97b);
        border: none;
        border-radius: 16px;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1rem;
        position: relative;
        overflow: hidden;
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(79, 172, 254, 0.4);
    }

    .btn-submit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-submit:hover::before {
        left: 100%;
    }

    .btn-cancel {
        padding: 1rem 2.5rem;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 16px;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1rem;
    }

    .btn-cancel:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
        color: white;
        text-decoration: none;
    }

    .form-section-divider {
        display: flex;
        align-items: center;
        margin: 2.5rem 0;
        gap: 1rem;
    }

    .form-section-divider::before,
    .form-section-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    }

    .form-section-title {
        color: rgba(255, 255, 255, 0.8);
        font-weight: 600;
        font-size: 1rem;
        white-space: nowrap;
        padding: 0 1rem;
    }

    .input-icon {
        position: relative;
    }

    .input-icon i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.9rem;
    }

    .input-icon input,
    .input-icon select {
        padding-left: 3rem;
    }

    .form-help-text {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.6);
        margin-top: 0.5rem;
        line-height: 1.4;
    }

    .error-message {
        color: #ff6b9d;
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Loading state */
    .btn-submit:disabled, .btn-delete:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }

    .btn-submit .loading, .btn-delete .loading {
        display: none;
        animation: spin 1s linear infinite;
    }

    .btn-submit.loading .loading, .btn-delete.loading .loading {
        display: inline-block;
    }

    .btn-submit.loading .text, .btn-delete.loading .text {
        display: none;
    }

    .btn-delete {
        padding: 1rem 2.5rem;
        background: linear-gradient(135deg, #ff6b9d, #ff4757);
        border: none;
        border-radius: 16px;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1rem;
    }

    .btn-delete:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(255, 107, 157, 0.4);
        background: linear-gradient(135deg, #ff4757, #ff3742);
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .form-section {
            padding: 2rem;
            margin: 1rem;
        }

        .form-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .salary-group {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .salary-separator {
            display: none;
        }

        .form-actions {
            flex-direction: column;
            gap: 1rem;
        }

        .btn-submit,
        .btn-cancel {
            width: 100%;
            justify-content: center;
        }

        .form-header h1 {
            font-size: 1.8rem;
        }
    }

    @media (max-width: 480px) {
        .form-section {
            padding: 1.5rem;
        }

        .form-header h1 {
            font-size: 1.6rem;
        }

        .form-header p {
            font-size: 1rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container-alumni">
    <div class="form-section">
        <div class="form-header">
            <h1>Edit Lowongan Kerja</h1>
            <p>Perbarui informasi lowongan kerja</p>
        </div>

        <div class="form-container">
            <form method="POST" action="{{ route('lowongan_update', $lowongan->id) }}" id="edit-form">
                @csrf
                @method('PUT')
                
                <!-- Informasi Dasar -->
                <div class="form-grid">
                    <div class="form-group form-group-full">
                        <label for="judul">
                            <i class="fas fa-briefcase"></i>
                            Judul Lowongan <span class="required">*</span>
                        </label>
                        <div class="input-icon">
                            <i class="fas fa-briefcase"></i>
                            <input type="text" id="judul" name="judul" 
                                   placeholder="Contoh: Software Engineer, Marketing Manager" 
                                   value="{{ old('judul', $lowongan->judul) }}" required>
                        </div>
                        @error('judul')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="perusahaan">
                            <i class="fas fa-building"></i>
                            Nama Perusahaan <span class="required">*</span>
                        </label>
                        <div class="input-icon">
                            <i class="fas fa-building"></i>
                            <input type="text" id="perusahaan" name="perusahaan" 
                                   placeholder="Masukkan nama perusahaan" 
                                   value="{{ old('perusahaan', $lowongan->perusahaan) }}" required>
                        </div>
                        @error('perusahaan')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="lokasi">
                            <i class="fas fa-map-marker-alt"></i>
                            Lokasi <span class="required">*</span>
                        </label>
                        <div class="input-icon">
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" id="lokasi" name="lokasi" 
                                   placeholder="Contoh: Jakarta, Bandung, Remote" 
                                   value="{{ old('lokasi', $lowongan->lokasi) }}" required>
                        </div>
                        @error('lokasi')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jenis_pekerjaan">
                            <i class="fas fa-user-tie"></i>
                            Jenis Pekerjaan <span class="required">*</span>
                        </label>
                        <div class="input-icon">
                            <i class="fas fa-user-tie"></i>
                            <select id="jenis_pekerjaan" name="jenis_pekerjaan" required>
                                <option value="">Pilih Jenis Pekerjaan</option>
                                <option value="Magang" {{ old('jenis_pekerjaan', $lowongan->jenis_pekerjaan) == 'Magang' ? 'selected' : '' }}>Magang</option>
                                <option value="Kontrak" {{ old('jenis_pekerjaan', $lowongan->jenis_pekerjaan) == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                                <option value="Tetap" {{ old('jenis_pekerjaan', $lowongan->jenis_pekerjaan) == 'Tetap' ? 'selected' : '' }}>Tetap</option>
                            </select>
                        </div>
                        @error('jenis_pekerjaan')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sistem_kerja">
                            <i class="fas fa-laptop-house"></i>
                            Sistem Kerja <span class="required">*</span>
                        </label>
                        <div class="input-icon">
                            <i class="fas fa-laptop-house"></i>
                            <select id="sistem_kerja" name="sistem_kerja" required>
                                <option value="">Pilih Sistem Kerja</option>
                                <option value="WFO" {{ old('sistem_kerja', $lowongan->sistem_kerja) == 'WFO' ? 'selected' : '' }}>Work From Office (WFO)</option>
                                <option value="WFH" {{ old('sistem_kerja', $lowongan->sistem_kerja) == 'WFH' ? 'selected' : '' }}>Work From Home (WFH)</option>
                                <option value="Hybrid" {{ old('sistem_kerja', $lowongan->sistem_kerja) == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                            </select>
                        </div>
                        @error('sistem_kerja')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Gaji -->
                <div class="form-section-divider">
                    <span class="form-section-title">Informasi Gaji</span>
                </div>

                <div class="form-group">
                    <label>
                        <i class="fas fa-money-bill-wave"></i>
                        Range Gaji (Opsional)
                    </label>
                    <div class="salary-group">
                        <div>
                            <input type="text" name="gaji_min" placeholder="Gaji minimum" 
                                   value="{{ old('gaji_min', $lowongan->gaji_min ? number_format($lowongan->gaji_min, 0, ',', '.') : '') }}" 
                                   oninput="formatRupiah(this)">
                        </div>
                        <div class="salary-separator">s/d</div>
                        <div>
                            <input type="text" name="gaji_max" placeholder="Gaji maksimum" 
                                   value="{{ old('gaji_max', $lowongan->gaji_max ? number_format($lowongan->gaji_max, 0, ',', '.') : '') }}" 
                                   oninput="formatRupiah(this)">
                        </div>
                    </div>
                    <div class="form-help-text">
                        <i class="fas fa-info-circle"></i>
                        Kosongkan jika tidak ingin mencantumkan informasi gaji
                    </div>
                    @error('gaji_min')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                    @error('gaji_max')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="form-section-divider">
                    <span class="form-section-title">Deskripsi & Persyaratan</span>
                </div>

                <div class="form-group">
                    <label for="deskripsi">
                        <i class="fas fa-file-alt"></i>
                        Deskripsi Pekerjaan <span class="required">*</span>
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="8" 
                              placeholder="Deskripsikan detail pekerjaan, tanggung jawab, persyaratan, kualifikasi, dan benefit yang ditawarkan..." required>{{ old('deskripsi', $lowongan->deskripsi) }}</textarea>
                    <div class="form-help-text">
                        <i class="fas fa-lightbulb"></i>
                        Berikan informasi yang lengkap dan jelas untuk menarik kandidat terbaik
                    </div>
                    @error('deskripsi')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Kontak & Pendaftaran -->
                <div class="form-section-divider">
                    <span class="form-section-title">Informasi Kontak & Pendaftaran</span>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="kontak_email">
                            <i class="fas fa-envelope"></i>
                            Email Kontak
                        </label>
                        <div class="input-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="kontak_email" name="kontak_email" 
                                   placeholder="email@perusahaan.com" 
                                   value="{{ old('kontak_email', $lowongan->kontak_email) }}">
                        </div>
                        @error('kontak_email')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kontak_telepon">
                            <i class="fas fa-phone"></i>
                            Nomor Telepon
                        </label>
                        <div class="input-icon">
                            <i class="fas fa-phone"></i>
                            <input type="tel" id="kontak_telepon" name="kontak_telepon" 
                                   placeholder="08123456789" 
                                   value="{{ old('kontak_telepon', $lowongan->kontak_telepon) }}">
                        </div>
                        @error('kontak_telepon')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group form-group-full">
                        <label for="link_pendaftaran">
                            <i class="fas fa-link"></i>
                            Link Pendaftaran
                        </label>
                        <div class="input-icon">
                            <i class="fas fa-link"></i>
                            <input type="url" id="link_pendaftaran" name="link_pendaftaran" 
                                   placeholder="https://karir.perusahaan.com/apply" 
                                   value="{{ old('link_pendaftaran', $lowongan->link_pendaftaran) }}">
                        </div>
                        <div class="form-help-text">
                            <i class="fas fa-info-circle"></i>
                            Jika ada link khusus untuk pendaftaran online
                        </div>
                        @error('link_pendaftaran')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_berakhir">
                            <i class="fas fa-calendar-alt"></i>
                            Tanggal Berakhir
                        </label>
                        <div class="input-icon">
                            <i class="fas fa-calendar-alt"></i>
                            <input type="date" id="tanggal_berakhir" name="tanggal_berakhir" 
                                   value="{{ old('tanggal_berakhir', $lowongan->tanggal_berakhir ? $lowongan->tanggal_berakhir->format('Y-m-d') : '') }}" 
                                   min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-help-text">
                            <i class="fas fa-clock"></i>
                            Batas waktu penerimaan lamaran
                        </div>
                        @error('tanggal_berakhir')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('lowongan') }}" class="btn-cancel">
                        <i class="fas fa-times"></i>
                        Batal
                    </a>
                    <button type="submit" class="btn-submit" id="submit-btn">
                        <i class="fas fa-spinner loading"></i>
                        <span class="text">
                            <i class="fas fa-save"></i>
                            Perbarui Lowongan
                        </span>
                    </button>
                </div>
            </form>
            <form method="POST" action="{{ route('lowongan_destroy', $lowongan->id) }}" 
                style="display: flex; justify-content: flex-end; margin-top: -3.2rem;" id="dlt-form" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete" id="delete-btn">
                    <i class="fas fa-spinner loading"></i>
                    <span class="text">
                        <i class="fas fa-trash"></i>
                        Hapus Lowongan
                    </span>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('edit-form');
    const submitBtn = document.getElementById('submit-btn');

    // Format Rupiah input
    function formatRupiah(input) {
        let value = input.value.replace(/[^\d]/g, '');
        if (value) {
            value = parseInt(value).toLocaleString('id-ID');
        }
        input.value = value;
    }

    // Make formatRupiah globally accessible
    window.formatRupiah = formatRupiah;

    // Form submission with loading state
    form.addEventListener('submit', function(e) {
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
        
        // Convert formatted rupiah back to numbers
        const gajiMinInput = document.querySelector('input[name="gaji_min"]');
        const gajiMaxInput = document.querySelector('input[name="gaji_max"]');
        
        if (gajiMinInput.value) {
            gajiMinInput.value = gajiMinInput.value.replace(/[^\d]/g, '');
        }
        if (gajiMaxInput.value) {
            gajiMaxInput.value = gajiMaxInput.value.replace(/[^\d]/g, '');
        }
    });

    // Animasi loading untuk tombol hapus
    const deleteForm = document.getElementById('dlt-form');
    const deleteBtn = document.getElementById('delete-btn');
    if (deleteForm && deleteBtn) {
        deleteForm.addEventListener('submit', function() {
            deleteBtn.classList.add('loading');
            deleteBtn.disabled = true;
        });
    }

    // Auto-resize textarea
    const textarea = document.getElementById('deskripsi');
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });

    // Set initial textarea height based on content
    textarea.style.height = 'auto';
    textarea.style.height = textarea.scrollHeight + 'px';

    // Add form validation feedback
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
    inputs.forEach(input => {
        input.addEventListener('invalid', function(e) {
            e.preventDefault();
            this.style.borderColor = '#ff6b9d';
            this.style.boxShadow = '0 0 0 3px rgba(255, 107, 157, 0.2)';
        });

        input.addEventListener('input', function() {
            if (this.checkValidity()) {
                this.style.borderColor = 'rgba(255, 255, 255, 0.2)';
                this.style.boxShadow = 'none';
            }
        });
    });

    // Enhanced form interactions
    const formGroups = document.querySelectorAll('.form-group');
    formGroups.forEach(group => {
        const input = group.querySelector('input, select, textarea');
        if (input) {
            input.addEventListener('focus', function() {
                group.style.transform = 'translateY(-2px)';
                group.style.transition = 'transform 0.3s ease';
            });

            input.addEventListener('blur', function() {
                group.style.transform = 'translateY(0)';
            });
        }
    });

    // Add character counter for textarea
    const deskripsiTextarea = document.getElementById('deskripsi');
    const charCounter = document.createElement('div');
    charCounter.style.cssText = `
        text-align: right;
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.5);
        margin-top: 0.5rem;
    `;
    deskripsiTextarea.parentNode.appendChild(charCounter);

    function updateCharCounter() {
        const length = deskripsiTextarea.value.length;
        charCounter.textContent = `${length} karakter`;
        
        if (length > 1000) {
            charCounter.style.color = '#ff6b9d';
        } else if (length > 800) {
            charCounter.style.color = '#ffc107';
        } else {
            charCounter.style.color = 'rgba(255, 255, 255, 0.5)';
        }
    }

    deskripsiTextarea.addEventListener('input', updateCharCounter);
    updateCharCounter();
});

// Add smooth animations when form loads
window.addEventListener('load', () => {
    const formGroups = document.querySelectorAll('.form-group');
    formGroups.forEach((group, index) => {
        group.style.opacity = '0';
        group.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            group.style.transition = 'all 0.6s ease';
            group.style.opacity = '1';
            group.style.transform = 'translateY(0)';
        }, index * 50);
    });
});
</script>
@endsection