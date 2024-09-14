<?php
// Chuyển về trang đăng nhập nếu chưa đăng nhập
if (isset($_SESSION["username"]) == false) {
    set_notify("Bạn cần đăng nhập để truy cập chức năng này!");
    redirect_to(route("dangnhap"), true);
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
    <link rel="stylesheet" href="<?=asset("css/style.css")?>">
    <link rel="stylesheet" href="<?=asset("css/admin.css")?>">
    <link rel="stylesheet" href="<?=asset("css/notify.css")?>">

</head>

<body>
    <header>
        <nav class="nav">
            <div class="nav-Logo">
                <p>LOGO .</p>
            </div>
            <div class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="<?= route("qldm")?>" class="Link active"></a></li>
                    <li><a href="<?= route("tsp")?>" class="Link"></a></li>
                </ul>
            </div>
            <div>
                <a href="<?= route("dangxuat")?>" onclick="return confirm('Xác nhận đăng xuất')">Đăng Xuất</a>
            </div>
        </nav>
    </header>
    <section class="admin-content">
        <div class="admin-content-left">
            <ul>
                <li><a href="#">Danh Mục</a>
                    <ul>
                        <li><a href="<?= route("tdm")?>">Thêm danh mục</a></li>
                        <li><a href="<?= route("qldm")?>">Danh sách danh mục</a></li>
                    </ul>
                </li>
                <li><a href="#">Sản phẩm</a>
                    <ul>
                        <li><a href="<?= route("tsp")?>">Thêm sản phẩm</a></li>
                        <li><a href="<?= route("qlsp")?>">Danh sách sản phẩm</a></li>
                    </ul>
                </li>
            </ul>
        </div>