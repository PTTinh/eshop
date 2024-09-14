<?php include "_header.php";
// $id = $_GET['id'] ?? 0;
// $sql = "select * from product_cate where id = ?";
// if(empty($sql)){
//     js_alert("Sửa dữ liệu thất bại.");
//     js_redirect_to("/admin/product_cate-list.php");
// }
// $data = [$id];
// $name = $_POST['cate_name'] ?? "";
// $oldname = db_select($sql, $data);
// if (empty($id) == false) {
//     if (empty($name) == false) {
//         $sql = "UPDATE * SET cate_name=? WHERE id=?";
//         $data = [$name, $id];
//         $result = db_execute($sql, $data);
//         if ($result == true) {
//             js_alert("Sửa dữ liệu thành công.");
//         } else {
//             js_alert("Sửa dữ liệu thất bại.");
//         }
//         js_redirect_to("/admin/product_cate-list.php");
//     }
// }
$id = $_GET["id"] ?? 0;
if (is_post_method()) {
    // Nhận dữ liệu từ form, method="post"
    $name = htmlspecialchars($_POST['cate_name'] ?? "");
    // Nếu biến $name có dữ liệu
    if (empty($name) == false) {
        $sql = "SELECT * FROM product_cate WHERE id=?";
        $data = db_select($sql, [$id]);
        if ($name == $data[0]["cate_name"]) {
            set_notify("Tên danh mục không thay đổi!");
        } else {

            // câu query sử dụng parameter (ký tự "?")
            $sql = "UPDATE product_cate SET cate_name=? 
                WHERE id=? ";
            // mảng dữ liệu dùng cho param tương ứng từng vị trí 
            $param = [$name, $id];
            $ket_qua = db_execute($sql, $param);
            // Nếu thực thi thành công (kết quả => true)
            if ($ket_qua == true) {
                set_notify("Sửa danh mục thành công!");
                // quay về trang danh sách khi sửa thành công
                redirect_to(route("qldm"));
            }
        }
    }
} else {
    // Viết câu query để select dữ liệu của bảng product_cate theo id
    // Thực thi query để nhận kết quả
    $sql = "SELECT * FROM product_cate WHERE id=?";
    $data = db_select($sql, [$id]);
    // Nếu không select được dữ liệu thì về trang danh sách
    if (count($data) == 0) {
        redirect_to(route("qldm"));
    }
}

?>
<div class="admin-content-right">

    <div class="admin-content-right-product_cate-add">
        <h1>Sửa Tên Danh Mục</h1>
        <form action="" method="post">
            <input name="cate_name" type="text" value="<?= $data[0]["cate_name"] ?>" placeholder="Nhập tên danh mục">
            <button type="submit">Sửa</button>
        </form>
    </div>
</div>
</section>
<?php include "_footer.php"; ?>