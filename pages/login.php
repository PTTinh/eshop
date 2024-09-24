<?php
if (is_post_method()) {
    $username = $_POST["user"] ?? "";
    $password = $_POST["pwd"] ?? "";

    // có nhập username
    if (empty($username) == false) {
        $sql = "select * from user where user=?";
        $user = db_select($sql, [$username]);
        if (count($user) == 0) {
            set_notify("Sai tên đăng nhập hoặc mật khẩu!");
            redirect_to(route("dangnhap"), true);
        }
        // nếu tồn tại username thì so sánh mật khẩu
        $user = $user[0];
        // nếu mật khẩu người dùng nhập vào đúng => đăng nhập thành công
        if (password_verify($password, $user["pwd"]) == true) {
            // Lưu thông tin username vào session
            $_SESSION["username"] = $username;
            set_notify("Đăng nhập thành công!");
            redirect_to(route("qldm"), true);
        } else {
            set_notify("Sai tên đăng nhập hoặc mật khẩu!");
            redirect_to(route("dangnhap"), true);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=asset("css/stylelogin.css")?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!-- Main -->
    <form action="" method="post">
        <div class="wrapper">
            <div class="form-box">
                <!-- Login -->
                <div class="login-container" id="login">
                    <div class="top">
                        <header>Log In</header>
                    </div>
                    <div class="input-box">
                        <input type="text" class="input-field" name="user" placeholder="Username">
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" class="input-field" name="pwd" placeholder="Password">
                        <i class="bx bx-lock-alt"></i>
                    </div>
                    <div class="input-box">
                        <input type="submit" class="submit" value="Login">
                    </div>
                    <div class="two-col">
                        <div class="one">
                            <input type="checkbox" id="login-check">
                            <label for="login-check"> Remember Me</label>
                        </div>
                        <div class="two">
                            <label>
                                <a href="#">|Forgot password</a>
                            </label>
                        </div>
                    </div>
                </div>
    </form>
</body>

</html>