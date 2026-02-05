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

        /* BODY */
        body {
            min-height: 100vh;
            background: linear-gradient(#fff3c4, #ffebcb);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* CONTAINER */
        .dashboard {
            width: 400px;
            padding: 30px;
            border: 4px solid #000;
            background: rgba(255, 255, 255, 0.6);
        }

        /* JUDUL */
        .dashboard h1 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 22px;
        }

        /* NAV */
        nav ul {
            list-style: none;
        }

        /* ITEM */
        nav ul li {
            margin-bottom: 15px;
        }

        /* LINK */
        nav ul li a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #000;
            border: 2px solid #000;
            border-radius: 8px;
            text-align: center;
            background: #fff6d8;
            transition: 0.3s;
        }

        /* HOVER */
        nav ul li a:hover {
            background: #ffe4a3;
            transform: scale(1.05);
        }

        /* LOGOUT KHUSUS */
        nav ul li:last-child a {
            background: #ffd6d6;
        }

        nav ul li:last-child a:hover {
            background: #ffbaba;
        }

                </style>
    </head>
    <body>
        <div class="dashboard">
            <h1>Dashboard Aplikasi Perpustakaan</h1>
            <nav>
                <ul>
                    <li><a href="buku/index.php"> Data buku </a></li>
                    <li><a href="anggota/index.php"> Data Anggota </a></li>
                    <li><a href="peminjaman/index.php"> Pengembalian </a></li>
                    <li><a href="/index.php"> Log out </a></li>
                </ul>
            </nav>
        </div>
    </body>
</html>