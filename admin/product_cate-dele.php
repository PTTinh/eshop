<?php include "../include/common.php";
$id = $_GET['id'] ?? "";
if (empty($id) == false) {
    $sql = "SELECT COUNT(*) AS CNT FROM product WHERE cate_id = ?";
    $data = [$id];
    $count = db_select($sql, [$id])[0]["CNT"];
    if ($count != 0) {
        js_alert("Có $count sản phẩm thuộc danh mục, không thể xóa.");
        js_redirect_to("/admin/product_cate-list.php");
    } else {
        $sql = "DELETE FROM product_cate WHERE id = ?";
        $data = [$id];
        db_execute($sql, $data);
    }
    js_redirect_to("/admin/product_cate-list.php");
}
