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
Menyimpan definisi semua rute (URL) yang digunakan aplikasi, dan menentukan controller atau fungsi apa yang akan dijalankan ketika rute tersebut diakses.
### resoirces/views/
Tempat menyimpan file tampilan (view) berbasis Blade yang digunakan untuk menampilkan antarmuka pengguna (UI) di browser.
### database/migrations/
Berisi file migrasi & seeder yang digunakan untuk mendefinisikan struktur tabel database secara versioned dan terkontrol serta mengisi data dummy.
### database/seeders/
