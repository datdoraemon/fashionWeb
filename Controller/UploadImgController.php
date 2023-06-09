<?php
require_once __DIR__ . '/../Model/UsersModel.php';

if (isset($_POST['submit'])) {
    $targetDir = "D:/V-ANH/vana/Project2/fashionWeb/View/Img/";
    $targetFile = $targetDir . basename($_FILES['image']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Kiểm tra xem tệp tin đã tồn tại hay chưa
    if (file_exists($targetFile)) {
        echo "Tệp tin đã tồn tại.";
        $uploadOk = 0;
    }

    // Kiểm tra kích thước của tệp tin
    if ($_FILES['image']['size'] > 500000) {
        echo "Kích thước tệp tin quá lớn.";
        $uploadOk = 0;
    }

    // Chỉ chấp nhận các định dạng ảnh cụ thể (ví dụ: jpg, png)
    $allowedExtensions = array('jpg', 'jpeg', 'png');
    if (!in_array($imageFileType, $allowedExtensions)) {
        echo "Chỉ chấp nhận các định dạng ảnh JPG, JPEG, PNG.";
        $uploadOk = 0;
    }

    // Kiểm tra biến $uploadOk để xác định xem việc upload có thành công hay không
    if ($uploadOk == 0) {
        echo "Upload không thành công.";
    } else {
        // Di chuyển tệp tin upload vào thư mục đích
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            echo "Upload thành công.";
            $imagePath = "Img/" . basename($_FILES['image']['name']);
            echo $imagePath;

            // Kiểm tra xem ảnh có tồn tại trong thư mục hay không
            $imageFullPath = "D:/V-ANH/vana/Project2/fashionWeb/View/" . $imagePath;
            if (file_exists($imageFullPath)) {
                // Hiển thị ảnh
                echo '<img class="img-thumbnail" style="width: 200px; height: 500px;" src="' . $imagePath . '" alt="Ảnh người dùng">';
            } else {
                echo $imageFullPath;
                echo "Không tìm thấy ảnh.";
            }

            session_start();
            $userID = $_SESSION['UserID'];

            // Lưu link ảnh vào cơ sở dữ liệu
            $userModel = new UsersModel();
            $userImg = $userModel->updateImg($imagePath);
            if ($userImg) {
                echo "Lưu đường dẫn ảnh thành công.";
            } else {
                echo "Lưu đường dẫn ảnh không thành công.";
            }
        } else {
            echo "Upload không thành công.";
        }
    }
}
?>
