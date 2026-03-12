<?php
include dirname(__DIR__) . '/koneksi.php';

$keyword = $_GET['q'] ?? '';

if ($keyword != '') {
    $sql = "SELECT * FROM list_buku 
            WHERE Judul LIKE ? 
               OR Penulis LIKE ? 
               OR Penerbit LIKE ?";
    $stmt = $koneksi->prepare($sql);
    $like = "%$keyword%";
    $stmt->bind_param("sss", $like, $like, $like);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM list_buku";
    $result = $koneksi->query($sql);
}

$books = $result->fetch_all(MYSQLI_ASSOC);
?>





<!DOCTYPE html>
<html>
    <head>
        <title> latihan Landing page perpustakaan </title>
        <link href="style.css" rel="stylesheet">
        <style>

/* ======================
   AREA KONTEN KANAN
====================== */
.Content {
    margin-left: 220px;   /* lebar nav kiri */
    padding: 32px 40px;
    background: #f5deb3;  /* wheat */
    min-height: 100vh;
}

/* JUDUL */
.Welcome {
    text-align: center;
    font-size: 32px;
    color: #3b2f1e;
    margin-bottom: 24px;
    border-bottom: 3px solid #3b2f1e;
    display: inline-block;
}

/* SEARCH */
.search-box {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 32px;
}

.search-box input {
    width: 320px;
    padding: 10px 14px;
    border-radius: 20px;
    border: 1px solid #c9a96a;
    font-size: 14px;
}

.search-box button {
    padding: 10px 18px;
    border-radius: 20px;
    border: none;
    background: #e6b566;
    color: #3b2f1e;
    cursor: pointer;
}

/* TABLE */
table {
    width: 100%;
    max-width: 1000px;
    margin: auto;
    border-collapse: collapse;
    background: #fffaf0;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0,0,0,0.18);
}

thead {
    background: #d2b48c;
}

thead th {
    padding: 14px;
    color: #2f2416;
}

tbody td {
    padding: 12px 14px;
    color: #3b2f1e;
    border-bottom: 1px solid #e5d3a1;
}

tbody tr:nth-child(even) {
    background: #fff1cc;
}

tbody tr:hover {
    background: #ffe1a3;
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

            <div class="ListBuku">
                <h1 class="Welcome">List buku</h1>
                    <form method="get" style="margin: 20px 2rem;">
                        <input 
                            type="text" 
                            name="q" 
                            placeholder="Cari judul / penulis / penerbit..."
                            value="<?= htmlspecialchars($_GET['q'] ?? '') ?>"
                            style="
                                padding:10px 16px;
                                width:280px;
                                border-radius:20px;
                                border:1px solid #c9a96a;
                                outline:none;
                            "
                        >
                        <button 
                            type="submit"
                            style="
                                padding:10px 18px;
                                border-radius:20px;
                                border:none;
                                background:#f4c56b;
                                color:#4a3317;
                                cursor:pointer;
                            "
                        >
                            Cari
                        </button>
                    </form>
                        <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun Penerbit</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=0; foreach ($books as $book): ?>
                    <tr>
                        <td><?= ++$no; ?></td>
                        <td><?= $book['Judul']; ?></td>
                        <td><?= $book['Penulis']; ?></td>
                        <td><?= $book['Penerbit']; ?></td>
                        <td><?= $book['Tahun_Penerbit']; ?></td>
                        <td><?= $book['stok']; ?></td>
                        <td>
                        <a href="DetailBuku.php?id= <?= $book['id_buku'] ?>">Lihat Buku</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            </div>

            
        </div>

        <script src="Script.js"></script>
    </body>
</html>