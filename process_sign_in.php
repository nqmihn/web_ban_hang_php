<?php
$email = $_POST['email'];
// $password = md5($_POST['password']);
$password = $_POST['password'];
if ($_POST['remember_login']){
    $remember = true;
}else{
    $remember = false;
}
require 'admin/connect.php';
$sql = "select * from customers
    where email = '$email' and password ='$password'";

$result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) === 0) {
    header('location:sign_in.php?error=Tài khoản hoặc mật khẩu không đúng');
    exit;
}

session_start();
$each = mysqli_fetch_array($result);
$_SESSION['id'] = $each['id'];
$_SESSION['name'] = $each['name'];
if ($remember){
    $token = uniqid('user_',true);
    $id = $each['id'];
    $sql_set_token = "update customers
    set token = '$token'
    where
    id ='$id'";
    mysqli_query($connect,$sql_set_token);
    setcookie('remember_login',$token,time() + 86400*30);
}
header('location:index.php');
