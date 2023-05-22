<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="" />
    <title>Document</title>
    <link rel="stylesheet" href="css/user-index.css" type="text/css" />
    <link rel="stylesheet" href="./fontawesome-free-6.3.0-web/css/all.css" type="text/css" />
    <?php
  include_once('./connection.php');

  $rating = mysqli_query($conn, "SELECT * FROM review_pelanggan INNER JOIN pelanggan WHERE review_pelanggan.id_pelanggan = pelanggan.id_pelanggan AND bintang_rating = 5");
  $avg_rating = mysqli_query($conn, "SELECT ROUND(AVG(bintang_rating), 1) AS 'AVG' FROM review_pelanggan");
  $avg_res = mysqli_fetch_assoc($avg_rating);
  $i = 0;
  ?>
</head>

<body>
    <section id="s-1">
        <div class="nav-bar">
            <div class="nav-bar-content logo">
                <h1>BasDat</h1>
            </div>
            <div class="nav-bar-content nav-link">
                <ul>
                    <li><a href="./index.html">Home</a></li>
                    <li><a href="./user-login.html">Login</a></li>
                    <li><a href="./user-signup.php">Sign-Up</a></li>
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
                        <img src="./images/kepiting.jpeg" alt="" />
                    </div>
                    <div class="img-2">
                        <img src="./images/mie-goreng.jpg" alt="" />
                        <img src="./images/nasi-goreng.jpg" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="s-2">
        <div class="main-c c-2">
            <h1>Selamat Datang.</h1>
            <div class="main-w-2">
                <div class="mw2-image">
                    <img src="./images/salad.png" alt="" />
                </div>

                <div class="mw2-desc">
                    <h1>Kami Menyajikan Yang Terbaik.</h1>
                    <p>
                        Nikmati hidangan lezat dan pelayanan yang ramah di restoran kami.
                        Kami menawarkan berbagai macam hidangan mulai dari masakan
                        tradisional hingga hidangan modern yang inovatif. Bahan-bahan kami
                        selalu segar dan berkualitas tinggi, sehingga Anda dapat menikmati
                        makanan yang lezat dan sehat.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section id="rating">
        <div class="avg-c">
            <div class="avg-w">
                <h1><?php echo $avg_res['AVG'] ?></h1>
                <i class="fa-solid fa-star"></i>
            </div>
            <div class="avg-desc">
                <p>Rating rata-rata yang kami terima dari pelanggan</p>
            </div>
        </div>
        <div class="rating-c">
            <?php while ($row = mysqli_fetch_assoc($rating)) :
        if ($i >= 3) {
          break;
        }
        $i++; ?>
            <div class="review-box">
                <i class="fa-solid fa-thumbs-up"></i>
                <div class="stars">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h4><?php echo $row['nama']; ?></h4>
                <p><?php echo "''" . $row['ulasan'] . "''"; ?></p>
            </div>
            <?php endwhile; ?>
        </div>
    </section>
</body>

</html>