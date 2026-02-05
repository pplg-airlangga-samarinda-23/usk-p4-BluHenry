<?php
include dirname(__DIR__, 2) . '/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO user (username, password, role) VALUES (?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $role);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal menambahkan user";
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Tambah Anggota</title>
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
    justify-content: center;
    align-items: center;
    color: #4a3317;
}

/* CARD FORM */
form {
    background: #fffdf5;
    margin-left: 31rem;
    padding: 35px 40px;
    border-radius: 18px;
    width: 360px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

/* JUDUL */
h1 {
    text-align: center;
    margin-bottom: 25px;
    font-size: 24px;
    font-weight: 600;
}

/* FORM ITEM */
form div {
    margin-bottom: 16px;
}

/* LABEL */
label {
    display: block;
    margin-bottom: 6px;
    font-size: 14px;
    font-weight: 500;
}

/* INPUT & SELECT */
input, select {
    width: 100%;
    padding: 10px 12px;
    border-radius: 10px;
    border: 1px solid #c9a96a;
    font-size: 14px;
    outline: none;
}

input:focus, select:focus {
    border-color: #a67c37;
}

/* BUTTON */
button {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    background: #ffe2a0;
    border: 2px solid #c9a96a;
    border-radius: 25px;
    font-weight: 500;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #ffd889;
    transform: translateY(-2px);
}

/* LINK */
a {
    display: block;
    text-align: center;
    margin-top: 14px;
    font-size: 14px;
    color: #6b4a1e;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
    </style>
</head>
<body>

<h1>Tambah Anggota</h1>

<form method="post">
    <div>
        <label>Username</label>
        <input type="text" name="username" required>
    </div>

    <div>
        <label>Password</label>
        <input type="password" name="password" required>
    </div>

    <div>
        <label>Role</label>
        <select name="role" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <button type="submit">Simpan</button>
    <a href="index.php">Kembali</a>
</form>

</body>
</html>
