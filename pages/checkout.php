<?php
include "_header.php";
$carts =  get_id_from_cart();
if (empty($carts)) {
    set_notify("Giỏ hàng trống, vui lòng chọn sản phẩm");
    redirect_to(route("home"));
}
$sql = "SELECT id, price, discount_price, product_name
        FROM product 
        WHERE FIND_IN_SET(id, ?)";
$id = join(",", $carts);
$data = db_select($sql, [$id]);
$bills_total = 0;
$bill_details_data = [];
foreach ($data as $value) {
    $id = $value['id'];
    $price = $value['price'];
    $product_name = $value['product_name'];
    $discount_price = $value['discount_price'];
    $final_price = 0;
    if (empty($discount_price) || $discount_price == 0) {
        $final_price = $price;
    } else {
        $final_price = $discount_price;
    }
    $quantity = $_SESSION["cart_$id"];
    $total = $quantity * $final_price;
    $bills_total += $total;
    //thêm vào mảng
    //ht chx có bill_id nên để tạm là 0
    $bill_details_data[] = [0, $id, $product_name, $final_price, $quantity, $total];
}
if (is_post_method()) {
    $fullname = $_POST['fullname'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $addr = $_POST['addr'] ?? '';
    $sql = "INSERT INTO bills(fullname, phone, addr, total, create_date) VALUES(?,?,?,?, now())";
    db_execute($sql, [$fullname, $phone, $addr, $bills_total], $bill_id);
    $bill_details_sql = "INSERT INTO bill_details(
        bill_id,
        product_id,
        product_name,
        price,
        quantity,
        total) VALUES(?,?,?,?,?,?)";
    foreach ($bill_details_data as $value) {
        $value[0] = $bill_id;
        db_execute($bill_details_sql, $value);
        //xóa giỏ hàng
        unset($_SESSION["cart_$value[1]"]);
    }

    set_notify("Đặt hàng thành công");
    redirect_to(route("home"));
}

?>
<div class="check-out">
    <h1>Đặt Hàng</h1>
    <form action="" method="post">
        <div id="checkout-form">
            <div>
                <label for="fullname">Họ và tên</label>
                <input type="text" name="fullname" id="fullname" required>
            </div>
            <div>
                <label for="phone">Số điện thoại</label>
                <input type="text" name="phone" id="phone" required>
            </div>
            <div>
                <label for="addr">Địa chỉ</label>
                <!-- <input type="text" name="addr" id="addr" required> -->
                <textarea name="addr" id="addr" required></textarea>
            </div>
        </div>
        <div id="checkout-submit">
            <input type="submit" value="Đặt hàng" onclick="return confirm('Xác nhận đặt hàng')">
        </div>
    </form>
</div>
<?php include "_footer.php" ?>