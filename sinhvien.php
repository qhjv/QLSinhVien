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
		<title>Sinh viên</title>
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
						<li><a id="current" href="sinhvien.php"><i class="fas fa-graduation-cap"></i>Sinh viên</a></li>
						<li><a href="giangvien.php"><i class="fas fa-chalkboard-teacher"></i>Giảng viên</a></li>
					</ul>

				</div>
				<div id="main-contain">
					<h2>DANH SÁCH SINH VIÊN </h2>
					<div id="listSV">
						<form method="post" id="f_search"> <input id="txtSearch" type="search" name="search" placeholder="Nhập tên hoặc MSSV">
							<input id="btnSearch" type="submit" name="tim" value="">
						</form>

						<table width="70%">
							<tr>
								<th>STT</th>

								<th>Họ Tên</th>
								<th>MSSV</th>
								<th>Ngày sinh</th>
								<th>SĐT</th>
								<th>Địa chỉ</th>
								<th>Chức năng</th>
							</tr>

							<?php
							if (isset($_POST['tim'])) {
								$giatri = $_POST['search'];
								//echo $giatri;
								if (empty($giatri)) {
									echo "Bạn muốn tìm gì?";
								} else {
									$query = "SELECT * FROM sinhvien WHERE sinhvien.name LIKE '%" . $giatri . "%' or sinhvien.sinhvienID = '$giatri'";
								}
							} else {
								$query = "SELECT * FROM sinhvien";
							}
							$result = mysqli_query($link, $query);
							if (mysqli_num_rows($result) > 0) {
								$i = 0;
								while ($r = mysqli_fetch_assoc($result)) {
									$i++;
									$sinhvienID = $r['sinhvienID'];
									$ten = $r['name'];
									$ngaysinhsql = $r['birthday'];
									$ngaysinh = date("d-m-Y", strtotime($ngaysinhsql));
									$sdt = $r['phonenumber'];
									$quequan = $r['address'];
									echo "<tr> ";
									echo "<td>$i</td>";
									echo "<td>$ten</td>";
									echo "<td>$sinhvienID</td>";
									echo "<td>$ngaysinh</td>";
									echo "<td>$sdt</td>";
									echo "<td>$quequan</td>";
									echo " <td style='text-align: center;'> <a href='chucnang/suasv.php?id=$sinhvienID'><input id='btnSua' type='button' value='sửa' '></a>   <a href='chucnang/xoasv.php?id=$sinhvienID'><input id='btnXoa' type='button' value='xóa'></a> <a href='thongtinsv.php?id=$sinhvienID'><input id='btnChitiet' type='button' value='chi  tiết' '></a>  </td>";
								}
							}

							?>
						</table>
					</div>

					<br>
					<form id="formChucnang">
						<a href="chucnang/themSV.php"><input id="btnThemSV" type="button" value="THÊM SV"> </a>
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