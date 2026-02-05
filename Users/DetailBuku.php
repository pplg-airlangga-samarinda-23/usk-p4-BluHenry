<?php
include dirname(__DIR__) . '/koneksi.php';
// include '/koneksi.php'; // sesuaikan

$id = $_GET['id'];


$query = mysqli_query($koneksi, "SELECT * FROM list_buku WHERE id_buku = $id");
$buku = mysqli_fetch_assoc($query);

// status tampilan
$status = ($buku['stok'] > 0) ? 'Tersedia' : 'Tidak tersedia';


?>




<!DOCTYPE html>
<html>
    <head>
        <title> latihan Landing page perpustakaan </title>
        <link href="style.css" rel="stylesheet">
        <style>
        /* DETAIL BUKU */
.detailbuku {
    margin-left: 200px;
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px;
}

/* CARD */
.detail-card {
    background: linear-gradient(180deg, #fffdf5, #fff6dc);
    width: 380px;
    padding: 32px 30px;
    border-radius: 24px;
    box-shadow: 
        0 20px 40px rgba(0,0,0,0.12),
        inset 0 0 0 1px #f0dca6;
    text-align: center;
    animation: fadeUp 0.6s ease;
}

/* ANIMASI HALUS */
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* JUDUL */
.judul-buku {
    font-size: 24px;
    font-weight: 600;
    color: #4a3317;
    margin-bottom: 16px;
}

/* GAMBAR */
.img-buku {
    width: 160px;
    height: 220px;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: 0 8px 18px rgba(0,0,0,0.15);
    margin-bottom: 16px;
}

/* DESKRIPSI */
.detail-card p {
    font-size: 14px;
    line-height: 1.6;
    color: #6b4a23;
    margin-bottom: 10px;
}

/* INFO */
.info {
    font-size: 15px;
    margin-top: 6px;
}

/* STATUS */
.status {
    font-weight: 600;
    margin: 10px 0 20px;
}

.status.tersedia {
    color: #2e7d32;
}

.status.habis {
    color: #c62828;
}

/* TOMBOL */
.btn-pinjam {
    display: inline-block;
    margin: 6px 4px;
    padding: 10px 24px;
    background: #ffe6a8;
    border: 2px solid #c9a96a;
    border-radius: 25px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    color: #4a3317;
    transition: all 0.25s ease;
}

/* HOVER */
.btn-pinjam:hover {
    background: #ffd889;
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(0,0,0,0.15);
}

/* TOMBOL PINJAM KHUSUS */
.btn-pinjam:last-child {
    background: #f4c56b;
    border-color: #b9924a;
}

.btn-pinjam:last-child:hover {
    background: #eab84f;
}

        </style>
    </head>
    <body>
        <div class="KotakGede">
            <nav class="Container">
                <div class="judul"> Perpustakaan </div>
                <ul class="Unlist">
                    <li class="List"><a class="Col menu-Items" href="index.php"> Home </a></li>
                    <li class="List"><a class="Col menu-Items" href="ListBuku.php"> List buku </a></li>
                    <li class="List"><a class="Col menu-Items" href="Peminjaman_buku.php"> Peminjaman Buku </a></li>
                    <li class="List" id="Login"><a class="Col menu-Items" href="/index.php"> Login form </a></li>
                </ul>
                <footer class="kaki">
                    <div>
                        <p> Copyright &copy; Perpustakaan 2026 </p>
                    </div>
                </footer>
            </nav>

            <div class="detailbuku">
                <div class="detail-card">
                    <h1 class="judul-buku">Judul Buku Contoh</h1>

                    <img src="bukuGambar.png" class="img-buku">
                    <p> depskripsi : buku ini ga ada depskripsi sekedar testing doang</p>
                    <p class="info">Stok : <b>5</b></p>
                    <p class="status tersedia">Status : Tersedia</p>
                    
                    <a href="ListBuku.php" class="btn-pinjam">list buku</a>
                    <form action="Peminjaman_buku.php" method="post">
                        <input type="hidden" name="id_buku" value="<?= $buku['id_buku'] ?>">
                        <button type="submit" class="btn-pinjam">Pinjam Buku</button>
                    </form>
                </div>
            </div>
            
        </div>

        <script src="Script.js"></script>
    </body>
</html>