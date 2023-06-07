<?php 
require_once __DIR__ . '/../Model/UserProductsModel.php';

class ShowCartController
{
    public function GetShowCart($UserID)
    {
        // Tạo một đối tượng UserProductsModel
        $userProductsModel = new CartModel();

        // Gọi phương thức ShowCart để lấy danh sách giỏ hàng
        return $userProductsModel->ShowCart($UserID);

        // Kiểm tra xem có sản phẩm trong giỏ hàng hay không
        if (!empty($cartItems)) {
            // Hiển thị danh sách sản phẩm trong giỏ hàng
            foreach ($cartItems as $item) {
                $item['ProductID'] = $_SESSION['ProductID'];
            }
        } else {
            echo "Giỏ hàng của bạn đang trống.";
        }
    }
}
?>
