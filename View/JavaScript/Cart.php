<script>
    function addToCart() {
        // Gửi yêu cầu AJAX để thêm sản phẩm vào giỏ hàng
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_to_cart.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var response = xhr.responseText;
                // Hiển thị thông báo thành công
                alert(response);
            }
        };
        xhr.send('product_id=' + encodeURIComponent(<?php echo $productID; ?>) + '&quantity=' + encodeURIComponent(<?php echo $quantity; ?>));
    }
</script>
