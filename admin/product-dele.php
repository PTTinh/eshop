<?php 
$id = $_GET['id'] ?? "";
if (empty($id) == false) {
    $sql = "SELECT img FROM product WHERE id = ?";
    $img = db_select($sql, [$id])[0]["img"] ?? "";
    $sql = "DELETE FROM product WHERE id = ?";
    $data = [$id];
    $result = db_execute($sql, $data);
    if ($result == true) {
        if (empty($img) == false) {
            remove_file($img);
        }

        set_notify("Xoá thành công");
    }else{

        set_notify("Xoá thất bại");
    }
}
redirect_to(route("qlsp"));
