# Login PHP dengan MySQL


## Struktur Proyek

- `koneksi.php` - koneksi database MySQL.
- `login.php` - halaman form login.
- `proses_login.php` - memproses data login.
- `index.php` (opsional) - halaman tujuan setelah login berhasil.

## Deskripsi

Proyek ini menggunakan PHP dan MySQL untuk autentikasi pengguna sederhana:

1. `login.php` menampilkan form untuk memasukkan `username` dan `password`.
2. `proses_login.php` mengambil data dari form dan memeriksa tabel `tbl_user`.
3. Jika cocok, pengguna diberi session dan diarahkan ke `index.php`.
4. Jika tidak cocok, ditampilkan pesan gagal dan kembali ke `login.php`.

## Database dan Tabel

masuk ke database `basisdata2026` di MySQL, lalu jalankan SQL berikut untuk membuat tabel `tbl_user`:

```sql
CREATE TABLE tbl_user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);
```

Contoh data pengguna:

```sql
INSERT INTO tbl_user (username, password) VALUES
('[username]', '[pw]');
```

## Cara Login

1. Pastikan server web lokal Anda berjalan (misalnya XAMPP).
2. Tempatkan folder di `htdocs`.
3. Pastikan konfigurasi database di `koneksi.php` sudah benar:

```php
$host = "localhost"; 
$user = "root";// kalo namanya sudah di ubah sesuaikan user sama pwnya
$pass = "";
$db   = "basisdata2026";
```

4. Buka `http://localhost/bdweb2026/login.php` di browser.
5. Masukkan:
   - Username: `` //isi dengan username yang dimasukan ke database
   - Password: ``
6. Klik tombol `Masuk`.

Jika login berhasil, akan diarahkan ke `index.php`.

