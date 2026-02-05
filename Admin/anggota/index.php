<?php 
    // include 'koneksi.php';
    include dirname(__DIR__, 2) . '/koneksi.php';

    $sql = "SELECT * FROM user";
    $result = $koneksi->query($sql);
    $users = $result->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            /* GOOGLE FONT */
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

            /* RESET */
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Poppins', sans-serif;
            }

            /* BODY */
            body {
                min-height: 100vh;
                background: linear-gradient(135deg, #fff6d8, #ffe7b3);
                padding: 40px;
                color: #4a3317;
            }

            /* JUDUL */
            h1 {
                font-size: 28px;
                margin-bottom: 20px;
                font-weight: 600;
            }

            /* TOMBOL TAMBAH */
            a[href="create.php"] {
                display: inline-block;
                margin-bottom: 18px;
                padding: 10px 22px;
                background: #fff1c9;
                border: 2px solid #c9a96a;
                border-radius: 25px;
                color: #5a3e1b;
                font-weight: 500;
                transition: 0.3s;
            }

            a[href="create.php"]:hover {
                background: #ffe2a0;
                transform: translateY(-2px);
            }

            a[href="/Admin/dashboard.php"] {
                display: inline-block;
                margin-bottom: 18px;
                padding: 10px 22px;
                background: #fff1c9;
                border: 2px solid #c9a96a;
                border-radius: 25px;
                color: #5a3e1b;
                font-weight: 500;
                transition: 0.3s;
            }

            a[href="/Admin/dashboard.php"]:hover {
                background: #ffe2a0;
                transform: translateY(-2px);
            }

            /* TABLE CARD */
            table {
                width: 100%;
                border-collapse: collapse;
                background: #fffdf5;
                border-radius: 14px;
                overflow: hidden;
                box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            }

            /* HEADER */
            thead {
                background: #ecd6a4;
            }

            thead th {
                padding: 14px;
                text-align: left;
                font-weight: 600;
                font-size: 14px;
            }

            /* BODY TABLE */
            tbody td {
                padding: 12px 14px;
                font-size: 14px;
                border-bottom: 1px solid #eee2c6;
            }

            /* ROW HOVER */
            tbody tr:hover {
                background: #fff3cc;
                transition: 0.2s;
            }

            /* AKSI */
            td a {
                padding: 4px 10px;
                border-radius: 12px;
                font-size: 13px;
                font-weight: 500;
                color: #5a3e1b;
                background: #ffe9b8;
                transition: 0.2s;
            }

            td a:hover {
                background: #ffd889;
            }

            /* RESPONSIVE SEDIKIT */
            @media (max-width: 768px) {
                body {
                    padding: 20px;
                }

                table {
                    font-size: 13px;
                }
            }

        </style>
    </head>
    <body>
        <h1>Data Anggota</h1>
        <a href="create.php">Tambah</a>
        <a href="/Admin/dashboard.php">dashboard</a>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>role</th>
                        <th>aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=0; foreach ($users as $user): ?>
                    <tr>
                        <td><?= ++$no; ?></td>
                        <td><?= $user['Username']; ?></td>
                        <td><?= $user['Password']; ?></td>
                        <td><?= $user['role']; ?></td>
                        <td>
                            <a href="edit.php?id=<?= $user['id'] ?>">Edit</a>
                            <a href="delete.php?id=<?= $user['id'] ?>">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
    </body>
</html>

