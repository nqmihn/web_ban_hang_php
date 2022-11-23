<?php
$name = $_POST['name'];
$email = $_POST['email'];
// $password = md5($_POST['password']);
$password = $_POST['password'];
$phone = $_POST['phone'];
$address = $_POST['address'];

require 'admin/connect.php';
$sql = "select * from customers
    where email = '$email'";
$result = mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    header('location:sign_up.php?error=Email đã được sử dụng');
    exit;
}

$sql = "INSERT INTO customers(name, email, password, phone, address) 
        VALUES ('$name', '$email', '$password','$phone', '$address')";
mysqli_query($connect, $sql);
$sql = "select id from customers
where email='$email'";
$result = mysqli_query($connect, $sql);
$id = mysqli_fetch_array($result)['id'];
session_start();
$_SESSION['name'] = $name;
$_SESSION['id'] = $id;
header('location:index.php');
