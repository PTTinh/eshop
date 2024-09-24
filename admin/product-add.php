<?php
include "_header.php";

if (is_post_method()) {
    //nhận dữ liệu từ form
    $product_name = $_POST['product_name'] ?? "";
    $price = $_POST['price'] ?? "";
    $discount_price = $_POST['discount_price'] ?? "";
    if ($price < $discount_price) {
        $alert = "Giá khuyến mãi nhỏ hơn giá sản phẩm.";
    } else {
        $defcription = $_POST['defcription'] ?? "";
        $img = upload_and_return_filename("img") ?? "";
        
        $filetype = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        $filesize = $_FILES["img"]["size"] ?? "";
        $cate_id = $_POST['cate_id'] ?? "";
        $alert = "";
        //nếu $name có dữ liệu
        if (!empty($cate_id)) {
            //Kiểm tra file ảnh
            if ($filetype != "jpg" && $filetype != "png" && $filetype != "jpeg") {
                $alert = "Chỉ sử dụng file jpg, png, jpeg.";
            } else if ($filesize > 1000000) {
                $alert = "File không được lớn hơn 2MB";
            } else {
                //câu query sử dụng parameter (ký tự "?")
                $sql = "INSERT INTO 
                product (product_name, 
                price, 
                discount_price, 
                defcription, 
                img, 
                cate_id) VALUES(?, ?, ?, ?, ?, ?)";
                //mảng dữ liệu dùng cho param tương ứng từng vị trí
                $data = [
                    $product_name,
                    $price,
                    $discount_price,
                    $defcription,
                    $img,
                    $cate_id
                ];
                $result = db_execute($sql, $data);
                if ($result == true) {
                    $alert = "Thêm dữ liệu thành công.";
                } else {
                    $alert = "Thêm dữ liệu thất bại.";
                }
            }
            set_notify($alert);
            redirect_to(route("qlsp"));
        }
    }
}
?>
<div class="admin-content-right">
    <div class="admin-content-right-product_add">
        <h1>Thêm Sản Phẩm</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="top">
                <label for="">Chọn Danh Mục Sản Phẩm <span style="color: red;">*</span></label>
                <select name="cate_id" required>
                    <option value>-- Chọn --</option>
                    <?php
                    $table = 'product_cate';
                    $id = 'id';
                    $cate_name = 'cate_name';
                    gen_option_ele($table, $id, $cate_name);
                    ?>
                </select>
                <label for="">Nhập tên sản phẩm <span style="color: red;">*</span></label>
                <input name="product_name" type="text" required>
                <label for="">Giá sản phẩm <span style="color: red;">*</span></label>
                <input name="price" type="number" required>
                <label for="">Giá khuyến mãi <span style="color: red;">*</span></label>
                <input name="discount_price" type="number" required>
                <label for="">Mô tả sản phẩm <span style="color: red;">*</span></label><br>
                <!-- <a href="#" id="Mota" onclick="Mota()">Mô Tả</a><br> -->
                <textarea name="defcription" cols="30" rows="10"></textarea>
                <label for="">Ảnh Sản Phẩm <span style="color: red;">*</span></label>
            </div>
            <input name="img" type="file">
            <button type="submit">Thêm</button>
        </form>
    </div>
</div>
</section>

<?php include "_footer.php" ?>