# 📚 PERDIG Library

Sistem Manajemen Perpustakaan Digital berbasis web yang dibangun menggunakan **PHP Native** dan **MySQL**. Aplikasi ini memungkinkan pengelolaan buku, anggota, peminjaman, serta pengembalian buku secara efisien dengan dua level akses: **Admin** dan **User**.

---

## ✨ Fitur Utama

### 👤 User
- Registrasi & login akun
- Melihat katalog buku beserta detail dan cover
- Filter & pencarian buku berdasarkan kategori
- Mengajukan peminjaman buku
- Melihat riwayat peminjaman
- Mengembalikan buku
- Memberikan ulasan/review buku

### 🛠️ Admin
- Dashboard ringkasan statistik (total buku, anggota, peminjaman)
- Manajemen buku (tambah, edit, hapus, upload cover)
- Manajemen kategori buku
- Manajemen data anggota
- Persetujuan / penolakan pengajuan peminjaman
- Pengelolaan pengembalian buku
- Laporan peminjaman
- Verifikasi anggota

---

## 🗃️ Struktur Database

| Tabel | Deskripsi |
|-------|-----------|
| `buku` | Data buku (judul, penulis, penerbit, tahun, stok, cover, deskripsi, kategori) |
| `kategori` | Kategori buku (Fiksi, Agama, Hukum, Pelajaran, dll.) |
| `user` | Data pengguna dengan role `admin` atau `user` |
| `peminjaman` | Transaksi peminjaman dengan status: `menunggu` → `disetujui` → `dipinjam` → `dikembalikan` / `ditolak` |
| `ulasan` | Ulasan/review buku oleh anggota |

---

## 🗂️ Struktur Direktori

```
perdig/
├── admin/                  # Halaman panel admin
│   ├── index.php           # Dashboard admin
│   ├── buku.php            # Manajemen buku
│   ├── anggota.php         # Manajemen anggota
│   ├── kategori.php        # Manajemen kategori
│   ├── peminjaman.php      # Daftar peminjaman
│   ├── pengembalian.php    # Proses pengembalian
│   ├── verifikasi.php      # Verifikasi anggota
│   ├── laporan-peminjaman.php
│   └── ...                 # File tambah / edit / hapus
├── user/                   # Halaman panel user
│   ├── index.php           # Beranda user
│   ├── buku.php            # Katalog buku
│   ├── detail-buku.php     # Detail buku
│   ├── pinjam.php          # Ajukan peminjaman
│   ├── riwayat.php         # Riwayat peminjaman
│   ├── kembalikan.php      # Kembalikan buku
│   └── ulasan.php          # Beri ulasan
├── assets/
│   └── css/user.css        # Stylesheet user
├── uploads/                # Folder cover buku yang diunggah
├── index.php               # Halaman utama / landing page
├── login-admin.php         # Login admin
├── login-user.php          # Login user
├── register.php            # Registrasi user baru
├── logout.php              # Logout
├── koneksi.php             # Konfigurasi koneksi database
├── style.css               # Stylesheet global
└── perdig.sql              # File dump database
```

---

## ⚙️ Instalasi

### Prasyarat
- PHP >= 8.1
- MySQL / MariaDB
- Web server: Apache atau Nginx (disarankan menggunakan **XAMPP** / **Laragon**)

### Langkah Instalasi

1. **Clone atau ekstrak project** ke folder htdocs (XAMPP) atau direktori web server:
   ```bash
   # Jika menggunakan Git
   git clone https://github.com/username/perdig.git
   
   # Atau ekstrak ZIP ke:
   C:/xampp/htdocs/perdig
   ```

2. **Buat database** di phpMyAdmin atau MySQL CLI:
   ```sql
   CREATE DATABASE perdig;
   ```

3. **Import file SQL:**
   - Buka phpMyAdmin → pilih database `perdig` → tab **Import** → pilih file `perdig.sql`
   - Atau via CLI:
     ```bash
     mysql -u root -p perdig < perdig.sql
     ```

4. **Konfigurasi koneksi database** di file `koneksi.php`:
   ```php
   $host = "localhost";
   $user = "root";
   $pass = "";       // sesuaikan password MySQL kamu
   $db   = "perdig";
   ```

5. **Jalankan aplikasi** di browser:
   ```
   http://localhost/perdig
   ```

---

## 🔐 Akun Default

> Sesuaikan dengan data yang ada di tabel `user` hasil import SQL.

| Role  | Username | Password |
|-------|----------|----------|
| Admin | `admin`  | 123 |
| User  | *(registrasi baru)* | — |

---

## 🛠️ Teknologi yang Digunakan

| Teknologi | Keterangan |
|-----------|------------|
| PHP 8.1 (Native) | Backend / server-side logic |
| MySQL / MariaDB | Database |
| HTML5 & CSS3 | Struktur & styling antarmuka |
| JavaScript | Interaksi dinamis pada frontend |
| Font Awesome 6 | Ikon antarmuka |
| Google Fonts (Poppins) | Tipografi |

---

## 📸 Screenshots

> *(Tambahkan screenshot tampilan aplikasi di sini)*

---

## 🤝 Kontribusi

Pull request sangat terbuka! Untuk perubahan besar, harap buka issue terlebih dahulu untuk mendiskusikan apa yang ingin diubah.

---

## 📄 Lisensi

Project ini menggunakan lisensi [MIT](LICENSE).
