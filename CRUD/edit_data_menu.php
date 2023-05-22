<!DOCTYPE html>
<html>

<head>
    <title>Ubah Data</title>
</head>
<link rel="stylesheet" type="text/css" href="../boostrap/css/bootstrap.min.css">

<body>


    <div class="card">
        <div class="card-header bg-success text-white ">
            Edit Data Pegawai
        </div>
        <div class="card-body">
            <?php
            include('../connection.php');

            $id_menu = $_GET['id_menu']; //mengambil id_menu yang ingin diubah
            
            //menampilkan data_pelanggan berdasarkan id_menu
            $query = mysqli_query($conn,"select * from menu where id_menu = $id_menu");
            $row = mysqli_fetch_assoc($query);


            ?>
            <form action="" method="post" role="form">
                <div class="form-group">
                    <div class="form-group">
                        <label>ID Menu :
                            <?php echo $id_menu; ?>
                            <input type="hidden" name="id_menu" class="form-control"
                                value="<?php echo $row['id_menu']; ?>">


                        </label>

                    </div>
                    <div class=" form-group">
                        <label style="margin-top : 20px;">Username</label>
                        <input type="text" name="nama_menu" class="form-control"
                            value="<?php echo $row['nama_menu']; ?>"> <span>

                        </span>
                    </div>
                    <div class=" form-group">
                        <label>Harga</label>
                        <input type="text" name="harga" class="form-control" value="<?php echo $row['harga']; ?>">
                    </div>

                    <div class=" form-group">
                        <label>Stok</label>
                        <input type="text" name="stok" class="form-control" value="<?php echo $row['stok']; ?>">
                    </div>
                    </select>
                </div>

        </div>
        <button type=" submit" class="btn btn-success" name="submit" value="simpan" style="margin-top: 20px;">Update
            Data</button>
        <button type="button" class="btn btn-secondary" onclick="location.href='../dashboard-2.php'"
            style="margin-top: 20px;">Batal</button>

        </form>




        <?php

            //jika klik tombol submit maka akan melakukan perubahan
            if (isset($_POST['submit'])) {
                $id_menu = $_POST['id_menu'];
                $nama_menu = $_POST['nama_menu'];
                $harga = $_POST['harga'];
                $stok = $_POST['stok'];

                $sql = "call update_menu($id_menu,'$nama_menu',$harga,$stok)";
                    if (mysqli_query($conn, $sql)) {
                        echo "<script>alert('Berhasil Mengubah Menu!'); location.replace('../dashboard-2.php')</script>";
                    } else {
                 
                    }
                
                
            }



            ?>

    </div>
    </div>




    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
</body>

</html>