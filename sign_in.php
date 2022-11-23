<?php include 'check_login.php'; ?>
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
    <a href="forgot_password.php">Quên mật khẩu</a>
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