<div id="top">
    <ol>
        <li>
            <a href="index.php">Trang chủ</a>
        </li>
        <?php 
        session_start();
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