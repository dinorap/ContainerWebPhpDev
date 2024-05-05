<?php
session_start();

// Xóa toàn bộ dữ liệu session
$_SESSION = array();

// Hủy session
session_destroy();

// Redirect về trang login sau khi logout
header("Location: login.html");
exit;
?>
