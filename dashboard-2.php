<?php

// Menyambung ke database
include "connection.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kelola User</title>
</head>
<body>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" />
    <link rel="stylesheet" href="css/dashboard.css" />
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!------ Include the above in your HEAD tag ---------->

    <body>
        <!--
        Navigasi untuk Admin



         -->
        <div class="nav-bar">
            <div class="nav-bar-content logo">
                <h1>BasDat
                    <h5>Dashboard Kelola Menu</h5>
                </h1>
            </div>
            <div class="nav-bar-content nav-link">
                <ul>
                    <li><a href="./index.php">Home</a></li>
                    <li><a href="dashboard.php">Kelola User</a></li>
                    <li><a href="dashboard-2.php">Kelola Menu</a></li>
                    <li><a href="#">Logout</a></li>


                </ul>
            </div>
        </div>




        <!-- Data Analist -->
        <div class="content-wrapper">
            <div class="container-fluid">
                <?php
                $query_menu = mysqli_query($conn, "call hitung_menu()");
                $row_menu = mysqli_fetch_assoc($query_menu);
                $jumlah_menu = $row_menu['COUNT(id_menu)'];
                mysqli_next_result($conn);

                $query_stok = mysqli_query($conn, "call hitung_stok()");
                $row_stok = mysqli_fetch_assoc($query_stok);
                $jumlah_stok = $row_stok['sum(stok)'];
                mysqli_next_result($conn);

                ?>



                <div style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap;">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
                        <div class="inforide">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-3 col-md-4 col-sm-4 col-4 rideone text-center">
                                    <ion-icon name="fast-food-outline" style="font-size: 48px;"></ion-icon>
                                </div>
                                <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty text-center">
                                    <h4>Total Makanan</h4>
                                    <h2><?php echo $jumlah_menu ?></h2>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
                        <div class="inforide">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-3 col-md-4 col-sm-4 col-4 ridetwo">
                                    <ion-icon name="bag-handle-outline" style="font-size: 48px;"></ion-icon>
                                </div>
                                <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                                    <h4>Total Stok</h4>
                                    <h2><?php echo $jumlah_stok ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>





        <!-- ------------------------- -->
        <!-- Title and Sub-title -->
        <!-- ------------------------- -->

        <main>
            <div class="container my-5">



                <div class="card">
                    <table class="table table-hover">




                        <thead>
                            <tr>

                                <th scope="col">ID Menu</th>
                                <th scope="col">Nama Menu</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Aksi</th>




                            </tr>
                        </thead>

                        <tbody>
                            <?php



                            $halaman = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;
                            $halaman_awal = ($halaman > 1) ? ($halaman * 5) - 5 : 0;

                            $sebelum = $halaman - 1;
                            $setelah = $halaman + 1;

                            $data_menu = mysqli_query($conn, "select * from menu");
                            $jumlah_data = mysqli_num_rows($data_menu);

                            $total_halaman = ceil($jumlah_data / 5);
                            $query = mysqli_query($conn, "select * from menu limit $halaman_awal, 5");
                            $nomor = $halaman_awal + 1;
                            while ($data = mysqli_fetch_array($query)) {

                                ?>

                            <tr>

                                <th scope="row">
                                    <?php
                                        echo $data['id_menu'];
                                        ?>
                                </th>
                                <td>
                                    <?php
                                        echo $data['nama_menu'];

                                        ?>
                                </td>
                                <td>
                                    <?php
                                        echo $data['harga'];
                                        ?>

                                </td>
                                <td>
                                    <?php
                                        echo $data['stok'];
                                        ?>
                                </td>





                                <td>
                                    <a class="btn btn-sm btn-primary"
                                        href="CRUD/edit_data_menu.php?id_menu=<?= $data['id_menu']; ?>"><i
                                            class="far fa-edit"></i>Edit</a>
                                    <a href="CRUD/delete_data_menu.php?id_menu=<?= $data['id_menu']; ?>"
                                        class="btn btn-sm btn-danger" href="#"><i class="fas fa-trash-alt"></i>
                                        Delete</a>
                                </td>



                            </tr>



                            <?php
                            }
                            ?>
                            <tr>
                                <thread>

                                    <th scope="col">

                                    </th>
                                    <th scope="col"></th>
                                    <th scope="col">
                                        <nav>

                                            <ul class="pagination">
                                                <li class="page-item">
                                                    <a class="page-link" <?php if ($halaman > 1) {
                                                        echo "href='?halaman=$sebelum'";
                                                    } ?>>Previous</a>
                                                </li>
                                                <?php
                                                for ($x = 1; $x <= $total_halaman; $x++) {
                                                    ?>
                                                <li class="page-item"><a class="page-link"
                                                        href="?halaman=<?php echo $x ?>">
                                                        <?php echo $x; ?></a></li>
                                                <?php
                                                }
                                                ?>
                                                <li class=" page-item">
                                                    <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                        echo "href='?halaman=$setelah'";
                                                    } ?>>Next</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </th>
                                    <th scope="col"></th>
                                    <th scope="col">
                                        <a href="CRUD/tambah_data_user.php"
                                            class="btn btn-sm btn-primary float-end">Tambah
                                            Data</a>
                                    </th>

                                    <th scope="col">


                                    </th>


                                    </th>

                                </thread>
                            </tr>



                        </tbody>
                    </table>

                </div>
            </div>
        </main>
        <!---->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <!---->
        <footer></footer>
    </body>
</body>
</html>