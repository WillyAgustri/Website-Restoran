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
    $id_header = $_POST['id_header'];
    $total_pembayaran = $_POST['total_pembayaran'];

    mysqli_query($conn, "UPDATE header_pesanan SET total_pembayaran = $total_pembayaran WHERE id_header = $id_header");

    header("Location: ../user-index.php");
    exit();
}

$result = mysqli_query($conn, "SELECT header_pesanan.id_header AS 'id_header', header_pesanan.tanggal AS 'tanggal',pelanggan.id_pelanggan AS 'id_pelanggan', header_pesanan.total_pembelian AS 'total_pesanan', header_pesanan.total_tagihan AS 'total_tagihan'
FROM header_pesanan INNER JOIN pelanggan WHERE pelanggan.id_pelanggan = $id_pelanggan AND header_pesanan.id_pelanggan = pelanggan.id_pelanggan AND header_pesanan.status = 'belum terbayar';");

$pesanan_result = mysqli_query($conn, "SELECT detail_pesanan.id_detail AS 'id', menu.nama_menu AS 'nama', menu.harga AS 'harga', SUM(detail_pesanan.jumlah) AS 'jumlah', SUM(detail_pesanan.total_harga) AS 'total harga' 
FROM menu 
INNER JOIN detail_pesanan ON menu.id_menu = detail_pesanan.id_menu 
INNER JOIN pelanggan ON detail_pesanan.id_pelanggan = pelanggan.id_pelanggan 
WHERE pelanggan.id_pelanggan = 203 
GROUP BY detail_pesanan.id_menu;");

$data = mysqli_fetch_assoc($result);

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
        <a href="./index-pesanan.php">Kembali</a>
    </div>
    <div class="main-c">
        <h1>Konfirmasi Pembayaran</h1>
        <div class="bill-c">
            <div class="date-uid">
                <p>Tanggal: <?php echo $data['tanggal'] ?></p>
                <p>User ID: <?php echo $data['id_pelanggan'] ?></p>
            </div>
            <div class="list-pesanan">
                <table>
                    <?php while ($daftar = mysqli_fetch_assoc($pesanan_result)) : ?>

                        <tr>
                            <td><?php echo $daftar['nama'] ?></td>
                            <td><?php echo $daftar['harga'] ?></td>
                            <td>x<?php echo $daftar['jumlah'] ?></td>
                            <td class="total"><?php echo $daftar['total harga'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            <div class="total-bayar">
                <div class="total-beli">
                    <p>Total Pembelian: </p>
                    <h2><?php echo $data['total_pesanan'] ?></h2>
                </div>
                <div class="diskon">
                    <p><?php
                    if ($data['total_pesanan'] > 90000){
                        echo "Diskon 10%";
                    }
                    ?></p>
                </div>
            </div>
            <div class="total-tagihan">
                    <p>Total Tagihan: </p>
                    <h2><?php echo $data['total_tagihan'] ?></h2>
                </div>
        </div>
        <div class="confirm-btn-c">
            <form method="post">
                <input type="hidden" value="<?php echo $data['id_header']?>" name="id_header">
                <input class="input-bayar" name="total_pembayaran" type="number" placeholder="Nominal Pembayaran" min="<?php echo $data['total_tagihan']?>" required>
                <input type="submit" name="submit" value="Bayar" class="confirm-btn">
            </form>
        </div>
    </div>
</body>

</html>