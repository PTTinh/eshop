<?php include "_header.php";

// if(isset($_GET['id'])) {
//     $id = $_GET['id'];
//     $sql = "SELECT product.id, product_name, price, discount_price, img, product_cate.cate_name 
//     FROM product
//     LEFT JOIN product_cate ON product_cate.id = cate_id
//     WHERE product.id = $id";
//     $data = db_select($sql);

//     if(empty($data)) {
//         echo "Product not found.";
//         exit;
//     }

//     $product = $data[0];
//     $product_name = $product['product_name'];
//     $price = $product['price'];
//     $discount_price = $product['discount_price'];
//     $img = $product['img'];
//     $cate_name = $product['cate_name'];
// } else {
//     echo "Invalid product ID.";
//     exit;
// }

$id = $_GET['id'] ?? 0;
$sql = "SELECT * FROM product WHERE id = ?";
$data = db_select($sql, [$id]);
$imgold = $data[0]['img'] ?? "";
if (!empty($_GET['id'])) {
    if (is_post_method()) {
        $product_name = $_POST['product_name'] ?? "";
        $price = $_POST['price'] ?? "";
        $discount_price = $_POST['discount_price'] ?? "";
        $cate_id = $_POST['cate_id'] ?? "";
        $img = upload_and_return_filename("img") ?? "";
        $filetype = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        $filesize = $_FILES["img"]["size"] ?? "";
        $alert = "";
        if (!empty($cate_id)) {
            if ($img == "") {
                $sql = "UPDATE product SET product_name = ?, price = ?, discount_price = ?, cate_id = ? WHERE id = ?";
                $data = [
                    $product_name,
                    $price,
                    $discount_price,
                    $cate_id,
                    $id
                ];
                $result = db_execute($sql, $data);
                if ($result == true) {
                    $alert = "Sửa dữ liệu thành công.";
                } else {
                    $alert = "Sửa dữ liệu thất bại.";
                }
            } else {
                if ($filetype != "jpg" && $filetype != "png" && $filetype != "jpeg") {
                    $alert = "Chỉ sử dụng file jpg, png, jpeg.";
                } else if ($filesize > 1000000) {
                    $alert = "File không được lớn hơn 2MB";
                } else {
                    $sql = "UPDATE product SET product_name = ?, price = ?, discount_price = ?, img = ?, cate_id = ? WHERE id = ?";
                    $data = [
                        $product_name,
                        $price,
                        $discount_price,
                        $img,
                        $cate_id,
                        $id
                    ];
                    $result = db_execute($sql, $data);
                    if ($result == true) {
                        $alert = "Sửa dữ liệu thành công.";
                    } else {
                        $alert = "Sửa dữ liệu thất bại.";
                    }
                }
            }
            set_notify($alert);
            redirect_to(route("qlsp"));
        }
    }
}else{
    redirect_to(route("qlsp"));
}
?>

<div class="admin-content-right">
    <div class="admin-content-right-product_add">
        <h1>Sửa Sản Phẩm</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="top">
                <label for="">Chọn Danh Mục Sản Phẩm <span style="color: red;">*</span></label>
                <select name="cate_id" required>
                    <?php
                    $table = 'product_cate';
                    $id = 'id';
                    $cate_name = 'cate_name';
                    gen_option_ele($table, $id, $cate_name, $data[0]['cate_id']);
                    ?>
                </select>
                <label for="">Nhập tên sản phẩm <span style="color: red;">*</span></label>
                <input name="product_name" type="text" value="<?= $data[0]["product_name"] ?>" required>
                <label for="">Giá sản phẩm <span style="color: red;">*</span></label>
                <input name="price" type="number" value="<?= $data[0]["price"] ?>" required>
                <label for="">Giá khuyến mãi <span style="color: red;">*</span></label>
                <input name="discount_price" type="number" value="<?= $data[0]["discount_price"] ?>" required>
                <label for="">Mô tả sản phẩm <span style="color: red;">*</span></label><br>
                <!-- <a href="#" id="Mota" onclick="Mota()">Mô Tả</a><br> -->
                <!-- <textarea id="editor1" name="defcription" cols="30" rows="10"></textarea> -->
                <label for="">Ảnh Sản Phẩm <span style="color: red;">*</span></label>
                <img src="<?= upload($imgold) ?>" alt="" width="100">
            </div>
            <input name="img" type="file">
            <button type="submit">Sửa</button>
        </form>
    </div>
</div>
</section>
<script>
    CKEDITOR.replace('editor1', {
        filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
        filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    });
</script>
<?php include "_footer.php" ?>