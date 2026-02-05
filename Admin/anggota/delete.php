<?php 

include dirname(__DIR__, 2) . '/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    $sql = "DELETE FROM user WHERE id=?";
    //$result = $koneksi->execute_query($sql, [$id]);

    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();

    if ($result) {
        header("Location:index.php");
    }
}