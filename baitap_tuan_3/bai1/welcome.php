<?php
session_start();
if ($_SESSION["IsLogin"] == false)
header("Location: login.html");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>

<body>
    <p>Đăng nhập thành công</p>
    <form action="logout.php" method="post">
        <input type="submit" value="Logout">
    </form>
</body>

</html>