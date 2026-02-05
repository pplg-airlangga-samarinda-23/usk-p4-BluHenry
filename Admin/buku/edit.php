<?php
    // include 'koneksi.php';
 include dirname(__DIR__, 2) . '/koneksi.php';

 if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    //$sql = "SELECT * FROM buku WHERE id=?";
    // $book = $koneksi->execute_query($sql, [$id])->fetch_assoc();    
    $stmt = $koneksi->prepare("SELECT * FROM list_buku WHERE id_buku = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $book = $result->fetch_assoc();

 } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['Judul'];
    $penulis = $_POST['Penulis'];
    $Penerbit = $_POST['Penerbit'];
    $TahunPenerbit = $_POST['Tahun_Penerbit'];
    $stok = $_POST['stok'];
    $id = $_GET['id'];
    $sql = "UPDATE list_buku SET Judul = ?,Penulis = ? ,Penerbit = ? ,Tahun_Penerbit = ?, stok = ? WHERE id_buku=?";
    // $sql = "UPDATE buku SEt judul=?, pengarang=?, stok=? WHERE id=?";
    // $result = $koneksi->execute_query($sql, [$judul, $pengarang, $stok, $id]);
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("sssiii", $judul, $penulis, $Penerbit, $TahunPenerbit, $stok, $id);
    $result = $stmt->execute();

    if ($result) {
        header("Location:index.php");
    }
 }

?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            /* ===== RESET RINGAN ===== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Georgia", "Times New Roman", serif;
}

/* ===== BODY ===== */
body {
    background-color: #f5deb3; /* wheat */
    min-height: 100vh;
    justify-content: center;
    align-items: center;
}

/* ===== CARD FORM ===== */
form {
    align-items: center;
    background-color: #fffaf0; /* floral white */
    padding: 30px 40px;
    width: 420px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    margin-left: 29rem;
}

/* ===== JUDUL ===== */
h1 {
    text-align: center;
    margin-bottom: 25px;
    color: #5c3a1e;
    letter-spacing: 1px;
}

/* ===== FORM ITEM ===== */
.form-item {
    margin-bottom: 18px;
}

.form-item label {
    display: block;
    margin-bottom: 6px;
    font-weight: bold;
    color: #6b4226;
}

/* ===== INPUT ===== */
.form-item input {
    width: 100%;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #d2b48c;
    background-color: #fff;
    font-size: 15px;
}

.form-item input:focus {
    outline: none;
    border-color: #b8860b;
    box-shadow: 0 0 0 2px rgba(184,134,11,0.25);
}

/* ===== BUTTON ===== */
button {
    width: 100%;
    padding: 12px;
    background-color: #deb887; /* burlywood */
    border: none;
    border-radius: 10px;
    font-size: 16px;
    font-weight: bold;
    color: #4b2e14;
    cursor: pointer;
    transition: 0.3s ease;
}

button:hover {
    background-color: #cdaa7d;
    transform: translateY(-1px);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 480px) {
    form {
        width: 90%;
        padding: 25px;
    }
}

        </style>
    </head>
    <body>
        <h1>Edit Buku</h1>

        <form action="" method="post">

            <div class="form-item">
                <label>Judul</label>
                <input type="text" name="Judul" value="<?= $book['Judul'] ?>" required>
            </div>

            <div class="form-item">
                <label>Penulis</label>
                <input type="text" name="Penulis" value="<?= $book['Penulis'] ?>" required>
            </div>

            <div class="form-item">
                <label>Penerbit</label>
                <input type="text" name="Penerbit" value="<?= $book['Penerbit'] ?>" required>
            </div>

            <div class="form-item">
                <label>Tahun Terbit</label>
                <input type="number" name="Tahun_Penerbit" value="<?= $book['Tahun_Penerbit'] ?>" required>
            </div>

            <div class="form-item">
                <label>Stok</label>
                <input type="number" name="stok" value="<?= $book['stok'] ?>" required>
            </div>

            <button type="submit">Simpan Perubahan</button>

        </form>>
    </body>
</html>
