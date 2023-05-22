<?php
include '../connection.php';

$id_pelanggan = $_GET['id_pelanggan'];

$sql = "call delete_pelanggan('$id_pelanggan')";

if (mysqli_query($conn, $sql)) {
  echo "Data Dihapus disimpan";
  header("Location:../dashboard.php");
} else {

  echo "<script> alert('Error : " . mysqli_error($conn) . "') </script>";
}
  ?>