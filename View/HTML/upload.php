<?php
// Đường dẫn đến thư viện Google API
require_once __DIR__ . '/../../vendor/autoload.php';

// Cấu hình thông tin xác thực Google API
$client = new Google_Client();
$client->setAuthConfig('path/to/client_secret.json');
$client->addScope(Google_Service_Drive::DRIVE_FILE);

// Khởi tạo Google Drive API
$service = new Google_Service_Drive($client);

// Kiểm tra xem người dùng đã tải lên tệp tin hay chưa
if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // Thông tin tệp tin tải lên
    $fileData = $_FILES['image'];
    
    // Tạo một tệp tin trên Google Drive
    $fileMetadata = new Google_Service_Drive_DriveFile(array(
        'name' => $fileData['name']
    ));
    $file = $service->files->create($fileMetadata, array(
        'data' => file_get_contents($fileData['tmp_name']),
        'mimeType' => $fileData['type'],
        'uploadType' => 'multipart',
        'fields' => 'id'
    ));
    
    // Lấy URL của tệp tin đã tạo
    $fileId = $file->id;
    $fileUrl = "https://drive.google.com/uc?id=$fileId";
    
    // Lưu URL của ảnh vào cơ sở dữ liệu
    // Kết nối và thực hiện truy vấn để lưu URL vào cột ImgUser trong bảng Users
    $servername = "localhost";
    $username = "guest";
    $password = "123456";
    $database = "fashionShop";
    
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Kết nối tới cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }
    
    $userId = 1; // Thay thế bằng ID người dùng thích hợp
    $sql = "UPDATE Users SET ImgUser='$fileUrl' WHERE UserID=$userId";
    if ($conn->query($sql) === TRUE) {
        echo "Tải lên ảnh thành công!";
    } else {
        echo "Lỗi khi lưu URL ảnh vào cơ sở dữ liệu: " . $conn->error;
    }
    
    $conn->close();
} else {
    echo "Lỗi khi tải lên ảnh: " . $_FILES['image']['error'];
}
?>
