<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Fashion Web</title>
    <link rel="stylesheet" href="View/CSS/Homepage.css">
    <script src="View/JS/Homepage.js"></script>
</head>

<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="index.php">Fashion Web</a>
            </div>
            <div class="search-box">
                <form action="#" method="get">
                    <input type="text" placeholder="Tìm kiếm sản phẩm...">
                    <button type="submit">Tìm kiếm</button>
                </form>
            </div>
            <div class="cart">
                <a href="#">
                    <img src="View/Image/cart.png" alt="Giỏ hàng">
                    <span>0 sản phẩm</span>
                </a>
            </div>
        </div>
    </header>
    <nav>
        <div class="container">
            <ul>
                <li><a href="#">Trang chủ</a></li>
                <?php foreach ($categories as $category) : ?>
                    <li><a href="#"><?= $category['name'] ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Sản phẩm mới nhất</h1>
            </div>
            <?php foreach ($products as $product) : ?>
            <div class="col-md-3 col-sm-6">
                <div class="product-item">
                    <div class="product-img">
                        <a href="#"><img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>"></a>
                        <?php if ($product['sale'] > 0) : ?>
                            <div class="sale"><?= $product['sale'] ?>%</div>
                        <?php endif; ?>
                    </div>
                    <div class="product-info">
                        <h3><a href="#"><?= $product['name'] ?></a></h3>
                        <div class="product-price">
                            <?php if ($product['sale'] > 0) : ?>
                                <span class="old-price"><?= number_format($product['price'], 0, ',', '.') ?> đ</span>
                                <span class="new-price"><?= number_format($product['price'] * (100 - $product['sale']) / 100, 0, ',', '.') ?> đ</span>
                            <?php else : ?>
                                <span><?= number_format($product['price'], 0, ',', '.') ?> đ</span>
                            <?php endif; ?>
                        </div>
                        <div class="product-buy">
                            <a href="#">Mua hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>

</html>

