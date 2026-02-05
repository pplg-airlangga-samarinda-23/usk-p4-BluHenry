<?php

?>




<!DOCTYPE html>
<html>
    <head>
        <title> latihan Landing page perpustakaan </title>
        <link href="style.css" rel="stylesheet">

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

            <div class="Home">
                <h1 class="Welcome"> 
                    Selamat Datang di Perpustakaan
                </h1>

                <p class="Pembuka">
                    Perpustakaan ini menyediakan berbagai macam buku
                    untuk menunjang kegiatan belajar dan menambah wawasan.
                </p>

                <h2 class="Fiturs">Fitur Utama</h2>
                <ul class="ListFitur">
                    <li>Melihat daftar buku</li>
                    <li>Melakukan peminjaman buku</li>
                    <li>Manajemen akun pengguna</li>
                </ul>

                <p class="Ajakans">
                    Silakan pilih menu di sebelah kiri
                    untuk mulai menggunakan aplikasi.
                </p>
            </div>
            <div class="List buku">

            </div>
            
        </div>

        <script src="Script.js"></script>
    </body>
</html>