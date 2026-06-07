<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>PERDIG Library</title>

<!-- FONT -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<!-- ICON -->
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;

    font-family:'Poppins',sans-serif;
}

html{
    scroll-behavior:smooth;
}

body{
    background:#f8fafc;
    color:#1e293b;
}

/* =========================
   NAVBAR
========================= */

nav{

    width:100%;

    padding:20px 8%;

    display:flex;
    justify-content:space-between;
    align-items:center;

    position:fixed;

    top:0;

    z-index:1000;

    background:rgba(255,255,255,0.9);

    backdrop-filter:blur(10px);

    box-shadow:0 5px 20px rgba(0,0,0,0.05);
}

.logo{

    font-size:30px;

    font-weight:700;

    color:#6366f1;
}

.nav-menu{

    display:flex;
    gap:30px;
}

.nav-menu a{

    text-decoration:none;

    color:#334155;

    font-weight:500;

    transition:0.3s;
}

.nav-menu a:hover{

    color:#6366f1;
}

/* =========================
   HERO
========================= */

.hero{

    min-height:100vh;

    display:flex;
    align-items:center;
    justify-content:space-between;

    padding:120px 8% 80px;

    background:
    linear-gradient(
        135deg,
        #6366f1,
        #8b5cf6
    );

    color:white;
}

.hero-text{

    max-width:600px;
}

.hero-text h1{

    font-size:62px;

    margin-bottom:20px;

    line-height:1.2;
}

.hero-text p{

    font-size:18px;

    line-height:1.9;

    margin-bottom:35px;
}

.hero-btn{

    display:inline-block;

    padding:15px 30px;

    background:white;

    color:#6366f1;

    border-radius:14px;

    text-decoration:none;

    font-weight:600;

    transition:0.3s;
}

.hero-btn:hover{

    transform:translateY(-3px);
}

.hero-image img{

    width:430px;
}

/* =========================
   ABOUT
========================= */

.about{

    padding:100px 8%;
}

.section-title{

    text-align:center;

    margin-bottom:60px;
}

.section-title h2{

    font-size:42px;

    margin-bottom:10px;

    color:#1e293b;
}

.section-title p{

    color:#64748b;
}

.about-content{

    display:grid;

    grid-template-columns:1fr 1fr;

    gap:40px;
}

.about-card{

    background:white;

    padding:35px;

    border-radius:25px;

    box-shadow:0 10px 30px rgba(0,0,0,0.05);

    transition:0.3s;
}

.about-card:hover{

    transform:translateY(-5px);
}

.about-card h3{

    margin-bottom:15px;

    color:#6366f1;
}

.about-card p{

    color:#475569;

    line-height:1.9;
}

/* =========================
   TEAM
========================= */

.team{

    padding:100px 8%;

    background:#eef2ff;
}

.team-container{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:25px;
    max-width:1400px;
    margin:auto;
}

.team-card{

    background:white;

    border-radius:24px;

    padding:25px;

    text-align:center;

    box-shadow:0 10px 30px rgba(0,0,0,.05);

    transition:.3s;

    min-height:320px;

    display:flex;

    flex-direction:column;

    justify-content:center;

    align-items:center;

}

.team-card:hover{

    transform:translateY(-6px);

}

.team-card img{

    width:110px;
    height:110px;

    border-radius:50%;

    object-fit:cover;

    margin-bottom:20px;

    border:5px solid #eef2ff;

}
.team-card h3{

    font-size:22px;

    line-height:1.4;

    margin-bottom:10px;

    color:#1e293b;

}

.role{

    color:#6366f1;

    font-size:18px;

    font-weight:600;

}

.team-card p{

    font-size:14px;

    color:#64748b;

    line-height:1.9;
}

/* =========================
   CONTRIBUTION
========================= */

.contribution{

    margin-top:60px;

    background:white;

    padding:35px;

    border-radius:25px;

    text-align:center;

    box-shadow:0 10px 30px rgba(0,0,0,0.05);
}

.contribution p{

    color:#64748b;

    line-height:1.9;

    max-width:900px;

    margin:auto;
}

/* =========================
   LOGIN
========================= */

.login-section{

    padding:100px 8%;

    text-align:center;
}

.login-box{

    background:white;

    padding:50px;

    border-radius:30px;

    max-width:650px;

    margin:auto;

    box-shadow:0 10px 30px rgba(0,0,0,0.05);
}

.login-box h2{

    margin-bottom:15px;

    font-size:38px;
}

.login-box p{

    color:#64748b;

    line-height:1.8;
}

.login-buttons{

    display:flex;
    gap:20px;

    justify-content:center;

    margin-top:35px;
}

.login-buttons a{

    padding:14px 30px;

    border-radius:14px;

    text-decoration:none;

    color:white;

    background:
    linear-gradient(
        135deg,
        #6366f1,
        #8b5cf6
    );

    font-weight:600;

    transition:0.3s;
}

.login-buttons a:hover{

    transform:translateY(-3px);
}

/* =========================
   FOOTER
========================= */

footer{

    background:#1e293b;

    color:white;

    text-align:center;

    padding:25px;
}

/* =========================
   RESPONSIVE
========================= */

@media(max-width:900px){

    .hero{

        flex-direction:column;
        text-align:center;
    }

    .hero-text h1{

        font-size:42px;
    }

    .hero-image img{

        width:100%;

        margin-top:40px;
    }

    .about-content{

        grid-template-columns:1fr;
    }

    .login-buttons{

        flex-direction:column;
    }

    .nav-menu{

        gap:15px;
    }
}

.developer-section{
    padding:100px 8%;
    background:#f8faff;
}

.developer-title{
    text-align:center;
    margin-bottom:60px;
}

.developer-title h2{
    font-size:42px;
    color:#1e293b;
    margin-bottom:10px;
}

.developer-title p{
    color:#64748b;
}

.developer-grid{
    display:grid;
    grid-template-columns:repeat(5, 1fr);
    gap:20px;
}

.developer-card{
    background:#fff;
    border-radius:25px;
    padding:30px 20px;
    text-align:center;
    box-shadow:0 10px 30px rgba(99,102,241,.08);
    transition:.3s;
}

.developer-card:hover{
    transform:translateY(-8px);
}

.developer-card img{
    width:120px;
    height:120px;
    object-fit:cover;
    border-radius:50%;
    border:5px solid #eef2ff;
    margin-bottom:20px;
}

.developer-card h3{
    font-size:15px;
    color:#1e293b;
    margin-bottom:10px;
    line-height:1.4;
}

.developer-card span{
    display:block;
    color:#6366f1;
    font-weight:600;
    font-size:15px;
}

/* Tablet */
@media(max-width:1200px){
    .developer-grid{
        grid-template-columns:repeat(3,1fr);
    }
}

/* HP */
@media(max-width:768px){
    .developer-grid{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:500px){
    .developer-grid{
        grid-template-columns:1fr;
    }
}

</style>

</head>

<body>

<!-- NAVBAR -->
<nav>

<div class="logo">

PERDIG

</div>

<div class="nav-menu">

<a href="#home">Home</a>
<a href="#about">Tentang</a>
<a href="#team">Developer</a>
<a href="#login">Login</a>

</div>

</nav>

<!-- HERO -->
<section class="hero" id="home">

<div class="hero-text">

<h1>
Selamat Datang di PERDIG Library
</h1>

<p>
PERDIG (Perpustakaan Digital) merupakan project
mata kuliah Praktikum Basis Data yang dikembangkan
oleh Kelompok 5. Sistem ini dirancang untuk membantu
admin dalam mengelola data perpustakaan serta
memudahkan pengguna melakukan peminjaman buku
secara digital dan terintegrasi.

</p>

<a href="#login" class="hero-btn">

Mulai Sekarang

</a>

</div>

<div class="hero-image">

<img src="https://cdn-icons-png.flaticon.com/512/2232/2232688.png">

</div>

</section>

<!-- ABOUT -->
<section class="about" id="about">

<div class="section-title">

<h2>Tentang Project</h2>

<p>Penjelasan mengenai sistem perpustakaan digital</p>

</div>

<div class="about-content">

<div class="about-card">

<h3>Latar Belakang Project</h3>

<p>

Project PERDIG dibuat sebagai implementasi
konsep basis data relasional pada mata kuliah
Praktikum Basis Data. Sistem ini bertujuan
membantu proses pengelolaan perpustakaan
menjadi lebih terstruktur, cepat, dan efisien
melalui digitalisasi layanan perpustakaan.

</p>

</div>

<div class="about-card">

<h3>Fitur Sistem</h3>

<p>

• Login Admin dan User<br>
• Pengelolaan Data Buku<br>
• Pengelolaan Data Kategori<br>
• Pengelolaan Data Anggota<br>
• Pengajuan Peminjaman Buku<br>
• Verifikasi dan Pengembalian Buku<br>
• Riwayat Peminjaman<br>
• Sistem Ulasan dan Rating Buku<br>
• Laporan Data Peminjaman

</p>

</div>

</div>

</section>

<<section class="developer-section" id="team">

    <div class="developer-title">
        <h2>KELOMPOK 5 </h2>
        <p>Praktikum Basis Data - Project Perpustakaan Digital</p>
    </div>

    <div class="developer-grid">

        <div class="developer-card">
            <img src="assets/suli.jpeg">
            <h3>Sultan Nicho Rahmatulloh</h3>
            <span>5325600002</span>
        </div>

        <div class="developer-card">
            <img src="assets/niko.jpeg">
            <h3>Muhammad Niko Adithya Pratama</h3>
            <span>5325600004</span>
        </div>

        <div class="developer-card">
            <img src="assets/nicho.jpeg">
            <h3>Muhammad Nicho Dony Syaputra</h3>
            <span>5325600023</span>
        </div>

        <div class="developer-card">
            <img src="assets/atha.jpeg">
            <h3>Atha <br> Anabella </br></h3>
            <span>5325600024</span>
        </div>

        <div class="developer-card">
            <img src="assets/bai.jpeg">
            <h3>Baihaqi Ali Supriatman</h3>
            <span>5325600022</span>
        </div>

    </div>

    <!-- CONTRIBUTION -->
    <div class="contribution">

    <p>
    Project ini dikembangkan oleh Kelompok 5
    sebagai tugas akhir mata kuliah Praktikum
    Basis Data. Sistem memanfaatkan database
    MySQL untuk mengelola data buku, anggota,
    peminjaman, pengembalian, kategori, serta
    ulasan buku dalam satu aplikasi perpustakaan
    digital yang terintegrasi.

    </p>

    </div>

</section>

<!-- LOGIN -->
<section class="login-section" id="login">

<div class="login-box">

<h2>Pilih Login</h2>

<p>

Masuk sebagai admin atau user
untuk mengakses fitur PERDIG Library.

</p>

<div class="login-buttons">

<a href="login-admin.php">

Login Admin

</a>

<a href="login-user.php">

Login User

</a>

</div>

</div>

</section>

<!-- FOOTER -->
<footer>

PERDIG - Project Praktikum Basis Data
Kelompok 5 © 2026

</footer>

</body>
</html>