<?php
include "_header.php";
$submit = $_POST["submit"] ?? "";
$table = 'user';
$result = " ";
if ($submit == "Delete") {
    $user = $_POST["user_name"] ?? "";
    $sql = "DELETE FROM user WHERE user='$user'";
    db_execute($sql);
    $result = "Xoa tai khoan thanh cong";
} elseif ($submit == "Register") {
    $user = $_POST["user"] ?? "";
    $pwd = $_POST["pwd"] ?? "";
    //hash mật khẩu
    $pwd = password_hash($pwd, null);
    $r = false;
    $sql = "select user from user";
    $data = db_select($sql);
    foreach ($data as $rows) {
        if ($user == $rows['user']) {
            $r = true;
        }
    }
    if (!($r) && ($user != "" && ($pwd != ""))) {
        $sql = "INSERT INTO user (user, pwd)
                VALUES('$user','$pwd')";
        db_execute($sql);
        $result = "Tao tai khoan thanh cong.";
    } else {
        $result = "Tai khoan da ton tai.";
    }
} elseif ($submit == "Edit") {
    $id = $_POST["id1"] ?? "";
    $user = $_POST["user1"] ?? "";
    $pwd = $_POST["pwd1"] ?? "";
    $r = false;
    $sql = "select id from user";
    $data = db_select($sql);
    foreach ($data as $rows) {
        if ($id == $rows['id']) {
            $r = true;
        }
    }
    if ($r) {
        //hash mật khẩu
        $pwd = password_hash($pwd, null);
        $sql = "UPDATE user SET id='$id', user='$user', pwd='$pwd' WHERE id='$id'";
        db_execute($sql);
        $result = "Sua thanh cong.";
    } else {
        $result = "Id Khong toan tai.";
    }
}
?>
<form action="" method="post">
    <h1>Trang Quản Lí</h1><br>
    <p>Thêm tài khoản</p>
    <input type="text" name="user" placeholder="Username">
    <input type="password" name="pwd" placeholder="Password">
    <input type="submit" name="submit" value="Register">
    <p>Xoa tai khoan</p>
    <select name="user_name">
        <?php gen_option_ele($table, $table, $table); ?>
    </select>
    <input type="submit" name="submit" value="Delete">
    <p>Sua tai khoan</p>
    <table>
        <tr>
            <td>id</td>
            <td>Tai Khoan</td>
            <td>Mat Khau</td>
        </tr>
        <?php
        $sql = "select * from user";
        $data = db_select($sql);
        foreach ($data as $row) {
            echo "<tr>";
            echo "<td> " . $row['id'] . "</td> ";
            echo "<td> " . $row['user'] . "</td> ";
            echo "<td> " . $row['pwd'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <input type="number" name="id1" placeholder="Id">
    <input type="text" name="user1" placeholder="Username">
    <input type="password" name="pwd1" placeholder="Password">
    <input type="submit" name="submit" value="Edit">
    <br>
    <?php echo "$result"; ?>
    <br>
</form>
<?php include "_footer.php"; ?>