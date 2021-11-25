<!DOCTYPE html>
<html>
<?php
session_start();
if (isset($_SESSION['username'])) {
	$link = new mysqli('localhost', 'root', '', 'sinhvien') or die('kết nối thất bại ');
	mysqli_query($link, 'SET NAMES UTF8');
?>

	<head>
		<meta charset="utf-8">
		<title>Thông tin lớp học</title>
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
						<li><a id="current" href="lop.php"><i class="fas fa-users"></i>Lớp thực tập</a></li>
						<li><a href="sinhvien.php"><i class="fas fa-graduation-cap"></i>Sinh viên</a></li>
						<li><a href="giangvien.php"><i class="fas fa-chalkboard-teacher"></i>Giảng viên</a></li>
					</ul>
				</div>
				<div id="main-contain">
					<h2>DANH SÁCH LỚP </h2><br>
					<div id="listSV">

						<table width="70%">
							<tr>
								<th>STT</th>
								<th>Lớp </th>
								<th>Giáo viên hướng dẫn</th>
								<!-- <th>Phòng học</th> -->
								<th>Chức năng</th>
							</tr>

							<?php

							$query = "SELECT * FROM lophoc";
							$result = mysqli_query($link, $query);
							if (mysqli_num_rows($result) > 0) {
								$i = 0;
								while ($r = mysqli_fetch_assoc($result)) {
									$i++;
									$idlop = $r['lopID'];
									$lop = $r['tenlop'];
									$GVchunhiem = $r['chunhiem'];
									// $phongHoc=$r['phonghoc'];

									echo "<tr> ";
									echo "<td>$i</td>";
									echo "<td>$lop</td>";
									echo "<td>$GVchunhiem</td>";
									// echo "<td>$phongHoc</td>";	
									echo " <td style='text-align: center;'> <a href='chucnang/sualop.php?id=$idlop'><input id='btnSua' type='button' value='sửa' '></a>   <a href='chucnang/xoalop.php?id=$idlop'><input id='btnXoa' type='button' value='xóa'></a>  <a href='dslop.php?id=$idlop'><input id='btnChitiet' type='button' value='xem danh sách' '></a> </td>";
								}
							}
							?>
						</table>
					</div>
					<form id="formChucnang">
						<a href="chucnang/themlop.php"><input id="btnThemSV" type="button" value="THÊM LỚP"> </a>
					</form>
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