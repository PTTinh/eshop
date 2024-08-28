<?php include "../include/common.php";
session_start();

// Chuyển về trang đăng nhập nếu chưa đăng nhập
if (isset($_SESSION["username"]) == false) {
    js_alert("Bạn cần đăng nhập để truy cập chức năng này!");
    js_redirect_to("/pages/login.php", true);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="./ckeditor/ckeditor.js"></script>
    <script src="./ckfinder/ckfinder.js"></script>
    <link rel="stylesheet" href="../asset/css/admin.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../pages/style.css">
</head>

<body>
    <header>
        <nav class="nav">
            <div class="nav-Logo">
                <p>LOGO .</p>
            </div>
            <div class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="./product_cate-list.php" class="Link active"></a></li>
                    <li><a href="./product-add.php" class="Link"></a></li>
                </ul>
            </div>
            <div>
                <a href="../pages/logout.php" onclick="return confirm('Xác nhận đăng xuất')">Đăng Xuất</a>
            </div>
        </nav>
    </header>
    <section class="admin-content">
        <div class="admin-content-left">
            <ul>
                <li><a href="#">Danh Mục</a>
                    <ul>
                        <li><a href="./product_cate-add.php">Thêm danh mục</a></li>
                        <li><a href="./product_cate-list.php">Danh sách danh mục</a></li>
                    </ul>
                </li>
                <li><a href="#">Sản phẩm</a>
                    <ul>
                        <li><a href="./product-add.php">Thêm sản phẩm</a></li>
                        <li><a href="./product-list.php">Danh sách sản phẩm</a></li>
                    </ul>
                </li>
            </ul>
        </div>