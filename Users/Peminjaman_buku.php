<?php
session_start();
include dirname(__DIR__) . '/koneksi.php';

$id_user = $_SESSION['id_user'];

// 👉 PROSES KEMBALIKAN BUKU
if (isset($_POST['kembalikan'])) {

    if (!isset($_SESSION['id_user'])) {
        die('User belum login');
    }

    $id_user = $_SESSION['id_user'];
    $id_transaksi = $_POST['id_transaksi'];

    $sqlKembali = "UPDATE transaksi 
                   SET status = 'dikembalikan'
                   WHERE id = ? AND id_user = ?";

    $stmtKembali = $koneksi->prepare($sqlKembali);
    $stmtKembali->bind_param("ii", $id_transaksi, $id_user);
    $stmtKembali->execute();
}

// 👉 JIKA KLIK PINJAM
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_buku'])) {




    $id_buku = $_POST['id_buku'];

    $sqlInsert = "INSERT INTO transaksi (id_user, id_buku, tanggal_peminjaman, status)
                  VALUES (?, ?, NOW(), 'dipinjam')";

    $stmtInsert = $koneksi->prepare($sqlInsert);
    $stmtInsert->bind_param("ii", $id_user, $id_buku);
    $stmtInsert->execute();

}




$sql = "SELECT transaksi.id, list_buku.Judul ,transaksi.tanggal_peminjaman, transaksi.status
        FROM transaksi
        JOIN list_buku 
        ON transaksi.id_buku = list_buku.id_buku
        WHERE transaksi.id_user = ?
";

$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);


?>



<!DOCTYPE html>
<html>
<head>
    <title>Peminjaman Buku</title>
            <link href="style.css" rel="stylesheet">
    <style>
 
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

    <!-- CONTENT -->
    <div class="content">
        <h1>📚 Peminjaman Buku</h1>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($data) == 0): ?>
                    <tr>
                        <td colspan="4">Belum ada peminjaman</td>
                    </tr>
                <?php endif; ?>

                <?php $no=1; foreach ($data as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['Judul'] ?></td>
                    <td><?= $row['tanggal_peminjaman'] ?></td>
                    <td>
                        <span class="status <?= $row['status'] ?>">
                            <?= $row['status'] ?>
                        </span>
                    </td>
                     <td>
                    <?php if ($row['status'] === 'dipinjam'): ?>
                        <form action="" method="post" onsubmit="return confirm('Yakin mau mengembalikan buku ini?')">
                            <input type="hidden" name="id_transaksi" value="<?= $row['id'] ?>">
                            <button type="submit" name="kembalikan" class="btn-kembali">
                                Kembalikan
                            </button>
                        </form>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>
