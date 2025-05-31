# UAS PBW 
## Dian Islami
## 2308107010048
## Deskripsi Proyek
Proyek ini bertujuan untuk membangun sebuah aplikasi berbasis web sederhana menggunakan Laravel yang dapat membantu institusi pendidikan dalam mengelola data alumni sekaligus menyediakan informasi lowongan pekerjaan secara terpusat. Sistem ini memiliki dua fitur utama, yaitu manajemen data alumni dan manajemen lowongan kerja. Fitur alumni memungkinkan pengguna untuk menambahkan, mengedit, atau menghapus data alumni serta melihat status alumni seperti bekerja, kuliah, atau wirausaha. Sementara itu, fitur lowongan kerja memungkinkan untuk menambahkan informasi pekerjaan yang dapat dilihat oleh pengguna lain, lengkap dengan deskripsi, lokasi, sistem kerja (WFO/WFH/Hybrid), jenis pekerjaan (magang, kontrak, tetap), dan rentang gaji. Sistem ini dilengkapi juga dengan fungsi pencarian dan tampilan detail untuk kenyamanan pengguna. Dengan menggunakan Laravel sebagai framework utama, proyek ini dirancang dengan prinsip CRUD (Create, Read, Update, Delete) yang sederhana namun fungsional, dan dapat dikembangkan lebih lanjut di masa depan sesuai kebutuhan.

## Struktur Penting Proyek
### app/
Berisi inti logika aplikasi seperti model, controller, dan service yang menjalankan fungsi utama dari sistem.
#### 1) Model
* Alumni.php: Model Alumni merepresentasikan data lengkap seorang alumni, mulai dari data pribadi, akademik, pekerjaan, hingga jejaring sosial. Model ini juga dilengkapi dengan accessor, scope, dan helper untuk mempermudah manipulasi dan pencarian data alumni dalam sistem.
* Lowongan.php: Model Lowongan digunakan untuk menyimpan dan mengelola data lowongan pekerjaan seperti deskripsi, sistem kerja, jenis pekerjaan, gaji, dan tanggal kadaluarsa. Model ini menyediakan scope untuk memfilter lowongan aktif serta accessor untuk memformat gaji dan tanggal secara lebih informatif.
#### 2) Controller
* AlumniController.php: Controller ini mengelola seluruh proses terkait data alumni, termasuk pencarian, filter, pengurutan, dan statistik pekerjaan alumni. Selain itu, juga menangani CRUD data alumni serta upload dan update foto profil dengan validasi lengkap.
* LowonganController.php: Controller ini mengatur proses pengelolaan lowongan kerja, mulai dari penambahan, pengeditan, pencarian, hingga filtering berdasarkan lokasi dan jenis pekerjaan. Mendukung juga AJAX untuk pemuatan data dinamis dan validasi data yang ketat sebelum disimpan.
* DashboardController.php: Controller ini menyajikan statistik ringkasan alumni berdasarkan status pekerjaan serta total jumlah lowongan untuk ditampilkan di halaman dashboard. Sederhana namun efektif sebagai pusat informasi bagi admin atau pengguna internal.
### routes/
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
### resoirces/views/
Tempat menyimpan file tampilan (view) berbasis Blade yang digunakan untuk menampilkan antarmuka pengguna (UI) di browser.
### database/migrations/
Berisi file migrasi & seeder yang digunakan untuk mendefinisikan struktur tabel database secara versioned dan terkontrol serta mengisi data dummy.
### database/seeders/
