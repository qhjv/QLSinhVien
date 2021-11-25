<?php
session_start();
if (isset($_SESSION['username'])) {

  // echo $_SESSION['username'];
  $link = new mysqli('localhost', 'root', '', 'sinhvien') or die('failed');
  mysqli_query($link, 'SET NAMES UTF8');
  $query = 'SELECT * FROM tintuc';
  $result = mysqli_query($link, $query);
?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <title>SM - Trang chủ</title>
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
            <li><a id="current" href="#"><i class="fas fa-home"></i>Trang chủ</a></li>
            <li><a href="lop.php"><i class="fas fa-users"></i>Lớp thực tập</a></li>
            <li><a href="sinhvien.php"><i class="fas fa-graduation-cap"></i>Sinh viên</a></li>
            <li><a href="giangvien.php"><i class="fas fa-chalkboard-teacher"></i>Giảng viên</a></li>


          </ul>
          </br>
        </div>
        <div id="cthome">
          <p style="color:#000">Chào mừng đến với trang quản lý sinh viên thực tập</p>
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
  header('location: login.php');
}
?>