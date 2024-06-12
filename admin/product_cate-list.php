<?php
include "_header.php";
include "_slider.php";
$sql = "select id, cate_name from product_cate";
$data = db_select($sql);
//xem trc dữ liệu dd($data);
?>
<div class="admin-content-right">
    <div class="admin-content-right-produc_cate-list">
        <table>
            <colgroup>
                <col style="width: 5%;" />
                <col style="width: 80%;" />
                <col style="width: 15%;" />
            <thead>
                </colgroup>
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
                        <td><?php echo "$id"?></td>
                        <td><?php echo "$name" ?></td>
                        <td><a href="#">Sửa</a> <a href="product_cate-dele.php?id=<?php echo $id ?>" onclick="return confirm('Xác nhận xóa')">Xóa</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</section>
<?php include "_footer.php"; ?>