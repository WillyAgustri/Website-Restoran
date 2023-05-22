<?php
include '../connection.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Menu</title>
    <link rel="stylesheet" type="text/css" href="../boostrap/css/bootstrap.min.css">
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group" style="margin-top:20px;">
            <label>Nama Makanan</label>
            <input type="text" name="nama_menu" class="form-control">
        </div>
        <div class="form-group" style="margin-top:20px;">
            <label>Harga</label>
            <input type="text" name="harga" class="form-control">
        </div>

        <div class="form-group" style="margin-top:20px;">

            <label>Stok</label>
            <input type="text" name="stok" class="form-control">
        </div>

        </select>
        </div>

        <button type="submit" class="btn btn-primary" name="submit" value="simpan" style="margin-top:10px;">Simpan
            data</button>
        <button type="button" class="btn btn-secondary" onclick="location.href='../dashboard-2.php'"
            style="margin-top: 10px;">Batal</button>
    </form>
    <?php
    if (isset($_POST["submit"])) {
        // Ambil data dari form
        $nama_menu = $_POST["nama_menu"];
        $harga = $_POST["harga"];
        $stok = $_POST["stok"];
        // Query untuk insert data ke tabel user
        $sql = "call insert_menu('$nama_menu', '$harga', '$stok')";

        // Eksekusi query
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Data berhasil Ditambah'); location.replace('../dashboard-2.php')</script>";
            header("Location:../dashboard-2.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    ?>
</body>
</html>