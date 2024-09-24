<?php include "_header.php";
$sql = "SELECT * FROM bills ORDER BY id DESC";
$data = db_select($sql);
?>
<div class="admin-content-right">
    <div class="admin-content-right-product-list">
        <h1>Danh Sách Đơn Hàng</h1>
        <table>
            <colgroup>
                <col style="width: 5%;" />
                <col style="width: 20%;" />
                <col style="width: 20%;" />
                <col style="width: 15%;" />
                <col style="width: 15%;" />
                <col style="width: 15%;" />
            </colgroup>
            <thead>
                <th>ID</th>
                <th>Tên khách hàng</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Tổng tiền</th>
                <th>Ngày giờ</th>
                <th></th>
            </thead>
            <tbody>

                <?php
                foreach ($data as $value) {
                    $id = $value['id'];
                    $fullname = $value['fullname'];
                    $addr = $value['addr'];
                    $phone = $value['phone'];
                    $total = $value['total'];
                    $date = $value['create_date'];
                ?>
                    <tr>
                        <td><?=$id?></td>
                        <td><?=$fullname?></td>
                        <td><?=$addr?></td>
                        <td><?=$phone?></td>
                        <td><?="đ ".number_format($total);?></td>
                        <td><?=$date?></td>
                        <td><a href="">chi tiết</a></td>
                    </tr>
                <?php } ?>
                <tr>
                </tr>
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>
</div>
</section>