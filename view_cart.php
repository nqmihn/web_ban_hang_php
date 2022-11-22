<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
</head>

<body>
   
    <h1>
        <center>Giỏ hàng của bạn</center>
    </h1>
    <?php
    session_start();
    if (empty($_SESSION['cart'])) {
    } else {
        $sum = 0;
        $cart = $_SESSION['cart'];

    ?>
        <span id="span-cart">
            <table border="1" width="100%">
                <tr>
                    <th>Tên</th>
                    <th>Ảnh</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Xóa đơn hàng</th>
                </tr>

                <?php foreach ($cart as $id => $value) { ?>
                    <tr>
                        <td><?php echo $value['name'] ?></td>
                        <td><img src="admin/products/photos/<?php echo $value['image'] ?>" width="100"></td>
                        <td>
                            <span class="span-price">
                                <?php echo $value['price'] ?>$
                            </span>
                        </td>
                        <td>
                            <button class="btn-update-quantity" data-id="<?php echo $id ?>" data-type="0">
                                -
                            </button>
                            <center>
                                <span class="span-quantity">
                                    <?php echo $value['quantity'] ?>
                                </span>
                            </center>
                            <button class="btn-update-quantity" data-id="<?php echo $id ?>" data-type="1">
                                +
                            </button>

                        </td>
                        <td>
                            <span class="span-sum">
                                <?php
                                $sum += $value['quantity'] * $value['price'];
                                echo $value['quantity'] * $value['price']
                                ?>
                            </span>
                        </td>
                        <td>
                            <button class="btn-remove-cart" data-id="<?php echo $id ?>">
                                Xóa
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <h1>Tổng tiền phải trả:
                <span id="span-total-price">
                    <?php echo $sum ?>
                </span>$
            </h1>
            <?php 
              require 'admin/connect.php';
              $id = $_SESSION['id'];
              $sql = "select * from customers 
              where id ='$id'";
              $result = mysqli_fetch_array(mysqli_query($connect, $sql));
             ?>
            <center>Thông tin giao hàng
                <form action="process_check_out.php" method="post">
                    Tên người nhận
                    <input type="text" name="name_customer" value="<?php echo $result['name'] ?>">
                    <br>
                    Số điện thoại
                    <input type="text" name="phone_customer" value="<?php echo $result['phone'] ?>">
                    <br>
                    Địa chỉ
                    <textarea name="address_customer"><?php echo $result['address'] ?></textarea>
                    <br>
                    <button>Đặt hàng</button>
                </form>
            </center>
        </span>
    <?php } ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.btn-update-quantity').click(function() {
                let btn = $(this);
                let id = btn.data('id');
                let type = parseInt(btn.data('type'));
                $.ajax({
                    type: "GET",
                    url: "update_quantity.php",
                    data: {
                        id,
                        type
                    },
                    success: function() {
                        let tr_parent = btn.parents('tr');
                        let quantity = parseInt(tr_parent.find(".span-quantity").text());
                        let price = parseFloat(tr_parent.find(".span-price").text());
                        quantity = (type === 1) ? quantity + 1 : quantity - 1;
                        if (quantity === 0) {
                            tr_parent.remove();
                        } else {
                            tr_parent.find(".span-quantity").text(quantity);
                            tr_parent.find(".span-sum").text(quantity * price);
                        }

                        getTotalPrice();

                    }
                });

            });
            $('.btn-remove-cart').click(function() {
                let btn = $(this);
                let id = btn.data('id');
                $.ajax({
                    type: "GET",
                    url: "delete_cart.php",
                    data: "id",
                    success: function() {
                        let tr_parent = btn.parents('tr');
                        tr_parent.remove();
                        getTotalPrice();
                    }
                });

            });
        });

        function getTotalPrice() {
            let total = parseFloat(0)
            $('.span-sum').each(function() {
                total += parseFloat($(this).text())

            });
            if (total > 0) {
                $('#span-total-price').text(total);
            } else {
                $('#span-cart').text('');
            }
        }
    </script>



</body>

</html>