<?php
session_start();
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt -> bind_param("s", $username);
    $stmt-> execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['Password'])) {
        $_SESSION['login'] = true;
        $_SESSION['Username'] = $user['Username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['id_user'] = $user['id'];
        
    //     header("Location: /Users/index.php");
    //     exit;
    // } else {
    //     echo "Username atau Password salah";
    // }
            // 🔀 ARAHIN SESUAI ROLE
        if ($user['role'] === 'admin') {
            header("Location: /admin/dashboard.php");
        } else {
            header("Location: /Users/index.php");
        }
        exit;

    } else {
        echo "Username atau Password salah";
    }

    

}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> latihan Landing page perpustakaan </title>
        <link href="styleLog.css" rel="stylesheet">

    </head>
    <body>
    <form action="index.php" method="POST">
        <div class="KotakLogin">
            <div class="KotakLogin_Mini">
                <p class="TeksLogin"> Login form </p>

                <input placeholder="Username" class="NamaPengguna" id="username" name="Username" required>

                <input type="password" placeholder="Password" class="Password" id="password" name="Password" required>

                <button class="TombolKirim" type="submit"> Submit </button>

                <a href="/Register.php" class="Registert"> Register </a>
            </div>
        </div>
    </form>
        <script src="Script.js"></script>
    </body>
</html>