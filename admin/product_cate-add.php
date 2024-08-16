<?php
include "_header.php";
include "_slider.php";
if (is_post_method()) {
    //nhận dữ liệu từ form
    $name = $_POST['cate_name'] ?? "";
    //nếu $name có dữ liệu
    if (!empty($name)) {
        //câu query sử dụng parameter (ký tự "?")
        $sql = "INSERT INTO product_cate (cate_name)
                VALUES(?)";
        //mảng dữ liệu dùng cho param tương ứng từng vị trí
        $data = [$name];
        $result = db_execute($sql, $data);
        if ($result == true) {
            js_alert("Thêm dữ liệu thành công.");
            js_redirect_to("/admin/product_cate-list.php");
        }
    }
}

?>
<div class="admin-content-right">
    <div class="admin-content-right-product_cate-add">
        <h1>Thêm Danh Mục</h1>
        <form action="" method="post">
            <input name="cate_name" type="text" placeholder="Nhập tên danh mục">
            <button type="submit">Thêm</button>
        </form>
    </div>
</div>
</section>
<?php include "_footer.php" ?>