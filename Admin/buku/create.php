<?php

   include dirname(__DIR__, 2) . '/koneksi.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $judul = $_POST['Judul'];
        $penulis = $_POST['Penulis'];
        $Penerbit = $_POST['Penerbit'];
        $TahunPenerbit = $_POST['Tahun_Penerbit'];
        $stok = $_POST['stok'];

        $sql = "INSERT INTO list_buku (Judul,Penulis ,Penerbit ,Tahun_Penerbit, stok) VALUES (?,?,?,?,?)";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("sssii", $judul, $penulis, $Penerbit, $TahunPenerbit, $stok);
        $result = $stmt->execute();

        if($result ) {
            header("location:index.php");
        }
    }

?>


<!DOCTYPE html>
<html>
    <head>
        <style>
                        /* RESET */
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: Arial, Helvetica, sans-serif;
            }

            /* BACKGROUND */
            body {
                min-height: 100vh;
                background: linear-gradient(#fff3c4, #ffebcb);
                display: flex;
                justify-content: center;
                align-items: center;
            }

            /* CONTAINER */
            form {
                background: transparent;
            }

            h1 {
                text-align: center;
                margin-bottom: 25px;
                font-size: 26px;
            }

            /* KOTAK FORM */
            .form-wrapper {
                width: 380px;
                padding: 35px 30px;
                border: 4px solid black;
                background: transparent;
            }

            /* ITEM FORM */
            .form-item {
                margin-bottom: 15px;
            }

            .form-item label {
                display: block;
                font-size: 14px;
                margin-bottom: 5px;
            }

            .form-item input {
                width: 100%;
                padding: 10px 12px;
                border-radius: 8px;
                border: 1px solid #777;
                font-size: 15px;
            }

            /* BUTTON */
            button {
                margin-top: 15px;
                width: 100%;
                padding: 10px;
                border-radius: 25px;
                border: 2px solid black;
                background: #f5f5f5;
                font-size: 15px;
                cursor: pointer;
            }

            button:hover {
                background: #e0e0e0;
            }

        </style>
    </head>
    <body>
<div class="form-wrapper">
    <h1>Tambah Buku</h1>

    <form method="post">

        <div class="form-item">
            <label>Judul</label>
            <input type="text" name="Judul" required>
        </div>

        <div class="form-item">
            <label>Penulis</label>
            <input type="text" name="Penulis" required>
        </div>

        <div class="form-item">
            <label>Penerbit</label>
            <input type="text" name="Penerbit" required>
        </div>

        <div class="form-item">
            <label>Tahun Terbit</label>
            <input type="number" name="Tahun_Penerbit" required>
        </div>

        <div class="form-item">
            <label>Stok</label>
            <input type="number" name="stok" required>
        </div>

        <button type="submit">Tambah</button>

    </form>
</div>

    </body>
</html>