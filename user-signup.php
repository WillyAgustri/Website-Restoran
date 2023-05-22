<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./fontawesome-free-6.3.0-web/css/all.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="./css/login-user.css">
	<title>Daftar Pengguna</title>
	<?php
	include_once('connection.php')
	?>
</head>

<body>
	<div class="back">
		<a href="index.php">Kembali</a>
	</div>
	<div class="login-container">
		<div class="login-wrapper">
			<form action="./signup.php" method="post">
				<div class="login-box">
					<h1>Daftar Pengguna</h1>
					<div class="textbox">
						<i class="fa fa-user" aria-hidden="true"></i>
						<input type="text" placeholder="Nama" name="nama" required>
					</div>

					<div class="textbox">
						<i class="fa-solid fa-at"></i>
						<input type="text" placeholder="Username" name="username" required>
					</div>

					<div class="textbox">
						<i class="fa-solid fa-envelope"></i>
						<input type="email" placeholder="Email" name="email" required>
					</div>


					<div class="textbox">
						<i class="fa fa-lock" aria-hidden="true"></i>
						<input type="password" placeholder="Password" name="password" required>
					</div>

					<input class="input-btn" type="submit" name="login" value="Sign Up">
				</div>
			</form>
			<p>Sudah memiliki akun? <a href="./user-login.html">Masuk</a></p>
		</div>
	</div>
</body>

</html>