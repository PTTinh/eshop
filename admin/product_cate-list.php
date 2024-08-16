<?php
include "_header.php";
include "_slider.php";
$sql = "select id, cate_name from product_cate";
$data = db_select($sql);
//xem trc dữ liệu dd($data);
?>
<div class="admin-content-right">
    <div class="admin-content-right-product_cate-list">
        <table>
            <colgroup>
                <col style="width: 5%;" />
                <col style="width: 80%;" />
                <col style="width: 15%;" />
            </colgroup>
            <thead>
                <th>ID</th>
                <th>Tên Danh Mục</th>
                <th>Tùy biến</th>
            </thead>
            <tbody>
                
                <?php
                foreach ($data as $value) {
                    $id = $value['id'];
                    $name = $value['cate_name'];
                ?>
                    <tr>
                        <td><?= "$id" ?></td>
                        <td><?= "$name" ?></td>
                        <td><a href="product_cate-edit.php?id=<?= $id?>" style="color:#fff; background-color: limegreen;">Sửa</a>
                            <a href="product_cate-dele.php?id=<?= $id ?>" style="color:#fff;background-color: red;" onclick="return confirm('Xác nhận xóa')">Xóa</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</section>
<?php include "_footer.php"; ?>