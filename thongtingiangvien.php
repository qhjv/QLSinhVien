<?php
session_start();
if (isset($_SESSION['username'])) {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<title>Giảng viên: <?php echo $hotenGV; ?> </title>
		<link rel="stylesheet" href="style/style.css">
		<link rel="stylesheet" href="style/fontawesome/css/all.css">
		<link rel="shortcut icon" href="image/logo_ptit.ico">
	</head>

	<body>
		<header>
			<div id="logo">
				<a href="index.php">Thực tập PTIT</a>
			</div>
			<div id="accountName">
				<a href="dangxuat.php" alt="Đăng xuất"> Đăng xuất</a>
			</div>
		</header>
		<!--endheader-->
		<div class="body">
			<div class="container container__home">
				<div id="menu">
					<ul>
						<li><a href="index.php"><i class="fas fa-home"></i>Trang chủ</a></li>
						<li><a href="lop.php"><i class="fas fa-users"></i>Lớp thực tập</a></li>
						<li><a href="sinhvien.php"><i class="fas fa-graduation-cap"></i>Sinh viên</a></li>
						<li><a id="current" href="giangvien.php"><i class="fas fa-chalkboard-teacher"></i>Giảng viên</a></li>
					</ul>

				</div>
				<div id="main-contain">
					<h2>GIẢNG VIÊN - Thông tin giảng viên </h2>
					<div id="thongtin">
						<div id="avtGiangvien">
							<?php
							$link = new mysqli('localhost', 'root', '', 'sinhvien') or die('kết nối thất bại ');
							mysqli_query($link, 'SET NAMES UTF8');
							if (isset($_POST['upload'])) {
								$file = $_FILES['avt'];
								move_uploaded_file($file['tmp_name'], "upload/" . $file['name']);
								$link_avt = $file['name'];
								$query = 'UPDATE giangvien SET link_avt_GV = "' . $link_avt . '" WHERE  masoGV ="' . $_GET['id'] . '"';
								mysqli_query($link, $query) or die('không thành công');
							}
							$query = 'SELECT * FROM giangvien WHERE masoGV = "' . $_GET['id'] . '" ';
							$result = mysqli_query($link, $query);
							if (mysqli_num_rows($result) > 0) {
								$i = 0;
								while ($row = mysqli_fetch_assoc($result)) {
									$i++;
									$maso = $row['masoGV'];
									$hotenGV = $row['hoten'];
									$trinhdoGV = $row['trinhdo'];
									$chuyenmonGV = $row['chuyenmon'];
									$email = $row['email'];
									$sdt = $row['sdt'];
									$avt = $row['link_avt_GV'];
								}
							}
							if ($avt == '') {
								echo '<img src= "image/test.png" width="200px" height="200px">';
							} else echo '<img src= "upload/' . $avt . '" width="200px" height="200px">';
							echo " <br><b> " . $hotenGV . "</b>";
							?>
							<form method="post" name="upload_avt" enctype="multipart/form-data">
								<input type="file" name="avt" id="file" class="input_file">
								<label for="file"> Chọn ảnh</label>
								<input type="submit" name="upload" value="Thay đổi">

							</form>

						</div>
						<div id="chi_tiet">
							<?php

							echo "<big>" . $hotenGV . "</big><br><br>";
							echo $trinhdoGV . "<br>";
							echo "MSGV: " . $maso . "<br>";
							echo "Email: " . $email . "<br>";
							echo "Điện thoại: " . $sdt . ".";
							?>
						</div>
					</div>

				</div>

			</div>

		</div>
		<!--endbody-->
		<footer>
			<div class="container">
				by @QH | Phiên bản beta
			</div>
		</footer>

	</body>

	</html>
<?php
} else {
	header('location:login.php');
}
?>