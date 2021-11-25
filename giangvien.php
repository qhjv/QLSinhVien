<!DOCTYPE html>
<html>
<?php
session_start();
$link = new mysqli('localhost', 'root', '', 'sinhvien') or die('kết nối thất bại ');
mysqli_query($link, 'SET NAMES UTF8');
$query = 'SELECT * FROM giangvien ';
$result = mysqli_query($link, $query);
if (isset($_SESSION['username'])) {

?>

	<head>
		<meta charset="utf-8">
		<title>Giảng viên </title>
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
			<div class="ct">
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
						<h2>GIẢNG VIÊN KHOA </h2>


						<?php
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
								echo '<div class="infGiangvien">
																	<div class="hihi">
																	<a href="thongtingiangvien.php?id=' . $maso . '"><img src="image/';

								if ($avt == '') {
									echo 'test.png';
								} else {
									echo $avt;
								}

								echo '" width="120px" height = "120px">  </a>
																	</div>
																<div>
																';
								echo "<b>$hotenGV</b><br>";
								echo "<i><small>$maso</small></i><br>";
								echo "<i><small>$trinhdoGV</small></i><br>";
								echo "<i><small>email: $email</small></i><br>";
								echo "</div>";
								echo "</div>";
							}
						}
						?>
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
	header('location:dangxuat.php');
}
?>