<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <title>Document</title>
    <link rel="stylesheet" href="../css/user-index.css" type="text/css">
    <link rel="stylesheet" href="../fontawesome-free-6.3.0-web/css/all.css" type="text/css">
    <?php
    include_once('../validate.php');
    ?>
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $user = mysqli_query($conn, "SELECT * FROM pelanggan WHERE username = '$username'");
        $result = mysqli_fetch_assoc($user);

        $id_pelanggan = $result['id_pelanggan'];
        $nama = $result['nama'];
    } else {
        header("location: ../index.php");
    }
    ?>
    <section id="s-1">
        <div class="nav-bar">
            <div class="nav-bar-content logo">
                <h1>BasDat</h1>
            </div>
            <div class="nav-bar-content nav-link">
                <ul>
                    <li><a href="./user-index.php">Home</a></li>
                    <li><a href="./menu/index-pesan.php">Menu</a></li>
                    <li><a href="./logout.php">Logout</a></li>
                </ul>
            </div>
            <div class="nav-bar-content nav-acc">
                <ul>
                    <li>
                        <a href="./pesanan/index-pesanan.php">
                            <i class="fa-solid fa-receipt"></i>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa-solid fa-circle-user"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-c">
            <div class="main-w">
                <div class="tag-w">
                    <h1>"Tak Hanya Sekedar Makanan, Namun Juga Pengalaman."</h1>
                    <p>― Devid Morris Sinaga</p>
                </div>
                <div class="pic-w">
                    <div class="img-1">
                        <img src="../images/kepiting.jpeg" alt="">
                    </div>
                    <div class="img-2">
                        <img src="../images/mie-goreng.jpg" alt="">
                        <img src="../images/nasi-goreng.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="rendom-c">
        </div>
    </section>
</body>

</html>