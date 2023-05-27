-- Xóa database
-- DROP DATABASE fashionShop;

-- Tạo database
CREATE DATABASE fashionShop;

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
  Status ENUM('Vip', 'Normal', 'Attention', 'Locked') DEFAULT 'Normal'
);

-- Tạo bảng Products
CREATE TABLE Products (
  ProductID INT PRIMARY KEY AUTO_INCREMENT,
  ProductName VARCHAR(255),
  Description VARCHAR(255),
  Price DECIMAL(10,2),
  Quantity INT,
  SoldQuantity INT
);

-- Tạo bảng Categories
CREATE TABLE Categories (
  CategoryID INT PRIMARY KEY AUTO_INCREMENT,
  CategoryName VARCHAR(255)
);

-- Tạo bảng User_Products
CREATE TABLE User_Products (
  UserID INT,
  ProductID INT,
  Quantity INT,
  CreateDate DATE,
  Status ENUM('Pending', 'Processing', 'Confirmed', 'Shipped', 'Delivered', 'Cancelled', 'Returned') DEFAULT 'Pending',
  PRIMARY KEY (UserID, ProductID),
  FOREIGN KEY (UserID) REFERENCES Users(UserID),
  FOREIGN KEY (ProductID) REFERENCES Products(ProductID)
);

-- Tạo bảng Product_Categories
CREATE TABLE Product_Categories (
  CategoryID INT,
  ProductID INT,
  PRIMARY KEY (CategoryID, ProductID),
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

CREATE USER 'guest'@'localhost' IDENTIFIED BY '123456';

GRANT SELECT, INSERT, UPDATE, DELETE ON fashionShop.Users TO 'guest'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON fashionShop.User_Products TO 'guest'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON fashionShop.Products TO 'guest'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON fashionShop.Categories TO 'guest'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON fashionShop.Product_Reviews TO 'guest'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON fashionShop.Product_Categories TO 'guest'@'localhost';