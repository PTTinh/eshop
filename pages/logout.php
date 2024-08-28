<?php
include "../include/common.php";
session_start();
unset($_SESSION["username"]);
js_redirect_to("/pages/login.php", true);
?>