<?php include "../include/common.php";
$id = $_GET['id'] ?? "";
if (empty($id) == false) {
    $sql = "DELETE FROM product WHERE id = ?";
    $data = [$id];
    $result = db_execute($sql, $data); 
    js_redirect_to("/admin/product_cate-list.php");
}