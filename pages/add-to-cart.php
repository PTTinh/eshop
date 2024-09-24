<?php 
$id = $_GET['id'] ?? 0;
$sql = "SELECT product_name FROM product WHERE id = ?";
$data = db_select($sql, [$id]);
$data = $data[0];
// Mỗi lần lưu một sản phẩm
if($id==0){
    redirect_to(route("home"));
}
if(isset($_SESSION["cart_$id"])){
    $_SESSION["cart_$id"] += 1;
}else{
    $_SESSION["cart_$id"] = 1;
}
set_notify("Sản phẩm đã thêm ".$data["product_name"] ." vào giỏ hàng");
redirect_to(route("home"));


?>