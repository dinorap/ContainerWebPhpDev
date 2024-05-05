<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>
<body>
    <h2>Upload Files</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload File" name="submit">
    </form>
    <?php
    // Xử lý upload tệp tin
    if (isset($_FILES["fileToUpload"])) {
        $target_dir = "upload/";
        $temp = explode(".", $_FILES["fileToUpload"]["name"]);
        $newfilename = date("Ymd") . "_" . uniqid() . '.' . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Kiểm tra kích thước tệp
        if ($_FILES["fileToUpload"]["size"] > 2097152) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Cho phép chỉ tải lên các loại tệp cụ thể
        if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
        && $fileType != "gif" && $fileType != "pdf" && $fileType != "docx") {
            echo "Sorry, only JPG, JPEG, PNG, GIF, PDF & DOCX files are allowed.";
            $uploadOk = 0;
        }

        // Kiểm tra nếu $uploadOk = 0
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // Nếu mọi thứ đều ổn, thực hiện upload tệp
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    ?>
</body>
</html>
