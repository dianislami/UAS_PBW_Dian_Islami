# Proyek UAS PBW
## Nama: Dian Islami
## NPM : 2308107010048

## Deskripsi Proyek
Proyek ini bertujuan untuk membangun sebuah aplikasi berbasis web sederhana menggunakan Laravel yang dapat membantu institusi pendidikan dalam mengelola data alumni sekaligus menyediakan informasi lowongan pekerjaan secara terpusat. Sistem ini memiliki dua fitur utama, yaitu manajemen data alumni dan manajemen lowongan kerja. Fitur alumni memungkinkan pengguna untuk menambahkan, mengedit, atau menghapus data alumni serta melihat status alumni seperti bekerja, kuliah, atau wirausaha. Sementara itu, fitur lowongan kerja memungkinkan untuk menambahkan informasi pekerjaan yang dapat dilihat oleh pengguna lain, lengkap dengan deskripsi, lokasi, sistem kerja (WFO/WFH/Hybrid), jenis pekerjaan (magang, kontrak, tetap), dan rentang gaji. Sistem ini dilengkapi juga dengan fungsi pencarian dan tampilan detail untuk kenyamanan pengguna. Dengan menggunakan Laravel sebagai framework utama, proyek ini dirancang dengan prinsip CRUD (Create, Read, Update, Delete) yang sederhana namun fungsiona

## Struktur Penting Proyek
### 1. app/
Berisi inti logika aplikasi seperti model, controller, dan service yang menjalankan fungsi utama dari sistem.
#### 1) Model
* Alumni.php
#### 2) Controller
### 2. routes/
Menyimpan definisi semua rute (URL) yang digunakan aplikasi, dan menentukan controller atau fungsi apa yang akan dijalankan ketika rute tersebut diakses.
### 3. resources/views/
Tempat menyimpan file tampilan (view) berbasis Blade yang digunakan untuk menampilkan antarmuka pengguna (UI) di browser.
### 4. database/migrations/
Berisi file migrasi & seeder yang digunakan untuk mendefinisikan struktur tabel database secara versioned dan terkontrol serta mengisi data dummy.
### 5. database/seeders/
Berisi file migrasi & seeder yang digunakan untuk mendefinisikan struktur tabel database secara versioned dan terkontrol serta mengisi data dummy.
