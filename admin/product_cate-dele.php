<?php 
$id = $_GET['id'] ?? "";
if (empty($id) == false) {
    $sql = "SELECT COUNT(*) AS CNT FROM product WHERE cate_id = ?";
    $data = [$id];
    $count = db_select($sql, [$id])[0]["CNT"];
    if ($count != 0) {
        set_notify("Có $count sản phẩm thuộc danh mục, không thể xóa.");
    } else {
        $sql = "DELETE FROM product_cate WHERE id = ?";
        $data = [$id];
        set_notify("Xoá thành công");
        db_execute($sql, $data);
    }
    redirect_to(route("qldm"));
}
