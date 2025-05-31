# UAS PBW 
## Dian Islami
## 2308107010048
## A. Deskripsi Proyek
Proyek ini bertujuan untuk membangun sebuah aplikasi berbasis web sederhana menggunakan Laravel yang dapat membantu institusi pendidikan dalam mengelola data alumni sekaligus menyediakan informasi lowongan pekerjaan secara terpusat. Sistem ini memiliki dua fitur utama, yaitu manajemen data alumni dan manajemen lowongan kerja. Fitur alumni memungkinkan pengguna untuk menambahkan, mengedit, atau menghapus data alumni serta melihat status alumni seperti bekerja, kuliah, atau wirausaha. Sementara itu, fitur lowongan kerja memungkinkan untuk menambahkan informasi pekerjaan yang dapat dilihat oleh pengguna lain, lengkap dengan deskripsi, lokasi, sistem kerja (WFO/WFH/Hybrid), jenis pekerjaan (magang, kontrak, tetap), dan rentang gaji. Sistem ini dilengkapi juga dengan fungsi pencarian dan tampilan detail untuk kenyamanan pengguna. Dengan menggunakan Laravel sebagai framework utama, proyek ini dirancang dengan prinsip CRUD (Create, Read, Update, Delete) yang sederhana namun fungsional, dan dapat dikembangkan lebih lanjut di masa depan sesuai kebutuhan.

## B. Struktur Penting Proyek
### 1. app/
Berisi inti logika aplikasi seperti model, controller, dan service yang menjalankan fungsi utama dari sistem.
#### 1) Model
* Alumni.php: Model Alumni merepresentasikan data lengkap seorang alumni, mulai dari data pribadi, akademik, pekerjaan, hingga jejaring sosial. Model ini juga dilengkapi dengan accessor, scope, dan helper untuk mempermudah manipulasi dan pencarian data alumni dalam sistem.
* Lowongan.php: Model Lowongan digunakan untuk menyimpan dan mengelola data lowongan pekerjaan seperti deskripsi, sistem kerja, jenis pekerjaan, gaji, dan tanggal kadaluarsa. Model ini menyediakan scope untuk memfilter lowongan aktif serta accessor untuk memformat gaji dan tanggal secara lebih informatif.
#### 2) Controller
* AlumniController.php: Controller ini mengelola seluruh proses terkait data alumni, termasuk pencarian, filter, pengurutan, dan statistik pekerjaan alumni. Selain itu, juga menangani CRUD data alumni serta upload dan update foto profil dengan validasi lengkap.
* LowonganController.php: Controller ini mengatur proses pengelolaan lowongan kerja, mulai dari penambahan, pengeditan, pencarian, hingga filtering berdasarkan lokasi dan jenis pekerjaan. Mendukung juga AJAX untuk pemuatan data dinamis dan validasi data yang ketat sebelum disimpan.
* DashboardController.php: Controller ini menyajikan statistik ringkasan alumni berdasarkan status pekerjaan serta total jumlah lowongan untuk ditampilkan di halaman dashboard. Sederhana namun efektif sebagai pusat informasi bagi admin atau pengguna internal.
### 2. routes/
Menyimpan definisi semua rute (URL) yang digunakan aplikasi, dan menentukan controller atau fungsi apa yang akan dijalankan ketika rute tersebut diakses. Ada 3 rute utama:
* Dashboard: Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
 → Menampilkan halaman dashboard utama yang berisi ringkasan statistik alumni dan jumlah lowongan.
* Alumni:
    * Route::get('/alumni', [AlumniController::class, 'index'])->name('alumni'); → Menampilkan daftar alumni dengan fitur pencarian, filter, dan statistik.
    * Route::get('/alumni/create', [AlumniController::class, 'create'])->name('tambah_alumni'); → Menampilkan formulir untuk menambahkan data alumni baru.
    * Route::post('/alumni', [AlumniController::class, 'store'])->name('alumni_store'); → Menyimpan data alumni baru yang diinput dari formulir.
    * Route::get('/alumni/{alumni}', [AlumniController::class, 'show'])->name('detail_alumni'); → Menampilkan detail informasi dari alumni tertentu.
    * Route::get('/alumni/{alumni}/edit', [AlumniController::class, 'edit'])->name('edit_alumni'); → Menampilkan formulir untuk mengedit data alumni tertentu.
    * Route::put('/alumni/{alumni}', [AlumniController::class, 'update'])->name('alumni_update'); → Memperbarui data alumni berdasarkan input dari formulir edit.
    * Route::delete('/alumni/{alumni}', [AlumniController::class, 'destroy'])->name('alumni-destroy'); → Menghapus data alumni yang dipilih dari database.
* Lowongan:
    * Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan'); → Menampilkan daftar lowongan kerja dengan fitur pencarian dan filter.
    * Route::get('/lowongan/create', [LowonganController::class, 'create'])->name('tambah_lowongan'); → Menampilkan formulir untuk menambahkan lowongan kerja baru.
    * Route::post('/lowongan', [LowonganController::class, 'store'])->name('lowongan_store'); → Menyimpan data lowongan kerja baru ke database.
    * Route::get('/lowongan/{lowongan}', [LowonganController::class, 'show'])->name('lowongan.show'); → Menampilkan detail dari lowongan kerja tertentu.
    * Route::get('/lowongan/{lowongan}/edit', [LowonganController::class, 'edit'])->name('edit_lowongan'); → Menampilkan formulir untuk mengedit informasi lowongan kerja.
    * Route::put('/lowongan/{lowongan}', [LowonganController::class, 'update'])->name('lowongan_update'); → Memperbarui data lowongan kerja yang dipilih.
    * Route::delete('/lowongan/{lowongan}', [LowonganController::class, 'destroy'])->name('lowongan_destroy'); → Menghapus data lowongan kerja dari sistem.
### 3. resoirces/views/
Tempat menyimpan file tampilan (view) berbasis Blade yang digunakan untuk menampilkan antarmuka pengguna (UI) di browser. Ada 4 halaman utama:
* layout.blade.php: Merupakan file template layout utama yang digunakan oleh seluruh halaman lain sebagai kerangka dasar. Layout ini mencakup elemen-elemen seperti header, navigasi samping, dan footer agar tampilan tetap konsisten. Dengan menggunakan @yield atau @section, konten dari halaman lain akan ditampilkan di dalam layout ini.
* dashboard.blade.php: Halaman dashboard merupakan tampilan utama aplikasi ketika pengguna pertama kali masuk. Di sini ditampilkan ringkasan data penting seperti jumlah alumni, total lowongan kerja, dan grafik ringkas. Fungsinya adalah memberikan gambaran umum kondisi sistem secara cepat dan informatif.
* Alumni:
    * alumni.blade.php: Halaman ini digunakan untuk menampilkan daftar seluruh alumni yang sudah terdaftar di sistem. Pengguna dapat melihat informasi singkat seperti nama, tahun lulus, dan status pekerjaan. Halaman ini juga menyediakan fitur pencarian dan tombol untuk melihat detail atau mengedit data alumni.
    * tambah_alumni.blade.php: Halaman ini menyediakan form untuk menambahkan data alumni baru ke sistem. Pengguna dapat mengisi data seperti nama, angkatan, jurusan, dan status pekerjaan. Setelah diisi dan disubmit, data akan disimpan melalui method POST ke controller AlumniController.
    * edit_alumni.blade.php: Halaman ini digunakan untuk mengedit atau memperbarui data seorang alumni yang telah terdaftar. Formulir yang tersedia akan menampilkan data lama dan memungkinkan pengguna mengubahnya sesuai kebutuhan. Setelah diubah, data akan disimpan kembali melalui metode PUT ke controller.
    * detail_alumni.blade.php: Halaman ini menampilkan informasi lengkap dari satu alumni tertentu berdasarkan ID yang dipilih. Informasi yang ditampilkan mencakup data pribadi, riwayat pendidikan, dan pekerjaan. Halaman ini membantu pengguna untuk memeriksa atau meninjau profil alumni secara mendalam.
* Lowongan:
    * lowongan.blade.php: Halaman ini menampilkan daftar semua lowongan kerja yang tersedia di sistem. Pengguna dapat melihat detail singkat tiap lowongan dan melakukan aksi seperti lamar pekerjaan atau edit. Halaman ini juga bisa dilengkapi dengan fitur pencarian dan filter jenis pekerjaan.
    * tambah_lowongan.blade.php: Digunakan untuk memasukkan informasi lowongan kerja baru oleh pengguna. Formulir mencakup data seperti nama perusahaan, posisi, jenis kerja, lokasi, dan gaji. Setelah data diisi lengkap, sistem akan menyimpan lowongan ke dalam database melalui controller LowonganController.
    * edit_lowongan.blade.php: Halaman ini digunakan untuk mengedit informasi dari suatu lowongan pekerjaan yang sudah ditambahkan sebelumnya. Formulir berisi data seperti posisi, jenis pekerjaan, lokasi, dan kisaran gaji. Setelah diedit, perubahan disimpan melalui controller LowonganController.
### database/migrations/
Berisi file migrasi & seeder yang digunakan untuk mendefinisikan struktur tabel database secara versioned dan terkontrol serta mengisi data dummy.
#### Langkah-langkah migration:
* 1. Buat Migration: **php artisan make:migration create_alumni_table** dan **php artisan make:migration create_lowongan_pekerjaan_table**.
* 2. Definisikan Struktur Tabel: Tambahkan kolom-kolom sesuai kebutuhan pada method up() di setiap file migration. Gunakan Schema::create dan metode-metode seperti string(), enum(), text(), date(), dan timestamps().
* 3. Tambahkan Index (Opsional): Gunakan $table->index([...]) untuk meningkatkan performa query pencarian/filter.
* 4. Jalankan Migration: Jalankan perintah ini untuk membuat tabel di database: **php artisan migrate**.
* 5. Rollback Jika Perlu: Jika ingin membatalkan perubahan, jalankan perintah: **php artisan migrate:rollback**.
#### 1) Migration Alumni
* Data Pribadi: nim, nama_lengkap, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, email, nomor_telepon, foto_profil.
* Data Akademik: fakultas, program_studi, angkatan, tahun_lulus, ipk, nomor_ijazah.
* Data Karir: status_pekerjaan, nama_perusahaan, posisi_jabatan, bidang_pekerjaan, tahun_mulai_bekerja, alamat_kantor, pengalaman_kerja_sebelumnya.
* Data Sosial: linkedin, instagram, facebook, website_portfolio.
* Index: Menambahkan index pada fakultas & program_studi, angkatan & tahun_lulus, dan status_pekerjaan untuk meningkatkan performa pencarian/filtering.
#### 2) Migration Lowongan
* judul, deskripsi, perusahaan, lokasi: berisi info umum tentang lowongan.
* sistem_kerja: enum berisi nilai WFO, WFH, atau Hybrid.
* jenis_pekerjaan: enum berisi Magang, Kontrak, atau Tetap.
* gaji_min dan gaji_max: kisaran gaji (disimpan sebagai string agar fleksibel).
* kontak_email, kontak_telepon, link_pendaftaran: kontak dan cara melamar.
* tanggal_berakhir: tanggal penutupan lowongan.
### database/seeders/
