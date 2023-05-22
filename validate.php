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
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $user = mysqli_query($conn, "SELECT * FROM pelanggan WHERE username = '$username' AND password = '$password'");
    $result = mysqli_fetch_assoc($user);

    if ($result) {
        session_start();
        $_SESSION['username'] = $result['username'];
        $_SESSION['id_pelanggan'] = $result['id_pelanggan'];
        $_SESSION['nama'] = $result['nama'];
        header('Location: /users/user-index.php');
        exit();
    } else {
        echo "<script language='javascript'> alert('Username atau Password salah!'); window.location.href='./user-login.html';</script>";
    }    
}
?>