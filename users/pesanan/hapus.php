<?php
include_once("../../connection.php");
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = mysqli_query($conn, "SELECT * FROM pelanggan WHERE username = '$username'");
    $result = mysqli_fetch_assoc($user);

    $id_pelanggan = $result['id_pelanggan'];
    $nama = $result['nama'];
}

$result = mysqli_query($conn, "SELECT detail_pesanan.id_detail AS 'id', menu.nama_menu AS nama, menu.harga AS harga, detail_pesanan.jumlah AS jumlah FROM menu INNER JOIN detail_pesanan INNER JOIN pelanggan 
  WHERE menu.id_menu = detail_pesanan.id_menu AND pelanggan.id_pelanggan = $id_pelanggan AND detail_pesanan.id_pelanggan = pelanggan.id_pelanggan;");
$row = mysqli_fetch_assoc($result);

$id_detail = $row['id'];

mysqli_query($conn, "DELETE FROM detail_pesanan WHERE id_detail=$id_detail");

header("Location: index-pesanan.php");
exit();
