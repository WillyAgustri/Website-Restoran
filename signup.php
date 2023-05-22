<?php
include_once('connection.php');

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = test_input($_POST["nama"]);
    $username = test_input($_POST["username"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);

    // Memasukkan data ke dalam tabel pelanggan
    $query = "INSERT INTO pelanggan (nama, username, email, password) VALUES ('$nama', '$username', '$email', '$password')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['id_pelanggan'] = mysqli_insert_id($conn); // Mengambil ID pelanggan baru
        $_SESSION['nama'] = $nama;
        echo "<script language='javascript'> alert('Akun berhasil didaftarakan'); window.location.href='./user-login.html';</script>";
        exit();
    } else {
        echo "<script language='javascript'> alert('Gagal melakukan pendaftaran'); window.location.href='./user-signup.html';</script>";
    }
}
?>
