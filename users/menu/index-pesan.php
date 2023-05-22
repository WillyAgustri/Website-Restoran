<?php
include_once("../../connection.php");
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = mysqli_query($conn, "SELECT * FROM pelanggan WHERE username = '$username'");
    $result = mysqli_fetch_assoc($user);

    $id_pelanggan = $result['id_pelanggan'];
    $nama = $result['nama'];
} else {
    header("location: ../../index.php");
}

if (isset($_POST['submit'])) {
    $id_menu = $_POST['id_menu'];
    $jumlah_pesanan = $_POST['jumlah_pesanan'];

    mysqli_query($conn, "INSERT INTO detail_pesanan (id_menu, id_pelanggan, jumlah) VALUES ($id_menu, $id_pelanggan ,$jumlah_pesanan)");

    header("Location: index-pesan.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM menu");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/index-pesan.css">
    <title>Document</title>
</head>

<body>
    <div class="back">
        <a href="../user-index.php">Kembali</a>
    </div>
    <div class="container">
        <h1>MENU</h1>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <div class="content-wrapper">
                <div class="content-box">
                    <div class="item-desc">
                        <h2><?php echo $row['nama_menu']; ?></h2>
                        <p><?php echo "Harga : Rp." . $row['harga']; ?></p>
                        <p><?php echo "Stok  : " . $row['stok']; ?></p>
                    </div>
                    <?php echo "<img src='" . $row['image'] . "'>"; ?>
                </div>
                <div class="content-box add-item">
                    <form method="post">
                        <input type="hidden" value="<?php echo $row['id_menu']; ?>" name="id_menu">
                        <label for="">Jumlah</label>
                        <input type="number" name="jumlah_pesanan" placeholder="0-999" min="0">
                        <input class="input-btn" type="submit" name="submit" value="Pesan">
                    </form>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>

</html>
<?php

?>