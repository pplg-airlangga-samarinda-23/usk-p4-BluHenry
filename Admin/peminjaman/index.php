<?php
session_start();
include dirname(__DIR__, 2) . '/koneksi.php';

// 👉 PROSES HAPUS DATA PEMINJAMAN (ADMIN)
if (isset($_POST['hapus'])) {

    $id_transaksi = $_POST['id_transaksi'];

    $sqlHapus = "DELETE FROM transaksi WHERE id = ?";
    $stmtHapus = $koneksi->prepare($sqlHapus);
    $stmtHapus->bind_param("i", $id_transaksi);
    $stmtHapus->execute();

    // biar ga ke-submit ulang pas refresh
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

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
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_buku'])) {




//     $id_buku = $_POST['id_buku'];

//     $sqlInsert = "INSERT INTO transaksi (id_user, id_buku, tanggal_peminjaman, status)
//                   VALUES (?, ?, NOW(), 'dipinjam')";

//     $stmtInsert = $koneksi->prepare($sqlInsert);
//     $stmtInsert->bind_param("ii", $id_user, $id_buku);
//     $stmtInsert->execute();

// }




$sql = "SELECT 
    transaksi.id,
    user.Username,
    list_buku.Judul,
    transaksi.tanggal_peminjaman,
    transaksi.status
FROM transaksi
JOIN user ON transaksi.id_user = user.id
JOIN list_buku ON transaksi.id_buku = list_buku.id_buku
ORDER BY transaksi.id DESC
";

$stmt = $koneksi->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);



?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin | Data Peminjaman</title>

    <style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: #ffde9c; /* wheat soft */
}

/* HEADER */
.header {
    background: linear-gradient(135deg, #fff6d8, #ffe7b3);
    color: #4a3317;
    padding: 18px 30px;
    font-size: 20px;
    font-weight: 600;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

/* CONTAINER */
.container {
    padding: 30px;
}

/* JUDUL */
h2 {
    margin-bottom: 15px;
    color: #5a3e1b;
}

/* LINK DASHBOARD */
.container a {
    display: inline-block;
    margin-bottom: 15px;
    text-decoration: none;
    background: #f4c56b;
    color: #4a3317;
    padding: 8px 18px;
    border-radius: 18px;
    font-size: 13px;
    border: 1px solid #c9a96a;
    transition: 0.2s;
}

.container a:hover {
    background: #eab84f;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    background: #fffdf5;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

/* HEADER TABLE */
th {
    background: #f0dca6;
    color: #4a3317;
    padding: 12px;
    font-size: 14px;
    text-align: center;
    border-bottom: 2px solid #d8b26e;
}

/* CELL */
td {
    padding: 11px;
    font-size: 13px;
    text-align: center;
    color: #4a3317;
    border-bottom: 1px solid #eee2c7;
}

/* HOVER ROW */
tr:hover {
    background: #fff2cc;
}

/* STATUS BADGE */
.status {
    padding: 5px 12px;
    border-radius: 14px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
}

/* STATUS WARNA */
.dipinjam {
    background: #ffe6a8;
    color: #a16207;
}

.dikembalikan {
    background: #d7edc8;
    color: #2e7d32;
}

/* BUTTON HAPUS */
.btn-hapus {
    padding: 7px 14px;
    border: none;
    border-radius: 16px;
    background: #d97706;
    color: white;
    cursor: pointer;
    font-size: 12px;
    transition: 0.2s;
}

.btn-hapus:hover {
    background: #b45309;
}

/* DATA KOSONG */
.kosong {
    padding: 22px;
    color: #8a6a3b;
    font-style: italic;
}

    </style>
</head>

<body>

<div class="header">
    📚 Admin Perpustakaan — Data Peminjaman
</div>

<div class="container">
    <h2>Daftar Peminjaman Buku</h2>
    <a href="/Admin/dashboard.php">dashboard</a>

    <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama User</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        <tbody>

        <?php if (count($data) == 0): ?>
            <tr>
                <td colspan="6" class="kosong">Belum ada data</td>
            </tr>
        <?php endif; ?>

        <?php $no=1; foreach ($data as $row): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['Username'] ?></td>
                <td><?= $row['Judul'] ?></td>
                <td><?= $row['tanggal_peminjaman'] ?></td>
                <td>
                    <span class="status <?= $row['status'] ?>">
                        <?= $row['status'] ?>
                    </span>
                </td>
                </td>
                <td>
                    <form method="post" onsubmit="return confirm('Hapus data peminjaman ini?')">
                        <input type="hidden" name="id_transaksi" value="<?= $row['id'] ?>">
                        <button type="submit" name="hapus" class="btn-hapus">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>

</body>
</html>
