<?php
$sql = "SELECT * FROM product_cate";
$data = db_select($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EShop</title>
    <link rel="stylesheet" href="<?= asset("css/site.css") ?>">
    <link rel="stylesheet" href="<?= asset("css/notify.css") ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="container">
        <header>

            <nav class="nav">
                <div class="nav-menu-left">
                    <div class="nav-Logo">
                        <p>LOGO .</p>
                    </div>
                </div>
                <div class="nav-menu-mid">
                    <div class="menu-search">
                        <form action="<?=route("home")?>" method="get">
                            <label>
                                <input name="ip-search" type="text" placeholder="Tìm kiếm"
                                    value="<?= htmlspecialchars($_GET["ip-search"] ?? "") ?>" />
                                <i class='bx bx-search-alt-2'></i>
                            </label>
                        </form>
                    </div>
                </div>
                <div class="nav-menu-right">
                    <div class="btn-shopping-bag">
                        <?php $cart_cnt = count(get_id_from_cart()); ?>
                        <a class="<?= $cart_cnt > 0 ? "has-product" : "" ?>" href="<?= route("cart") ?>"><i class='bx bx-shopping-bag'></i></a>
                    </div>
                    <div class="btn-setting">
                        <i class='bx bxs-cog'></i>
                    </div>
                </div>
            </nav>
        </header>
        <section class="main">
            <aside>
                <nav class="aside-menu">
                    <a href="<?= route("home") ?>">DANH SÁCH SẢN PHẨM</a>
                    <ul>
                        <?php foreach ($data as $value) {
                            $id = $value['id'];
                            $cate_name = $value['cate_name'];
                        ?>
                            <li><a href="<?= route("home", ["id" => $id]) ?>"><?= $cate_name ?></a></li>
                        <?php } ?>
                    </ul>
                </nav>
            </aside>
            <main>