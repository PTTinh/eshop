<?php
function get_id_from_cart()
{
    // Lấy ra các key của session
    foreach ($_SESSION as $key => $value) {
        // Nếu key bắt đầu bằng cart_ thì lấy ra id sản phẩm
        if (strpos($key, "cart_") === 0)
            // Tách chuỗi cart_1 => [cart, 1]
            $carts[] = explode("_", $key)[1];

    }
    if (empty($carts)) {
        return [];
    }
    return $carts;
}
