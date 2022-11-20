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
    if (isset($_SESSION['id'])){
        header('location:index.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>

<body>
    <?php 
        if (isset($_GET['error'])) { ?>
            <span style="color: red;"><?php echo $_GET['error'] ?></span>
    <?php } ?>
    <form action="process_sign_in.php" method="post">
        <span id="msg-login"></span>
        <br>
        Email
        <input type="text" name="email" id="email" >
        <br>
        Mật khẩu
        <input type="password" name="password" id="password">
        <br>
        Ghi nhớ
        <input type="checkbox" name="remember_login" >
        <br>
        <button onclick="return check()">Đăng nhập</button>
    </form>
    <script type="text/javascript">
        function check() {
            if (document.getElementById('email').value === '' || document.getElementById('password').value === '') {
                document.getElementById('msg-login').style.color = 'red';
                document.getElementById('msg-login').innerText = 'Tài khoản hoặc mật khẩu không được để trống'
                return false;
            } else {
                document.getElementById('msg-login').innerText = ''
                return true;
            }
        }
    </script>
</body>

</html>