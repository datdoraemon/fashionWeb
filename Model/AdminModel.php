<?php

require_once 'Database.php';

class AdminModel
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function CreateAccount($email, $password)
    {
        $stmt = $this->conn->prepare("INSERT INTO Seller (Email, Password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $password);
        $result = $stmt->execute();

        if (!$result) {
            return false;
        }

        return true;
    }

    public function CreateShop($shopname)
    {
        $stmt = $this->conn->prepare("INSERT INTO ShopName (ShopName) VALUES (?)");
        $stmt->bind_param("s", $shopname);
        $result = $stmt->execute();

        if (!$result) {
            return false;
        }

        return true;
    }

    public function getShopIDLast()
    {
        $stmt = $this->conn->prepare("SELECT ShopID FROM ShopName ORDER BY ShopID DESC LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $shopID= $result->fetch_assoc();
            return $shopID;
        }

        return false;
    }

    public function SaveShop($sellerID, $shopID)
    {
        $stmt = $this->conn->prepare("INSERT INTO Seller_Shop (SellerID, ShopID) VALUES (?, ?)");
        $stmt->bind_param("ii", $sellerID, $shopID);
        $result = $stmt->execute();

        if (!$result) {
            return false;
        }

        return true;
    }

    public function updateAdminInformation($SellerID, $fullname, $birthday, $address, $phone)
    {
        $stmt = $this->conn->prepare("UPDATE Seller SET FullName = ?, Birthday = ?, Address = ?, Phone = ? WHERE SellerID = ?");
        $stmt->bind_param("ssssi", $fullname, $birthday, $address, $phone, $SellerID);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        }

        return false;
    }

    public function InsertShop($shopname)
    {
        $stmt = $this->conn->prepare("INSERT INTO ShopName (ShopName) VALUES (?)");
        $stmt->bind_param("s", $shopname);
        $result = $stmt->execute();

        if (!$result) {
            return false;
        }

        return true;
    }

    public function getSellerByEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM Seller WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $seller = $result->fetch_assoc();
            return $seller;
        }

        return false;
    }

    public function getSellerByID($sellerID)
    {
        $stmt = $this->conn->prepare("SELECT * FROM Seller WHERE SellerID = ?");
        $stmt->bind_param("i", $sellerID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $seller = $result->fetch_assoc();
            return $seller;
        }

        return false;
    }

    public function getSellerByEmailAndPassword($email, $password)
    {
        $stmt = $this->conn->prepare("SELECT * FROM Seller WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $seller = $result->fetch_assoc();
            if (password_verify($password, $seller['Password'])) {
                return $seller;
            }
        }

        return false;
    }

    public function getShopName($sellerID)
    {
        $stmt = $this->conn->prepare("SELECT s.ShopID, s.ShopName FROM ShopName s INNER JOIN Seller_Shop ss ON s.ShopID = ss.ShopID WHERE SellerID = ?");
        $stmt->bind_param("i", $sellerID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $seller = $result->fetch_assoc();
            return $seller;
        }

        return false;
    }

    public function InsertProduct($productname, $description, $price, $quantity, $url)
    {
        $stmt = $this->conn->prepare("INSERT INTO Products(ProductName,Description,Price,Quantity,ProductImg) VALUES (?,?,?,?,?)");
        $stmt->bind_param("ssiis", $productname, $description, $price, $quantity, $url);
        $result = $stmt->execute();

        if (!$result) {
            return false;
        }

        return true;
    }

    public function InsertCategory($categoryname)
    {
        $stmt = $this->conn->prepare("INSERT INTO Categories(CategoryName) VALUES (?)");
        $stmt->bind_param("s", $categoryname);
        $result = $stmt->execute();

        if (!$result) {
            return false;
        }

        return true;
    }

    public function SaveCategory($ShopID, $categoryID)
    {
        $stmt = $this->conn->prepare("INSERT INTO Shop_Category(ShopID, CategoryID) VALUES (?,?)");
        $stmt->bind_param("ss", $ShopID, $categoryID);
        $result = $stmt->execute();

        if (!$result) {
            return false;
        }

        return true;
    }

    public function SaveProduct($categoryID , $productID)
    {
        $stmt = $this->conn->prepare("INSERT INTO Product_Categories(CategoryID, ProductID) VALUES (?,?)");
        $stmt->bind_param("ii", $categoryID, $productID);
        $result = $stmt->execute();

        if (!$result) {
            return false;
        }

        return true;
    }

    public function getCategoryIDLast()
    {
        $stmt = $this->conn->prepare("SELECT CategoryID FROM Categories ORDER BY CategoryID DESC LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $shopID= $result->fetch_assoc();
            return $shopID;
        }

        return false;
    }

    public function getProductIDLast()
    {
        $stmt = $this->conn->prepare("SELECT ProductID FROM Products ORDER BY ProductID DESC LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $productID= $result->fetch_assoc();
            return $productID;
        }

        return false;
    }

    public function getCategoryNameByShopID($ShopID)
    {
        $stmt = $this->conn->prepare("SELECT c.CategoryID, c.CategoryName FROM Categories c INNER JOIN Shop_Category sc ON sc.CategoryID = c.CategoryID WHERE sc.ShopID = ?");
        $stmt->bind_param("i", $ShopID);
        $stmt->execute();
        $result = $stmt->get_result();
        echo "ac";

        if ($result->num_rows > 0) {
            $categoryName = array();
            while ($row = $result->fetch_assoc()) {
                $categoryName[] = $row;
            }
            return $categoryName;
        }

        return false;
    }

    public function getOrderByProcessing($ShopID)
    {
        $stmt = $this->conn->prepare("SELECT sc.ShopID, up.UP_ID, up.UserID, u.FullName , up.ProductID, p.ProductName, up.Quantity, up.CreateDate, p.Price * up.Quantity as 'Total', up.Status FROM User_Products up
        INNER JOIN Products p ON p.ProductID = up.ProductID
        INNER JOIN Product_Categories pc ON pc.ProductID = up.ProductID
        INNER JOIN Categories c ON c.CategoryID = pc.CategoryID
        INNER JOIN Shop_Category sc ON sc.CategoryID = c.CategoryID  
        INNER JOIN Users u ON u.UserID = up.UserID
        WHERE up.Status = 'Processing' AND sc.ShopID = ?
         ORDER BY p.Price * up.Quantity");
        $stmt->bind_param("i", $ShopID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $orders = array();
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
            return $orders;
        }

        return false;
    }
    
    public function ChangeConfirmed($orderid)
    {
        $stmt = $this->conn->prepare("UPDATE User_Products SET Status = 'Confirmed' WHERE UP_ID = ?");
        $stmt->bind_param("i", $orderid);
        $stmt->execute();
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    public function getOrderByConfirmed($ShopID)
    {
        $stmt = $this->conn->prepare("SELECT sc.ShopID, up.UP_ID, up.UserID, u.FullName , up.ProductID, p.ProductName, up.Quantity, up.CreateDate, p.Price * up.Quantity as 'Total', up.Status FROM User_Products up
        INNER JOIN Products p ON p.ProductID = up.ProductID
        INNER JOIN Product_Categories pc ON pc.ProductID = up.ProductID
        INNER JOIN Categories c ON c.CategoryID = pc.CategoryID
        INNER JOIN Shop_Category sc ON sc.CategoryID = c.CategoryID  
        INNER JOIN Users u ON u.UserID = up.UserID
        WHERE up.Status = 'Confirmed' AND sc.ShopID = ?
         ORDER BY p.Price * up.Quantity");
        $stmt->bind_param("i", $ShopID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $orders = array();
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
            return $orders;
        }

        return false;
    }
    
    public function ChangeShipped($orderid)
    {
        $stmt = $this->conn->prepare("UPDATE User_Products SET Status = 'Shipped' WHERE UP_ID = ?");
        $stmt->bind_param("i", $orderid);
        $stmt->execute();
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    public function getOrderByShipped($ShopID)
    {
        $stmt = $this->conn->prepare("SELECT sc.ShopID, up.UP_ID, up.UserID, u.FullName , up.ProductID, p.ProductName, up.Quantity, up.CreateDate, p.Price * up.Quantity as 'Total', up.Status FROM User_Products up
        INNER JOIN Products p ON p.ProductID = up.ProductID
        INNER JOIN Product_Categories pc ON pc.ProductID = up.ProductID
        INNER JOIN Categories c ON c.CategoryID = pc.CategoryID
        INNER JOIN Shop_Category sc ON sc.CategoryID = c.CategoryID  
        INNER JOIN Users u ON u.UserID = up.UserID
        WHERE up.Status = 'Shipped' AND sc.ShopID = ?
         ORDER BY p.Price * up.Quantity");
        $stmt->bind_param("i", $ShopID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $orders = array();
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
            return $orders;
        }

        return false;
    }
    
    public function ChangeDelivered($orderid)
    {
        $stmt = $this->conn->prepare("UPDATE User_Products SET Status = 'Delivered' WHERE UP_ID = ?");
        $stmt->bind_param("i", $orderid);
        $stmt->execute();
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    public function getOrderByDelivered($ShopID)
    {
        $stmt = $this->conn->prepare("SELECT sc.ShopID, up.UP_ID, up.UserID, u.FullName , up.ProductID, p.ProductName, up.Quantity, up.CreateDate, p.Price * up.Quantity as 'Total', up.Status FROM User_Products up
        INNER JOIN Products p ON p.ProductID = up.ProductID
        INNER JOIN Product_Categories pc ON pc.ProductID = up.ProductID
        INNER JOIN Categories c ON c.CategoryID = pc.CategoryID
        INNER JOIN Shop_Category sc ON sc.CategoryID = c.CategoryID  
        INNER JOIN Users u ON u.UserID = up.UserID
        WHERE up.Status = 'Delivered' AND sc.ShopID = ?
         ORDER BY p.Price * up.Quantity");
        $stmt->bind_param("i", $ShopID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $orders = array();
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
            return $orders;
        }

        return false;
    }

    public function getOrderByCancelled($ShopID)
    {
        $stmt = $this->conn->prepare("SELECT sc.ShopID, up.UP_ID, up.UserID, u.FullName , up.ProductID, p.ProductName, up.Quantity, up.CreateDate, sum(p.Price * up.Quantity) as 'Total', up.Status FROM User_Products up
        INNER JOIN Products p ON p.ProductID = up.ProductID
        INNER JOIN Product_Categories pc ON pc.ProductID = up.ProductID
        INNER JOIN Categories c ON c.CategoryID = pc.CategoryID
        INNER JOIN Shop_Category sc ON sc.CategoryID = c.CategoryID  
        INNER JOIN Users u ON u.UserID = up.UserID
        WHERE up.Status = 'Cancelled' AND sc.ShopID = ?
        GROUP BY p.Price * up.Quantity ORDER BY sum(p.Price * up.Quantity);");
        $stmt->bind_param("i", $ShopID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $orders = array();
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
            return $orders;
        }

        return false;
    }
    
    public function ChangeCancelled($orderid)
    {
        $stmt = $this->conn->prepare("UPDATE User_Products SET Status = 'Cancelled' WHERE UP_ID = ?");
        $stmt->bind_param("i", $orderid);
        $stmt->execute();
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    public function getOrderByReturned($ShopID)
    {
        $stmt = $this->conn->prepare("SELECT sc.ShopID, up.UP_ID, up.UserID, u.FullName , up.ProductID, p.ProductName, up.Quantity, up.CreateDate, sum(p.Price * up.Quantity) as 'Total', up.Status FROM User_Products up
        INNER JOIN Products p ON p.ProductID = up.ProductID
        INNER JOIN Product_Categories pc ON pc.ProductID = up.ProductID
        INNER JOIN Categories c ON c.CategoryID = pc.CategoryID
        INNER JOIN Shop_Category sc ON sc.CategoryID = c.CategoryID  
        INNER JOIN Users u ON u.UserID = up.UserID
        WHERE up.Status = 'Returned' AND sc.ShopID = ?
        GROUP BY p.Price * up.Quantity ORDER BY sum(p.Price * up.Quantity);");
        $stmt->bind_param("i", $ShopID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $orders = array();
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
            return $orders;
        }

        return false;
    }
    
    public function ChangeReturned($orderid)
    {
        $stmt = $this->conn->prepare("UPDATE User_Products SET Status = 'Returned' WHERE UP_ID = ?");
        $stmt->bind_param("i", $orderid);
        $stmt->execute();
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    public function getQuantityFromUP($shopID)
    {
        $stmt = $this->conn->prepare("SELECT sc.ShopID, sum(up.Quantity) as 'SoldQuantity', sum(up.Quantity * p.Price) as 'Total' ,up.Status FROM User_Products up
        INNER JOIN Products p ON p.ProductID = up.ProductID
                INNER JOIN Product_Categories pc ON pc.ProductID = up.ProductID
                INNER JOIN Categories c ON c.CategoryID = pc.CategoryID
                INNER JOIN Shop_Category sc ON sc.CategoryID = c.CategoryID  
                INNER JOIN Users u ON u.UserID = up.UserID
                WHERE up.Status = 'Delivered' AND sc.ShopID = ?
                GROUP BY SoldQuantity");
        $stmt->bind_param("i", $shopID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $revenue = array();
            while ($row = $result->fetch_assoc()) {
                $revenue[] = $row;
            }
            return $revenue;
        }

        return false;
    }

    public function getAddDay($curdate)
    {
        for($i=1; $i<=7; $i++)
        {
            $stmt = $this->conn->prepare("SELECT DATE_ADD(?), INTERVAL -1 DAY)");
            $stmt->bind_param("s", $curdate);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $days = array();
                while ($row = $result->fetch_assoc()) {
                    $days[] = $row;
                }
                $curdate = $curdate - 1;
                return $days;
            }

            return false;
        }
    }

    public function getCurDate()
    {
        $stmt = $this->conn->prepare("SELECT curdate()");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $date = $result->fetch_assoc();
            return $date;
        }

        return false;
    }

    public function getRevenueDay($shopID,$date)
    {
        $stmt = $this->conn->prepare("SELECT sc.ShopID, sum(up.Quantity) as 'SoldQuantity', sum(up.Quantity * p.Price) as 'Total' ,up.Status, up.CreateDate FROM User_Products up
        INNER JOIN Products p ON p.ProductID = up.ProductID
                INNER JOIN Product_Categories pc ON pc.ProductID = up.ProductID
                INNER JOIN Categories c ON c.CategoryID = pc.CategoryID
                INNER JOIN Shop_Category sc ON sc.CategoryID = c.CategoryID  
                INNER JOIN Users u ON u.UserID = up.UserID
                WHERE up.Status = 'Delivered' AND sc.ShopID = ? AND up.CreateDate = ?
                GROUP BY SoldQuantity");
        $stmt->bind_param("is", $shopID, $date);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $revenue = array();
            while ($row = $result->fetch_assoc()) {
                $revenue[] = $row;
            }
            return $revenue;
        }

        return 0;
    }
}
?>
