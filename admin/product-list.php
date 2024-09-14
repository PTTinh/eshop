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
                <col style="width: 20%;" />
                <col style="width: 15%;" />
                <col style="width: 20%;" />
                <col style="width: 10%;" />
            </colgroup>
            <thead>
                <th>ID</th>
                <th>Danh mục</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Ảnh</th>
                <th>Tùy Biến</th>
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
                            <?php 
                            if(empty($discount_price) || $discount_price == 0){
                                echo number_format($price);
                            }else{
                                echo "<s>". number_format($price)."</s>";
                                echo "<br>";
                                echo "$discount_price";
                            }
                            ?>
                        </td>
                        <td><img src="<?= upload($img) ?>" alt="" width="100"></td>
                        <td><a href="<?= route("ssp", ["id" => $id])?>" style="color:#fff; background-color: limegreen;">Sửa</a>
                            <a href="<?= route("xsp", ["id" => $id])?>" style="color:#fff;background-color: red;" onclick="return confirm('Xác nhận xóa')">Xóa</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>
</div>
</section>