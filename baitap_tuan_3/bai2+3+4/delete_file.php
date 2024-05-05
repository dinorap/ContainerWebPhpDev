<?php
if (isset($_GET['file'])) {
    $file = "upload/" . $_GET['file'];
    // Xóa tệp từ ổ đĩa
    if (unlink($file)) {
        echo "File deleted successfully.";
    } else {
        echo "Error deleting file.";
    }
    // Cập nhật nội dung trang view_files.php
    include 'view_files.php';
}
?>
