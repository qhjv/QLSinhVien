<?php
session_start()

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Đăng nhập admin</title>
	<link rel="stylesheet" href="style/style.css">
	<link rel="shortcut icon" href="image/logo_ptit.ico">
</head>

<body>
	<div class="body">
		<div class="container">
			<div class="container__form">
				<div id="formlogin">
					<form method="post" name="login-form">
						<img class="logo__ptit" src="./image/logo_ptit.png">
						<p class="formlogin__title">Đăng nhập quản lý thực tập PTIT</p>
						<br>
						<table>
							<tr>
								<td>
									Tài khoản :
								</td>
								<td>
									<input type="text" name="taikhoan">
								</td>
							</tr>
							<tr>
								<td>
									Mật khẩu :
								</td>
								<td>
									<input id="submit" type="password" name="password">
								</td>
							</tr>
						</table>
						<input id="btndangnhap" type="submit" name="login" value="Đăng nhập">
					</form>
					<?php

					$link = new mysqli('localhost', 'root', '', 'sinhvien') or die('kết nối thất bại ');
					mysqli_query($link, 'SET NAMES UTF8');
					if (isset($_POST['login'])) {
						if (empty($_POST['taikhoan']) or empty($_POST['password'])) {
							echo ' </br> <p style="color:red;text-align: initial;"> vui lòng nhập đầy đủ username và password !</p>';
						} else {
							$username = $_POST['taikhoan'];
							$password = $_POST['password'];
							$query = "SELECT * FROM dangnhap where account = '$username' and password = '$password'";
							$result = mysqli_query($link, $query);
							$num = mysqli_num_rows($result);
							if ($num == 0) {
								echo '</br> <p style="color:red;text-align: initial;"> Sai tên đăng nhập hoặc mật khẩu ! </p>';
							} else {

								$_SESSION['username'] = $username;
								header('location:index.php');
							}
						}
					}

					?>
				</div>
			</div>
		</div>
	</div>
</body>

</html>