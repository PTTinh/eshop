<?php include "_header.php"; ?>

<?php
$id = $_GET['id'] ?? 0;
// Lấy giá trị tìm kiếm từ query string
$search = $_GET['ip-search'] ?? '';

// Khởi tạo câu lệnh SQL cơ bản
$sql = "SELECT product.id, product_name, price, discount_price, img, product_cate.cate_name 
    FROM product
    LEFT JOIN product_cate ON product_cate.id = cate_id";
$params = [];

// Nếu có giá trị tìm kiếm, thêm điều kiện tìm kiếm vào câu lệnh SQL
if (!empty($search)) {
    $sql .= " WHERE product_name LIKE CONCAT('%', ?, '%')";
    $params[] = $search;
}

// Nếu có giá trị id, thêm điều kiện lọc theo danh mục vào câu lệnh SQL
if (!empty($id)) {
    $sql .= empty($search) ? " WHERE cate_id = ?" : " AND cate_id = ?";
    $params[] = $id;
}

// Sắp xếp kết quả theo id giảm dần
$sql .= " ORDER BY id DESC";

// Thực hiện truy vấn và lấy dữ liệu
$data = db_select($sql, $params);
?>

<h1>
    <?php 
    // Hiển thị tiêu đề trang
    echo empty($id) ? "Danh sách sản phẩm" : ($data[0]['product_name'] ?? ""); 
    ?>
</h1>

<div class="card-list">
    <?php if (empty($data)): ?>
    <h3>Không có sản phẩm nào</h3>
    <?php else: ?>
    <?php foreach ($data as $value): ?>
        <div class="card">
        <div class="card-img">
            <img src="<?= upload($value['img']) ?>" alt="">
        </div>
        <div class="card-info">
            <h3 title="<?= $value['product_name'] ?>"><?= $value['product_name'] ?></h3>
            <p>
            <?php 
            // Hiển thị giá sản phẩm, nếu có giá giảm thì hiển thị cả giá gốc và giá giảm
            if (empty($value['discount_price']) || $value['discount_price'] == 0): ?>
                <?= number_format($value['price']) ?>
            <?php else: ?>
                <s><?= number_format($value['price']) ?> vnđ</s><br>
                <?= number_format($value['discount_price']) ?> vnđ
            <?php endif; ?>
            </p>
            <small><?= $value['cate_name'] ?></small>
            <a href="<?= route("atc", ["id" => $value['id']]) ?>" class="card-action" onclick="return confirm('Xác nhận thêm vào giỏ hàng')">Thêm vào giỏ hàng</a>
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
</div>
<?php include "_footer.php"; ?>




<!-- 
<?php include "_header.php" ?>

<?php
$id = $_GET['id'] ?? 0;
if (!empty($id)) {
    $sql = "SELECT product.id,  product_name, price, discount_price, img, product_cate.cate_name 
    FROM product
    LEFT JOIN product_cate ON  product_cate.id = cate_id
    WHERE cate_id = ?
    ORDER BY id DESC";
    $data = db_select($sql, [$id]);
} else {
    $sql = "SELECT product.id,  product_name, price, discount_price, img, product_cate.cate_name 
    FROM product
    LEFT JOIN product_cate ON  product_cate.id = cate_id
    ORDER BY id DESC";
    $data = db_select($sql);
}



?>

<h1>
<?php 
    if (empty($id)) {
        echo "Danh sách sản phẩm";
    } else {
        echo $data[0]['product_name'] ?? "";
    }
    ?>
</h1>

<div class="card-list">

    <?php
    foreach ($data as $value) {
        $id = $value['id'];
        $cate_name = $value['cate_name'];
        $product_name = $value['product_name'];
        $price = $value['price'];
        $discount_price = $value['discount_price'];
        $img = $value['img'];
    ?>
        <div class="card">
            <div class="card-img">
                <img src="<?= upload($img) ?>" alt="">
            </div>
            <div class="card-info">
                <h3 title="<?= "$product_name" ?>"><?= "$product_name" ?></h3>
                <p><?php
                    if (empty($discount_price) || $discount_price == 0) {
                        echo number_format($price);
                    } else {
                        echo "<s>" . number_format($price) . " vnđ</s>";
                        echo "<br>";
                        echo number_format($discount_price) . " vnđ";
                    }
                    ?></p>
                <small><?= "$cate_name" ?></small>
                <a href="<?=route("atc", ["id" => $id]);?>" class="card-action" onclick="return confirm('Xác nhận thêm vào giỏ hàng')">Thêm vào giỏ hàng</a>
            </div>
        </div>
    <?php } ?>
    <?php 
    if (empty($data[0]['cate_name'])) {
        echo "<h3>Không có sản phẩm nào</h3>";
    }

    ?>
</div>
<?php include "_footer.php" ?> -->
