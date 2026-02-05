<?php
include dirname(__DIR__, 2) . '/koneksi.php';

/* AMBIL DATA */
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    $stmt = $koneksi->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
}

/* UPDATE DATA */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id'];
    $username = $_POST['Username'];
    $role = $_POST['role'];

    $stmt = $koneksi->prepare(
        "UPDATE user SET Username = ?, role = ? WHERE id = ?"
    );
    $stmt->bind_param("ssi", $username, $role, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Anggota</title>
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
    margin-bottom: 25px;
    font-weight: 600;
}

/* LINK / BUTTON */
a, button {
    text-decoration: none;
    cursor: pointer;
}

a {
    padding: 8px 18px;
    border-radius: 20px;
    background: #fff1c9;
    border: 2px solid #c9a96a;
    color: #5a3e1b;
    font-size: 14px;
    transition: 0.25s;
}

a:hover {
    background: #ffe2a0;
}

/* FORM CARD */
form {
    max-width: 420px;
    background: #fffdf5;
    padding: 28px;
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

/* FORM ITEM */
form div {
    margin-bottom: 16px;
}

label {
    font-size: 14px;
    font-weight: 500;
}

/* INPUT */
input, select {
    width: 100%;
    padding: 10px 12px;
    margin-top: 6px;
    border-radius: 10px;
    border: 1px solid #cbb37d;
    font-size: 14px;
}

/* BUTTON */
button {
    padding: 10px 24px;
    border-radius: 22px;
    border: 2px solid #c9a96a;
    background: #ffe9b8;
    font-weight: 500;
    margin-right: 10px;
}

button:hover {
    background: #ffd889;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    background: #fffdf5;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

thead {
    background: #ecd6a4;
}

thead th {
    padding: 14px;
    font-size: 14px;
    text-align: left;
}

tbody td {
    padding: 12px 14px;
    border-bottom: 1px solid #eee2c6;
    font-size: 14px;
}

tbody tr:hover {
    background: #fff3cc;
}

/* AKSI LINK */
td a {
    padding: 4px 12px;
    font-size: 13px;
    border-radius: 12px;
    background: #ffe9b8;
}

td a:hover {
    background: #ffd889;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    body {
        padding: 20px;
    }

    table {
        font-size: 13px;
    }

    form {
        width: 100%;
    }
}

    </style>
</head>
<body>

<h1>Edit Anggota</h1>

<form method="post">
    <div>
        <label>Username</label><br>
        <input type="text" name="Username" value="<?= $user['Username'] ?>" required>
    </div>

    <br>

    <div>
        <label>Role</label><br>
        <select name="role">
            <option value="user" <?= $user['role']=='user'?'selected':'' ?>>User</option>
            <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
        </select>
    </div>

    <br>

    <button type="submit">Simpan</button>
    <a href="index.php">Batal</a>

</form>

</body>
</html>
