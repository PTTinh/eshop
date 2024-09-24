<?php include "_header.php";
$cart = get_id_from_cart();
$sql = "SELECT product.id,  product_name, price, discount_price, img, cate_name
FROM product
LEFT JOIN product_cate ON product_cate.id = product.cate_id
WHERE FIND_IN_SET(product.id, ?)
ORDER BY id DESC";

$data = db_select($sql, [join(",", $cart)]);
?>
<div class="cart">
    <h1>Giỏ Hàng</h1>
    <table>
        <colgroup>
            <col style="width: 10%;" />
            <col style="width: 20%;" />
            <col style="width: 20%;" />
            <col style="width: 20%;" />
            <col style="width: 10%;" />
            <col style="width: 10%;" />
            <col style="width: 10%;" />
        </colgroup>
        <thead>
            <th>Danh mục</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Ảnh</th>
            <th>SL</th>
            <th>Tổng</th>
            <th>Tùy Biến</th>
        </thead>
        <tbody>

            <?php
            $bills_total = 0;
            foreach ($data as $value) {
                $id = $value['id'];
                $cate_name = $value['cate_name'];
                $product_name = $value['product_name'];
                $price = $value['price'];
                $discount_price = $value['discount_price'];
                $img = $value['img'];
                $final_price = 0;
                if (empty($discount_price) || $discount_price == 0) {
                    $final_price = $price;
                } else {
                    $final_price = $discount_price;
                }
                $quantity = $_SESSION["cart_$id"];
                $total = $quantity * $final_price;
                $bills_total += $total;
            ?>
                <tr>
                    <td><?= "$cate_name" ?></td>
                    <td><?= "$product_name" ?></td>
                    <td><?= number_format($final_price) ?></td>
                    <td><img src="<?= upload($img) ?>" alt="" width="100"></td>
                    <td><?= $quantity ?></td>
                    <td><?= number_format($total) ?></td>
                    <td>
                        <a href="<?= route("xgh", ["id" => $id]) ?>" style="color:#fff;background-color: red;" onclick="return confirm('Xác nhận xóa')">Xóa</a>
                    </td>
                </tr>
            <?php } ?>
            <?php echo $cart == [] ? "<tr>
                    <td colspan='7'>
                        <p style='text-align: center;'>Giỏ hàng trống.</p>
                    </td>
                </tr>" : ""?>
            <tr>
                <td colspan="7">
                    <p style="display: flex; justify-content: space-between;">
                        Tổng giá đơn hàng: <?= number_format($bills_total) ?>
                        <a
                            style="color:#fff;background-color: green; padding: 5px;"
                            href="<?= route("dh") ?>">
                            Đặt hàng ngay!
                        </a>
                    </p>
                </td>
            </tr>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</div>
<?php include "_footer.php" ?>