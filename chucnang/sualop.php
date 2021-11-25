<?php
session_start();
if (isset($_SESSION['username'])) {
	$link = new mysqli('localhost', 'root', '', 'sinhvien') or die('kết nối thất bại ');
	mysqli_query($link, 'SET NAMES UTF8');
	$query = 'SELECT * FROM lophoc WHERE lopID = "' . $_GET['id'] . '"';
	$result = mysqli_query($link, $query);
	if (mysqli_num_rows($result) > 0) {
		$i = 0;
		while ($r = mysqli_fetch_assoc($result)) {
			$i++;
			$lop = $r['tenlop'];
			$GVchunhiem = $r['chunhiem'];
			$phongHoc = $r['phonghoc'];
		}
	}

	//echo $query;
?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<title>Sửa thông tin lớp </title>
		<link rel="stylesheet" href="../style/style.css">
		<link rel="stylesheet" href="../style/fontawesome/css/all.css">
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
						<li><a href="../index.php"><i class="fas fa-home"></i>Trang chủ</a></li>
						<li><a id="current" href="../lop.php"><i class="fas fa-users"></i>Lớp thực tập</a></li>
						<li><a href="../sinhvien.php"><i class="fas fa-graduation-cap"></i>Sinh viên</a></li>
						<li><a href="../giangvien.php"><i class="fas fa-chalkboard-teacher"></i>Giảng viên</a></li>
					</ul>
				</div>
				<div id="main-contain">
					<h2>Sửa thông tin Lớp</h2>
					<div class="form">
						<form method="post">
							<table>
								<tr>
									<td>Tên Lớp : </td>
									<td> <input type="text" name="ten" value="<?php echo $lop; ?>"> </td>
								</tr>
								<tr>
									<td>GVCN :</td>
									<td> <input type="text" name="GVCN" value="<?php echo $GVchunhiem; ?>"> </td>
								</tr>
								<tr>
									<td colspan=2>
										<input id="btnChapNhan" type="submit" value="Hoàn tất" name="sua" />
									</td>
								</tr>
							</table>

						</form>
						<?php
						$link = new mysqli('localhost', 'root', '', 'sinhvien') or die('kết nối thất bại ');
						mysqli_query($link, 'SET NAMES UTF8');

						if (isset($_POST['sua'])) {
							if (empty($_POST['ten']) or empty($_POST['GVCN'])) {
								echo '</br> <p style="color:red; "> vui lòng không để trống các trường! </p> </br>';
							} else {
								$lop = $_POST['ten'];
								$GVchunhiem = $_POST['GVCN'];
								$query = "UPDATE `lophoc` SET tenlop='$lop',chunhiem = '$GVchunhiem' , phonghoc = '$phongHoc' WHERE tenlop = '$lop'";
								mysqli_query($link, $query) or die("sửa không thành công");
								header('location:../lop.php');
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
	header('location:../login.php');
}

?>