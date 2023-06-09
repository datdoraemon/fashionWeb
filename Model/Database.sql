-- Xóa database
DROP DATABASE IF EXISTS fashionShop;

-- Tạo database
CREATE DATABASE IF NOT EXISTS fashionShop;

-- Sử dụng database
USE fashionShop;

-- Tạo bảng Users
CREATE TABLE Users (
  UserID INT PRIMARY KEY AUTO_INCREMENT,
  Email VARCHAR(255),
  Password VARCHAR(255),
  FullName VARCHAR(255),
  Birthday DATE,
  Phone VARCHAR(20),
  Address VARCHAR(255),
  ImgUser VARCHAR(255),
  Status ENUM('Vip', 'Normal', 'Attention', 'Locked') DEFAULT 'Normal'
);

-- Tạo bảng Products
CREATE TABLE Products (
  ProductID INT PRIMARY KEY AUTO_INCREMENT,
  ProductName VARCHAR(255),
  Description VARCHAR(255),
  Price DECIMAL(10,2),
  Quantity INT,
  SoldQuantity INT,
  ProductImg VARCHAR(255)
);

-- Tạo bảng Categories
CREATE TABLE Categories (
  CategoryID INT PRIMARY KEY AUTO_INCREMENT,
  CategoryName VARCHAR(255) 
);

-- Tạo bảng User_Products
CREATE TABLE User_Products (
  UP_ID INT PRIMARY KEY AUTO_INCREMENT,
  UserID INT,
  ProductID INT,
  Quantity INT,
  CreateDate DATE,
  Status ENUM('Pending', 'Processing', 'Confirmed', 'Shipped', 'Delivered', 'Cancelled', 'Returned') DEFAULT 'Pending',
  FOREIGN KEY (UserID) REFERENCES Users(UserID),
  FOREIGN KEY (ProductID) REFERENCES Products(ProductID)
);

-- Tạo bảng Product_Categories
CREATE TABLE Product_Categories (
  PC_ID INT PRIMARY KEY AUTO_INCREMENT,
  CategoryID INT,
  ProductID INT,
  FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID),
  FOREIGN KEY (ProductID) REFERENCES Products(ProductID)
);

CREATE TABLE Product_Reviews (
  ReviewID INT PRIMARY KEY AUTO_INCREMENT,
  UserID INT,
  ProductID INT,
  Rating INT,
  Comment VARCHAR(255),
  FOREIGN KEY (UserID) REFERENCES Users(UserID),
  FOREIGN KEY (ProductID) REFERENCES Products(ProductID)
);

-- SELECT user, host FROM mysql.user
DROP USER 'guest'@'localhost';
CREATE USER IF NOT EXISTS 'guest'@'localhost' IDENTIFIED BY '123456';

GRANT SELECT, INSERT, UPDATE, DELETE ON fashionShop.Users TO 'guest'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON fashionShop.User_Products TO 'guest'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON fashionShop.Products TO 'guest'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON fashionShop.Categories TO 'guest'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON fashionShop.Product_Reviews TO 'guest'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON fashionShop.Product_Categories TO 'guest'@'localhost';

INSERT INTO Products (ProductName, Description, Price, Quantity, SoldQuantity, ProductImg)
VALUES 
    ('Áo khoác nam', 'Áo khoác nam màu đen', 59.99, 10, 2, 'aokhoacnam.jpg'),
    ('Quần shorts nam', 'Quần shorts nam màu xanh', 24.99, 30, 8, 'quanshortsnam.jpg'),
    ('Đầm maxi nữ', 'Đầm maxi nữ màu hồng', 39.99, 15, 5, 'dammaxinu.jpg'),
    ('Giày cao gót', 'Giày cao gót màu đỏ', 49.99, 20, 3, 'giaycaogot.jpg'),
    ('Túi xách nữ', 'Túi xách nữ màu đen', 34.99, 25, 7, 'tuixachnu.jpg');
INSERT INTO User_Products (UserID, ProductID, Quantity, CreateDate, Status) 
	VALUES (1, 1, 3, CURRENT_TIMESTAMP, 'Processing'),
    (1, 1, 3, CURRENT_TIMESTAMP, 'Confirmed'),
    (1, 2, 3, CURRENT_TIMESTAMP, 'Shipped'),
    (1, 3, 3, CURRENT_TIMESTAMP, 'Delivered'),
    (1, 4, 3, CURRENT_TIMESTAMP, 'Cancelled'),
    (1, 5, 3, CURRENT_TIMESTAMP, 'Returned');
INSERT INTO product_categories (CategoryID, ProductID)
	VALUES (1, 1),
    (2, 2),
    (3, 3);