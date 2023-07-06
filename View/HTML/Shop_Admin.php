<!DOCTYPE html>
<?php session_start(); 
  require_once '../../Controller/CreateAdminController.php';
  require_once '../../Controller/OrderSellerController.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Admin</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../Style/Admin.css">
    <script>
                function Add_Product()
                {
                    var x = document.getElementById("add_product").value;
                    if(x == "add")
                    {
                        $(".Add_product").show();
                        $('.show_processing').hide();
                        $('.show_confirmed').hide();
                        $('.show_shipped').hide();
                        $('.show_delivered').hide();
                        $('.show_cancelled').hide();
                        $('.show_returned').hide();
                    }
                }
                function Processing()
                {
                    var y = document.getElementById("processing").value;
                    if(y == "processing")
                    {
                        $(".Add_product").hide();
                        $('.show_processing').show();
                        $('.show_confirmed').hide();
                        $('.show_shipped').hide();
                        $('.show_delivered').hide();
                        $('.show_cancelled').hide();
                        $('.show_returned').hide();
                    }
                }
                function Confirmed()
                {
                    var z = document.getElementById("confirmed").value;
                    if(z == "confirmed")
                    {
                        $(".Add_product").hide();
                        $('.show_processing').hide();
                        $('.show_confirmed').show();
                        $('.show_shipped').hide();
                        $('.show_delivered').hide();
                        $('.show_cancelled').hide();
                        $('.show_returned').hide();
                    }
                }
                function Shipped()
                {
                    var a = document.getElementById("shipped").value;
                    if(a == "shipped")
                    {
                        $(".Add_product").hide();
                        $('.show_processing').hide();
                        $('.show_confirmed').hide();
                        $('.show_shipped').show();
                        $('.show_delivered').hide();
                        $('.show_cancelled').hide();
                        $('.show_returned').hide();
                    }
                }
                function Delivered()
                {
                    var b = document.getElementById("delivered").value;
                    if(b == "delivered")
                    {
                        $(".Add_product").hide();
                        $('.show_processing').hide();
                        $('.show_confirmed').hide();
                        $('.show_shipped').hide();
                        $('.show_delivered').show();
                        $('.show_cancelled').hide();
                        $('.show_returned').hide();
                    }
                }
                function Cancelled()
                {
                    var c = document.getElementById("cancelled").value;
                    if(c == "cancelled")
                    {
                        $(".Add_product").hide();
                        $('.show_processing').hide();
                        $('.show_confirmed').hide();
                        $('.show_shipped').hide();
                        $('.show_delivered').hide();
                        $('.show_cancelled').show();
                        $('.show_returned').hide();
                    }
                }
                function Returned()
                {
                    var d = document.getElementById("returned").value;
                    if(d == "returned")
                    {
                        $(".Add_product").hide();
                        $('.show_processing').hide();
                        $('.show_confirmed').hide();
                        $('.show_shipped').hide();
                        $('.show_delivered').hide();
                        $('.show_cancelled').hide();
                        $('.show_returned').show();
                    }
                }
            </script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 col-left1">
            <?php
                    if (isset($_SESSION['SellerID']) && $_SESSION['SellerID'] != 0) {
                        $AdminController = new CreateAdminController();
                        $shopname = $AdminController->getShopName($_SESSION['SellerID']);
                        $_SESSION['shopID'] = $shopname['ShopID'];
                        echo "<p style='color: black;'>".$shopname['ShopName']."</p>";
                    }
                        ?>  
            </div>
            <div class="col-9 col-right1">
              <div class="search">
                  <form action="" method="post">
                     <input class="bar_search" type="text" name="search">
                     <input class="btn btn-primary" type="submit" name="submit" value="Tìm kiếm">
                  </form>
              </div>
              <div class="login">
              <?php
                    if (isset($_SESSION['SellerID']) && $_SESSION['SellerID'] != 0) {
                        $AdminController = new CreateAdminController();
                        $admin = $AdminController->getSellerByEmail($_SESSION['Email']);
                        echo "<p style='color: white; float: left;'>".$admin['FullName']."</p>";
                        // Nếu $_SESSION['user_id'] tồn tại và khác 0
                        echo '
                        <a href="LogIn_Admin.php" style="color: white; text-decoration: none; margin-left: 25px;">Đăng xuất</a>';
                        } else {
                         // Nếu $_SESSION['user_id'] không tồn tại hoặc bằng 0
                         echo '<a href="LogIn_Admin.php" style="color: white; text-decoration: none;">Đăng nhập</a>';
                        }
                        ?>                       
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3 col-left2">
              <h4 style="margin-top: 20px">QUẢN LÝ SẢN PHẨM</h4>
               <ul class="ul">
                  <li class="li">
                      <a class="a">
                        <button id="add_product" onclick="Add_Product()" value="add" class="button">Thêm sản phẩm</button>
                     </a>
                  </li>
                  <li class="li">
                      <a class="a" href="">Hiển thị sản phẩm</a>
                  </li>
               </ul><br><hr>
               <h4>QUẢN LÝ ĐƠN HÀNG</h4>
               <ul class="ul">
                  <li class="li">
                  <a class="a">
                        <button id="processing" onclick="Processing()" value="processing"  class="button">Chờ phê duyệt</button>
                     </a>
                  </li>
                  <li class="li">
                  <a class="a">
                        <button id="confirmed" onclick="Confirmed()" value="confirmed"  class="button">Đã xác nhận</button>
                     </a>
                  </li>
                  <li class="li">
                  <a class="a">
                        <button id="shipped" onclick="Shipped()" value="shipped"  class="button">Đang vận chuyển</button>
                     </a>
                  </li>
                  <li class="li">
                  <a class="a">
                        <button id="delivered" onclick="Delivered()" value="delivered"  class="button">Đã giao</button>
                     </a>
                  </li>
                  <li class="li">
                  <a class="a">
                        <button id="cancelled" onclick="Cancelled()" value="cancelled"  class="button">Đã hủy</button>
                     </a>
                  </li>
                  <li class="li">
                  <a class="a">
                        <button id="returned" onclick="Returned()" value="returned"  class="button">Đơn hàng bị trả lại</button>
                     </a>
                  </li>
               </ul><br><hr>
               <h4>THỐNG KÊ DOANH THU</h4>
               <ul class="ul">
                  <li class="li">
                      <a class="a" href="">Doanh thu tuần</a>
                  </li>
                  <li class="li">
                      <a class="a" href="">Doanh thu tháng</a>
                  </li>
               </ul>
            </div>
            <div class="col-9 col-right2">
                <div class="Add_product">
                    <h1 style="margin-top: 20px;">THÊM SẢN PHẨM</h1><br>
                    <form action="../../Controller/ProductSellerController.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="sellerid" value="<?php echo $_SESSION['SellerID']; ?>">
                        <input type="hidden" name="shopID" value="<?php echo $_SESSION['shopID']; ?>">
                        <label>Tên sản phẩm :</label>
                        <input type="text" name="productname"><br>
                        <label>Danh mục :</label>
                        <input type="text" name="category"><br>
                        <label>Mô tả : </label>
                        <input type="text" name="description"><br>
                        <label>Giá : </label>
                        <input type="number" name="price"><br>
                        <label>Số lượng</label>
                        <input type="number" name="quantity"><br>
                        <label>Ảnh minh họa : </label>
                        <input type="file" name="fileToUpload" id="fileToUpload"><br>
                        <input type="submit" name="submit" value= "Submit" class="btn btn-primary"><br>
                    </form>    
                </div>
                <div class="show_processing">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Create Date</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <?php $Order = new OrderSellerController();
                              $orders = $Order->OrderProcessing($_SESSION['shopID']);
                              if($orders != NULL)
                              {
                                foreach($orders as $order)
                                { $orderid = $order['UP_ID'];
                                   echo '<tbody>
                                          <tr>
                                          <td>'.$order['UP_ID'].'</td>
                                          <td>'.$order['FullName'].'</td>
                                          <td>'.$order['ProductName'].'</td>
                                          <td>'.$order['Quantity'].'</td>
                                          <td>'.$order['CreateDate'].'</td>
                                          <td>'.$order['Total'].'</td>
                                          <td>
                                            <form action="../../Controller/OrderSellerController.php" method ="post">
                                               <input type="hidden" name="orderid" value="'.$orderid.'">
                                               <input type="submit" name="submit" class="btn btn-primary" value="Confirmed">
                                            </form>
                                          </td>
                                          </tr>
                                      </tbody>';
                                }
                              }
                              else
                              {
                                 echo 'Null';
                              }
                        ?>
                    </table>
                </div>
                <div class="show_confirmed">
                <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Create Date</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <?php $Order = new OrderSellerController();
                              $orders = $Order->OrderConfirmed($_SESSION['shopID']);
                              if($orders != NULL)
                              {
                                foreach($orders as $order)
                                { $orderid = $order['UP_ID'];
                                   echo '<tbody>
                                          <tr>
                                          <td>'.$order['UP_ID'].'</td>
                                          <td>'.$order['FullName'].'</td>
                                          <td>'.$order['ProductName'].'</td>
                                          <td>'.$order['Quantity'].'</td>
                                          <td>'.$order['CreateDate'].'</td>
                                          <td>'.$order['Total'].'</td>
                                          <td>
                                            <form action="../../Controller/OrderSellerController.php" method ="post">
                                               <input type="hidden" name="orderid" value="'.$orderid.'">
                                               <input type="submit" name="submit" class="btn btn-primary" value="Shipped">
                                            </form>
                                          </td>
                                          </tr>
                                      </tbody>';
                                }
                              }
                              else
                              {
                                echo 'Null';
                              }
                        ?>
                    </table>
                </div>
                <div class="show_shipped">
                <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Create Date</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <?php $Order = new OrderSellerController();
                              $orders = $Order->OrderShipped($_SESSION['shopID']);
                              if($orders != NULL)
                              {
                                foreach($orders as $order)
                                {
                                    $orderid = $order['UP_ID'];
                                    echo '<tbody>
                                           <tr>
                                           <td>'.$order['UP_ID'].'</td>
                                           <td>'.$order['FullName'].'</td>
                                           <td>'.$order['ProductName'].'</td>
                                           <td>'.$order['Quantity'].'</td>
                                           <td>'.$order['CreateDate'].'</td>
                                           <td>'.$order['Total'].'</td>
                                           <td>
                                             <form action="../../Controller/OrderSellerController.php" method ="post">
                                                <input type="hidden" name="orderid" value="'.$orderid.'">
                                                <input type="submit" name="submit" class="btn btn-primary" value="Delivered">
                                             </form>
                                           </td>
                                           </tr>
                                       </tbody>';
                                }
                              }
                                else
                                {
                                    echo 'Null';
                                }
                        ?>
                    </table>
                </div>
                <div class="show_delivered">
                <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Create Date</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <?php $Order = new OrderSellerController();
                              $orders = $Order->OrderDelivered($_SESSION['shopID']);
                              if($orders != NULL)
                              {
                                foreach($orders as $order)
                                { $orderid = $order['UP_ID'];
                                   echo '<tbody>
                                          <tr>
                                          <td>'.$order['UP_ID'].'</td>
                                          <td>'.$order['FullName'].'</td>
                                          <td>'.$order['ProductName'].'</td>
                                          <td>'.$order['Quantity'].'</td>
                                          <td>'.$order['CreateDate'].'</td>
                                          <td>'.$order['Total'].'</td>
                                          <td>
                                            <form action="../../Controller/OrderSellerController.php" method ="post">
                                               <input type="hidden" name="orderid" value="'.$orderid.'">
                                               <input type="submit" name="submit" class="btn btn-primary" value="Cancelled">
                                               <input type="submit" name="submit" class="btn btn-primary" value="Returned">
                                            </form>
                                          </td>
                                          </tr>
                                      </tbody>';
                                }
                              }
                              else
                              {
                                 echo 'Null';
                              }
                        ?>
                    </table>
                </div>
                <div class="show_cancelled">
                <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Create Date</th>
                            <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <?php $Order = new OrderSellerController();
                              $orders = $Order->OrderCancelled($_SESSION['shopID']);
                              if($orders != NULL)
                              {
                                foreach($orders as $order)
                                { $orderid = $order['UP_ID'];
                                   echo '<tbody>
                                          <tr>
                                          <td>'.$order['UP_ID'].'</td>
                                          <td>'.$order['FullName'].'</td>
                                          <td>'.$order['ProductName'].'</td>
                                          <td>'.$order['Quantity'].'</td>
                                          <td>'.$order['CreateDate'].'</td>
                                          <td>'.$order['Total'].'</td>
                                          </tr>
                                      </tbody>';
                                }
                              }
                              else
                              {
                                 echo 'Null';
                              }
                        ?>
                    </table>
                </div>
                <div class="show_returned">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Create Date</th>
                            <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <?php $Order = new OrderSellerController();
                              $orders = $Order->Orderreturned($_SESSION['shopID']);
                              if($orders != NULL)
                              {
                                foreach($orders as $order)
                                { $orderid = $order['UP_ID'];
                                   echo '<tbody>
                                          <tr>
                                          <td>'.$order['UP_ID'].'</td>
                                          <td>'.$order['FullName'].'</td>
                                          <td>'.$order['ProductName'].'</td>
                                          <td>'.$order['Quantity'].'</td>
                                          <td>'.$order['CreateDate'].'</td>
                                          <td>'.$order['Total'].'</td>
                                          </tr>
                                      </tbody>';
                                }
                              }
                              else
                              {
                                 echo 'Null';
                              }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>