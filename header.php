<div id="top">
    <ol>
        <li>
            <a href="index.php">Trang chủ</a>
        </li>
        <?php 
        session_start();
        if (isset($_COOKIE['remember_login'])){
            $token = $_COOKIE['remember_login'];
            require 'admin/connect.php';
            $sql = "select * from customers
            where token = '$token'";
            $result = mysqli_fetch_array(mysqli_query($connect,$sql));
            $number_rows = mysqli_num_rows(mysqli_query($connect,$sql));
            if ($number_rows == 1){
            $_SESSION['id'] = $result['id'];
            $_SESSION['name'] = $result['name'];
        }
        }
        if (empty($_SESSION['id'])) {?>

        <li>
            <a href="sign_in.php">Đăng nhập</a>
        </li>
        <li>
            <a href="sign_up.php">Đăng ký</a>
        </li>
        <?php }else{ ?>
            Welcome, <?php echo $_SESSION['name'] ?>
        <li>
            <a href="sign_out.php">Đăng xuất</a>
        </li>
        <li>
            <a href="view_cart.php">Xem giỏ hàng</a>
        </li>
        <?php } ?>
        

    </ol>
</div>