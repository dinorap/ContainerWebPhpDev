
<?php
session_start();

// Kiểm tra xem người dùng đã submit form chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kết nối CSDL
    // $servername = ""; // Địa chỉ máy chủ MySQL (thường là localhost)
    // $username = ""; // Tên người dùng MySQL
    // $password = ""; // Mật khẩu MySQL (trống vì bạn không đặt mật khẩu)
    // $database = ""; // Tên cơ sở dữ liệu MySQL

    // // Kết nối tới MySQL sử dụng mysqli_connect
    // $conn = mysqli_connect($servername, $username, $password, $database);

    // // Kiểm tra kết nối
    // if (!$conn) {
    //     die("Kết nối CSDL thất bại: " . mysqli_connect_error());
    // }

    // Lấy thông tin đăng nhập từ form
    $username = $_POST["username"];
    $password = $_POST["password"]; 

    // Truy vấn kiểm tra thông tin đăng nhập
    // $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    // $result = mysqli_query($conn, $sql);

    // Kiểm tra xem có kết quả trả về hay không
    $user = "admin";
    $pass = "admin";
        
    if ($username == $user && $password == $pass) {
        $_SESSION["IsLogin"] = true; // Lưu trạng thái đăng nhập vào session
        header("Location: welcome.php"); // Chuyển hướng đến trang chào mừng sau khi đăng nhập thành công
        exit(); // Kết thúc kịch bản sau khi chuyển hướng
    } else {
        // Nếu thông tin đăng nhập không hợp lệ, redirect về trang login
        header("Location: login.html");
        exit(); // Kết thúc kịch bản sau khi chuyển hướng
    }
} else {
    // Nếu không phải phương thức POST, chuyển hướng về trang login
    header("Location: login.html");
}
?>
