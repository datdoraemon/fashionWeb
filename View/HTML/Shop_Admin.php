<!DOCTYPE html>
<?php session_start(); 
  require_once '../../Controller/CreateAdminController.php';
  require_once '../../Controller/OrderSellerController.php';
  require_once '../../Controller/RevenueController.php';
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

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
                        $('.revenueday').hide();
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
                        $('.revenueday').hide();
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
                        $('.revenueday').hide();
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
                        $('.revenueday').hide();
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
                        $('.revenueday').hide();
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
                        $('.revenueday').hide();
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
                        $('.revenueday').hide();
                    }
                }

                function RevenueDay()
                {
                    var e = document.getElementById("revenueday").value;
                    if(e == "revenueday")
                    {
                        $(".Add_product").hide();
                        $('.show_processing').hide();
                        $('.show_confirmed').hide();
                        $('.show_shipped').hide();
                        $('.show_delivered').hide();
                        $('.show_cancelled').hide();
                        $('.show_returned').hide();
                        $('.revenueday').show();
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
                  <a class="a">
                        <button id="revenueday" onclick="RevenueDay()" value="revenueday"  class="button">Doanh thu ngày</button>
                     </a>
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
                                               <input type="hidden" name="orderidprocess" value="'.$orderid.'">
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
                                               <input type="hidden" name="orderidconfirm" value="'.$orderid.'">
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
                                                <input type="hidden" name="orderidship" value="'.$orderid.'">
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
                                               <input type="hidden" name="orderiddelivery" value="'.$orderid.'">
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
                <div class ="revenueday">
                    Đã bán :
                    <?php 
                        $revenue = new RevenueController();
                        $revenueday = $revenue->RevenueDay($_SESSION['shopID']);
                        foreach($revenueday as $day)
                        {
                            echo $day['SoldQuantity'];
                        }
                        $revenueweek = $revenue->RevenueWeek();
                        foreach($revenueweek as $day)
                        {
                            $_SESSION['day'] = $day;
                        }                
                        $revenueweekofday = $revenue->Minusday($_SESSION['day']);
                        echo $revenueweekofday[5]; 
                        $date0 = $revenueweekofday[0];
                        $date1 = $revenueweekofday[1];
                        $date2 = $revenueweekofday[2];
                        $date3 = $revenueweekofday[3];
                        $date4 = $revenueweekofday[4];
                        $date5 = $revenueweekofday[5];
                        $date6 = $revenueweekofday[6];
                        echo $_SESSION['shopID'];
                        $revenueweek = new RevenueController();
                        $day0 = $revenueweek->getRevenueDay($_SESSION['shopID'],$date0);
                        $day1 = $revenueweek->getRevenueDay($_SESSION['shopID'],$date1);
                        $day2 = $revenueweek->getRevenueDay($_SESSION['shopID'],$date2);
                        $day3 = $revenueweek->getRevenueDay($_SESSION['shopID'],$date3);
                        $day4 = $revenueweek->getRevenueDay($_SESSION['shopID'],$date4);
                        $day5 = $revenueweek->getRevenueDay($_SESSION['shopID'],$date5);
                        $day6 = $revenueweek->getRevenueDay($_SESSION['shopID'],$date6);
                        //echo $revenueweekofday[5];
                        //echo $_SESSION['5'];
                    ?>
                    <div class="container">
                        <canvas id="myChart"></canvas>
                    </div>
  

                </div>
                <script>
                    let myChart = document.getElementById('myChart').getContext('2d');
                    // Global Options
                    Chart.defaults.global.defaultFontFamily = 'Lato';
                    Chart.defaults.global.defaultFontSize = 10;
                    Chart.defaults.global.defaultFontColor = '#777';

                    let massPopChart = new Chart(myChart, {
                    type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
                    data:{
                        labels: ['<?php echo $revenueweekofday[0]; ?>','<?php echo $revenueweekofday[1]; ?>','<?php echo $revenueweekofday[2]; ?>',
                    '<?php echo $revenueweekofday[3]; ?>','<?php echo $revenueweekofday[4]; ?>','<?php echo $revenueweekofday[5]; ?>',
                    '<?php echo $revenueweekofday[6]; ?>'],
                        datasets:[{  
                        data:[<?php if($day0 != null)
                                    {
                                        foreach($day0 as $day)
                                        {
                                            echo $day['Total'];
                                        }
                                    }
                                    else
                                    {
                                        echo 0;
                                    }
                                  ?>,
                                  <?php if($day1 != null)
                                    {
                                        foreach($day1 as $day)
                                        {
                                            echo $day['Total'];
                                        }
                                    }
                                    else
                                    {
                                        echo 0;
                                    }
                                  ?>,
                                  <?php if($day2 != null)
                                    {
                                        foreach($day2 as $day)
                                        {
                                            echo $day['Total'];
                                        }
                                    }
                                    else
                                    {
                                        echo 0;
                                    }
                                  ?>,
                                  <?php if($day3 != null)
                                    {
                                        foreach($day3 as $day)
                                        {
                                            echo $day['Total'];
                                        }
                                    }
                                    else
                                    {
                                        echo 0;
                                    }
                                  ?>,
                                  <?php if($day4 != null)
                                    {
                                        foreach($day4 as $day)
                                        {
                                            echo $day['Total'];
                                        }
                                    }
                                    else
                                    {
                                        echo 0;
                                    }
                                  ?>,
                                  <?php if($day5 != null)
                                    {
                                        foreach($day5 as $day)
                                        {
                                            echo $day['Total'];
                                        }
                                    }
                                    else
                                    {
                                        echo 0;
                                    }
                                  ?>,
                                  <?php if($day6 != null)
                                    {
                                        foreach($day6 as $day)
                                        {
                                            echo $day['Total'];
                                        }
                                    }
                                    else
                                    {
                                        echo 0;
                                    }
                                  ?>,
                        ],
                        //backgroundColor:'green',
                        backgroundColor:[
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)',
                            'rgba(255, 99, 132, 0.6)'
                        ],
                        borderWidth:1,
                        borderColor:'#777',
                        hoverBorderWidth:1,
                        hoverBorderColor:'#000'
                        }]
                    },
                    options:{
                        title:{
                        display:true,
                        text:'Revenue on day',
                        fontSize:25
                        },
                        legend:{
                        display:true,
                        position:'right',
                        labels:{
                            fontColor:'#000'
                        }
                        },
                        layout:{
                        padding:{
                            left:50,
                            right:0,
                            bottom:0,
                            top:0
                        }
                        },
                        tooltips:{
                        enabled:true
                        }
                    }
                    });
                </script>

            </div>
        </div>
    </div>
</body>
</html>