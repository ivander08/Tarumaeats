# Tarumaeats

![Tarumaeats Logo](https://repobeats.axiom.co/api/embed/ab2c52d0a0f2dff05a8852fbe84cff4edf25bf71.svg)

## PERINGATAN: Unduh ListingsTableSeeder dengan tautan [Google Drive ini](https://drive.google.com/file/d/1628aJnRVDmIg4hOBlVpYcBAZ8H_Qweph/view?usp=sharing) terlebih dahulu karena terlalu besar untuk GitHub.

## Tim 2-TI-A
- **Ivander** (535220020)
- **Justin Salim** (535220017)
- **Willsen Yogi Prasetia** (535220010)

## Pendahuluan

Tarumaeats adalah aplikasi web yang dirancang untuk membantu mahasiswa dan pengunjung di UNTAR (Universitas Tarumanagara) menemukan tempat makan di dalam kampus. Seringkali, tempat-tempat makan seperti kantin atau kedai di institusi akademis sulit untuk ditemukan, sehingga mahasiswa sering kali melewatkan opsi makan yang nyaman. Selain itu, platform ini juga menjadi pusat bagi pemilik bisnis makanan dan minuman di universitas untuk memamerkan penawaran mereka.

## Fitur-fitur

- **Registrasi Pengguna dan Otentikasi**: Pengguna diharuskan untuk mendaftar dan memverifikasi alamat email mereka sebelum mengakses platform. Otentikasi memastikan akses yang aman dan memungkinkan pengguna untuk mengelola profil mereka.
  
- **Pencarian Listing**: Fitur pencarian memungkinkan pengguna untuk mencari tempat makan berdasarkan berbagai kriteria seperti rentang harga, jenis makanan, fitur khusus, dan jam buka.
  
- **Detail Listing**: Detail listing menyediakan informasi komprehensif tentang setiap tempat makan, termasuk gambar, nama, lokasi, rentang harga, tag, dan detail kontak.
  
- **Manajemen Gambar**: Pengguna dapat mengunggah gambar untuk listing mereka, termasuk gambar utama, gambar banner, dan gambar carousel. Manajemen gambar memungkinkan representasi visual yang menarik dari tempat makan.
  
- **Manajemen Profil Pengguna**: Pengguna dapat memperbarui informasi profil mereka, termasuk email, password, dan username.
  
- **Manajemen Listing**: Pemilik bisnis dapat mengelola listing mereka dengan menambah, mengedit, membuat, atau menghapus mereka. Setiap listing memerlukan persetujuan dari admin sebelum dapat dilihat oleh pengguna lain, untuk memastikan kualitas dan relevansi.

## Memulai

Untuk mengatur Tarumaeats secara lokal, ikuti langkah-langkah berikut:

1. **Klon Repository**: 
   ```
   git clone https://github.com/ivander08/tarumaeats.git
   ```

2. **Instal Dependensi**: Navigasikan ke direktori proyek dan instal dependensi yang diperlukan menggunakan Composer.
   ```
   cd tarumaeats
   composer install
   ```

3. **Atur Variabel Lingkungan**: Buat salinan file `.env.example` dan beri nama `.env`. Perbarui konfigurasi database dan email di file `.env`.


4. **Migrasi Database**: Jalankan migrasi untuk membuat tabel-tabel yang diperlukan di database.
   ```
   php artisan migrate:fresh
   php artisan migrate
   ```

5. **Unduh Listings Seeder**: Listings Seeder berukuran lebih dari 400MB, sehingga tidak dapat diunggah di GitHub. Unduh dengan [Google Drive Link ini](https://drive.google.com/file/d/1628aJnRVDmIg4hOBlVpYcBAZ8H_Qweph/view?usp=sharing) dan letakkan ListingsTableSeeder.php di database/seeders bersama dengan file seeder lainnya.

6. **Seed Database**: Isi database dengan data dummy menggunakan perintah `php artisan db:seed`. Ini akan mengisi database dengan data awal untuk tujuan pengujian. Tahap ini dapat memakan waktu lebih dari satu menit.
   ```
   php artisan db:seed
   ```

7. **Compile Asset**: Kompilasi asset frontend menggunakan npm.
   ```
   npm install
   npm run dev
   ```

8. **Memulai Server Pengembangan**: Gunakan perintah `php artisan serve` untuk memulai server pengembangan.
   ```
   php artisan serve
   ```

9. **Akses Aplikasi**: Buka browser web Anda dan buka `http://localhost:8000` untuk mengakses Tarumaeats.

### Akun Admin
Gunakan kredensial akun admin berikut untuk mengakses fitur admin:
- **Email**: admintarumaeats@gmail.com
- **Password**: Tarumaeats123!
