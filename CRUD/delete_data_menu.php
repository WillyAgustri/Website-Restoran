<?php
include '../connection.php';

$id_menu = $_GET['id_menu'];

$sql = "call delete_menu('$id_menu')";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Berhasil Menghapus Menu!'); location.replace('../dashboard-2.php')</script>";
} else {

  echo "<script> alert('Error : " . mysqli_error($conn) . "') </script>";
}
  ?>