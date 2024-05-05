<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin đăng nhập</title>
</head>
<body>
    <?php
    // Kiểm tra xem dữ liệu đã được gửi từ form hay chưa
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy tên đăng nhập và mật khẩu từ biến $_POST
        $username = $_POST["userName"];
        $password = $_POST["passWord"];

        // Hiển thị thông tin đăng nhập
        echo "<p style='color:red;'><b>Thông tin đăng nhập</b></p>";
        echo "<p>Tên đăng nhập: $username </p>";
        echo "<p>Mật khẩu: $password </p>";
    } else {
        // Nếu không có dữ liệu được gửi, thông báo lỗi
        echo "<p>Không có dữ liệu đăng nhập được gửi.</p>";
    }
    ?>
</body>
</html>
