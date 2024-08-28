<?php include "_header.php";
$sql = "SELECT product.id,  product_name, price, discount_price, img, product_cate.cate_name 
FROM product
LEFT JOIN product_cate ON  product_cate.id = cate_id
ORDER BY id DESC";
$data = db_select($sql);
?>
<div class="admin-content-right">
    <div class="admin-content-right-product-list">
        <h1>Danh Sách Sản Phẩm</h1>
        <table>
            <colgroup>
                <col style="width: 5%;" />
                <col style="width: 30%;" />
                <col style="width: 25%;" />
                <col style="width: 15%;" />
                <col style="width: 25%;" />
            </colgroup>
            <thead>
                <th>ID</th>
                <th>Danh mục</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Ảnh</th>
            </thead>
            <tbody>

                <?php
                foreach ($data as $value) {
                    $id = $value['id'];
                    $cate_name = $value['cate_name'];
                    $product_name = $value['product_name'];
                    $price = $value['price'];
                    $discount_price = $value['discount_price'];
                    $img = $value['img'];
                ?>
                    <tr>
                        <td><?= "$id" ?></td>
                        <td><?= "$cate_name" ?></td>
                        <td><?= "$product_name" ?></td>
                        <td>
                            <?= "$price" ?> <br>
                            <?= "$discount_price" ?>
                        </td>
                        <td><img src="<?= upload($img) ?>" alt="" width="100"></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>
</div>
</section>