<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin đăng ký môn học</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Thông tin đăng ký môn học</h2>
    <table>
        <thead>
            <tr>
                <th>MSV</th>
                <th>Họ tên</th>
                <th>Kỳ</th>
                <th>Môn đăng ký</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Đặt mã ký tự UTF-8
            header('Content-Type: text/html; charset=utf-8');

            // Kết nối đến cơ sở dữ liệu
            $conn = mysqli_connect("localhost", "root", "", "PKA_S");

            // Kiểm tra kết nối
            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }

            // Thiết lập kết nối để sử dụng mã ký tự UTF-8
            mysqli_set_charset($conn, "utf8mb4");

            // Truy vấn dữ liệu từ bảng DangKy
            $sql = "SELECT SinhVien.MSSV, SinhVien.HoTen, DangKy.Ky, GROUP_CONCAT(MonHoc.TenMH SEPARATOR ', ') AS MonHoc
                    FROM SinhVien 
                    INNER JOIN DangKy ON SinhVien.MSSV = DangKy.MSSV 
                    INNER JOIN MonHoc ON DangKy.MaMH = MonHoc.MaMH
                    GROUP BY SinhVien.MSSV, SinhVien.HoTen, DangKy.Ky";
            $result = $conn->query($sql);

            // Hiển thị dữ liệu
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Tách các môn đăng ký thành mảng
                    $monHocArray = explode(", ", $row["MonHoc"]);
                    // Số môn đăng ký
                    $soMonDangKy = count($monHocArray);
                    echo "<tr>";
                    echo "<td rowspan='$soMonDangKy'>" . $row["MSSV"] . "</td>";
                    echo "<td rowspan='$soMonDangKy'>" . $row["HoTen"] . "</td>";
                    // Hiển thị kỳ và môn đăng ký
                    foreach ($monHocArray as $key => $monHoc) {
                        if ($key != 0) {
                            echo "<tr>";
                        }
                        echo "<td>" . $row["Ky"] . "</td>";
                        echo "<td>" . $monHoc . "</td>";
                        echo "</tr>";
                    }
                }
            } else {
                echo "<tr><td colspan='4'>Không có dữ liệu</td></tr>";
            }

            // Đóng kết nối
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
