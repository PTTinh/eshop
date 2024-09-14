<?php include "_header.php" ?>
<?php
$id = $_GET['id'] ?? "";
if (!empty($id)) {
    $sql = "SELECT product.id,  product_name, price, discount_price, img, product_cate.cate_name 
    FROM product
    LEFT JOIN product_cate ON  product_cate.id = cate_id
    WHERE cate_id = ?
    ORDER BY id DESC";
    $data = db_select($sql, [$id]);
} else {
    $sql = "SELECT product.id,  product_name, price, discount_price, img, product_cate.cate_name 
    FROM product
    LEFT JOIN product_cate ON  product_cate.id = cate_id
    ORDER BY id DESC";
    $data = db_select($sql);
}
?>

<h1>
    <?php 
    if (empty($id)) {
        echo "Danh sách sản phẩm";
    } else {
        echo $data[0]['cate_name'];
    } 
    ?>
</h1>

<div class="card-list">

    <?php
    foreach ($data as $value) {
        $id = $value['id'];
        $cate_name = $value['cate_name'];
        $product_name = $value['product_name'];
        $price = $value['price'];
        $discount_price = $value['discount_price'];
        $img = $value['img'];
    ?>
        <div class="card">
            <div class="card-img">
                <img src="<?= upload($img) ?>" alt="">
            </div>
            <div class="card-info">
                <h3 title="<?= "$product_name" ?>"><?= "$product_name" ?></h3>
                <p><?php
                    if (empty($discount_price) || $discount_price == 0) {
                        echo number_format($price);
                    } else {
                        echo "<s>" . number_format($price) . " vnđ</s>";
                        echo "<br>";
                        echo number_format($discount_price) . " vnđ";
                    }
                    ?></p>
                <small><?= "$cate_name" ?></small>
                <a href="" class="card-action">Đặt hàng</a>
            </div>
        </div>
    <?php } ?>
</div>
<?php include "_footer.php" ?>