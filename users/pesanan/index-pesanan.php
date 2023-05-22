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

$result = mysqli_query($conn, "SELECT detail_pesanan.id_detail AS 'id', menu.nama_menu AS 'nama', menu.harga AS 'harga', detail_pesanan.jumlah AS 'jumlah', detail_pesanan.total_harga as 'total harga' FROM menu INNER JOIN detail_pesanan INNER JOIN pelanggan 
WHERE menu.id_menu = detail_pesanan.id_menu AND pelanggan.id_pelanggan = $id_pelanggan AND detail_pesanan.id_pelanggan = pelanggan.id_pelanggan;");

$res_id = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM header_pesanan WHERE status='belum terbayar'"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/index-pesanan.css" type="text/css">
    <title>Document</title>
</head>

<body>
    <div class="back">
        <a href="../user-index.php">Kembali</a>
    </div>
    <div class="main-c">
        <h1>Pesanan Anda</h1>
        <div class="table-w">
            <table>
                <thead>
                    <tr>
                        <th class="nama-menu">Menu</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th class="aksi">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td class="nama-menu"><?php echo $row['nama']; ?></td>
                            <td><?php echo $row['harga']; ?></td>
                            <td><?php echo $row['jumlah']; ?></td>
                            <td><?php echo $row['total harga'] ?></td>
                            <td class="aksi">
                                <a class="del-btn" href="./hapus.php" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <div class="confirm-btn-c">
            <?php
            $detail_result = mysqli_query($conn, "SELECT * FROM detail_pesanan WHERE id_pelanggan = $id_pelanggan");

            if (mysqli_num_rows($detail_result) > 0) {
                echo "<button class='confirm-btn' onclick=\"window.location.href='konfirmasi-pembayaran.php'\">Konfirmasi Pembayaran</button>";
            } else {
                echo "";
            }
            ?>
        </div>
    </div>
</body>

</html>