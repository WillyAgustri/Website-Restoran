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

            $id_pelanggan = $_GET['id_pelanggan']; //mengambil id_pelanggan yang ingin diubah
            
            //menampilkan data_pelanggan berdasarkan id_pelanggan
            $query = mysqli_query($conn,"select * from pelanggan where id_pelanggan = $id_pelanggan");
            $row = mysqli_fetch_assoc($query);


            ?>
            <form action="" method="post" role="form">
                <div class="form-group">
                    <div class="form-group">
                        <label>ID Pelanggan :
                            <?php echo $id_pelanggan; ?>
                            <input type="hidden" name="id_pelanggan" class="form-control"
                                value="<?php echo $row['id_pelanggan']; ?>">


                        </label>

                    </div>
                    <div class=" form-group">
                        <label style="margin-top : 20px;">Username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>"> <span>

                        </span>
                    </div>
                    <div class=" form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="<?php echo $row['nama']; ?>">
                    </div>

                    <div class=" form-group">
                        <label>harga_awal</label>
                        <input type="text" name="email" class="form-control" value="<?php echo $row['email']; ?>">
                    </div>

                    <div class=" form-group">
                        <label>diskon</label>
                        <input type="text" name="password" class="form-control" value="<?php echo $row['password']; ?>">
                    </div>
                    <div class=" form-group">
                        <label>Peran</label>
                        <input type="text" name="user_role" value="<?php echo $row['user_role'] ?>" class="form-control">
                        <div class="keterangan"> Keterangan :
                        <label>Pelanggan</label>
                        <label>,Karyawan</label>
                        <label>,Admin</label>
                        </div>


            </select>
                    </div>

                    </div> 
                    <button type=" submit" class="btn btn-success" name="submit" value="simpan"
                        style="margin-top: 20px;">Update Data</button>
                    <button type="button" class="btn btn-secondary" onclick="location.href='../dashboard.php'"
                        style="margin-top: 20px;">Batal</button>

            </form>




            <?php

            //jika klik tombol submit maka akan melakukan perubahan
            if (isset($_POST['submit'])) {
                $id_pelanggan = $_POST['id_pelanggan'];
                $username = $_POST['username'];
                $nama = $_POST['nama'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $user_role = $_POST['user_role'];

                $sql = "call update_pelanggan($id_pelanggan,'$username','$nama','$email','$password','$user_role')";

                    if (mysqli_query($conn, $sql)) {
                        echo "<script>alert('Berhasil Mengubah User!'); location.replace('../dashboard.php')</script>";
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