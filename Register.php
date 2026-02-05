<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (username, password, role) VALUES (?, ?, 'user')";
    $stmt = $koneksi-> prepare($sql);
    $stmt->bind_param("ss", $username, $passwordHash);

    if ($stmt->execute()) {
        header("Location:index.php");
        exit;
    } else {
        echo "register gagal";
    }
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title> latihan Landing page perpustakaan </title>

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
    height: 100vh;
    background: linear-gradient(#fff3c4, #ffebcb);
    display: flex;
    justify-content: center;
    align-items: center;
}

/* KOTAK LUAR */
.KotakLogin {
    width: 100%;
    height: 100%;
    border: 2px solid #1e90ff; /* garis biru pinggir */
    display: flex;
    justify-content: center;
    align-items: center;
}

/* KOTAK LOGIN */
.KotakLogin_Mini {
    width: 350px;
    padding: 40px 30px;
    border: 5px solid black;
    background: transparent;
    text-align: center;
}

/* JUDUL */
.TeksLogin {
    font-size: 22px;
    margin-bottom: 25px;
}

/* INPUT */
.NamaPengguna,
.Password {
    width: 100%;
    padding: 10px 12px;
    margin-bottom: 15px;
    border-radius: 8px;
    border: 1px solid #888;
    font-size: 16px;
}

/* REGISTER LINK */
.Registert {
    margin-top: 1rem;
    display: block;
    text-align: left;
    font-size: 14px;
    color: #2d6cff;
    text-decoration: none;
    margin-bottom: 25px;
}

.Registert:hover {
    text-decoration: underline;
}

/* BUTTON */
.TombolKirim {
    padding: 8px 30px;
    border-radius: 20px;
    border: 2px solid black;
    background: #f5f5f5;
    cursor: pointer;
    font-size: 15px;
}

.TombolKirim:hover {
    background: #e0e0e0;
}



        </style>
    </head>
    <body>
    <form action="Register.php" method="POST">
        <div class="KotakLogin">
            <div class="KotakLogin_Mini">
                <p class="TeksLogin"> Register Form </p>

                <input placeholder="Username" class="NamaPengguna" id="username" name="Username" required>

                <input placeholder="Password" class="Password" id="password" name="Password" required>

                <button class="TombolKirim"> Register </button>

                <a href="index.php" class="Registert"> Have a account? </a>
            </div>
        </div>
    </form>
        <script src="Script.js"></script>
    </body>
</html>