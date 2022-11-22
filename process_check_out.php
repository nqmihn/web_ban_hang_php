<?php
session_start();

$id_customer = $_SESSION['id'];
$name_customer = $_POST['name_customer'];
$phone_customer = $_POST['phone_customer'];
$address_customer = $_POST['address_customer'];
$status_cart = 1;
$total_price = 0;
$cart = $_SESSION['cart'];
foreach ($cart as $value) {
    $total_price+= $value['quantity'] * $value['price'];
}

require 'admin/connect.php';
$sql_orders = "INSERT INTO orders(id_customer, name_customer, phone_customer, address_customer, status_cart, total_price) 
VALUES ('$id_customer',' $name_customer', '$phone_customer', '$address_customer', '$status_cart', '$total_price')";
mysqli_query($connect,$sql_orders);

$sql_max_id = "select max(id) from orders";
$result = mysqli_query($connect,$sql_max_id);
$id_order = mysqli_fetch_array($result)['max(id)'];

foreach ($cart as $id_product => $value) {
    $quantity = $value['quantity'];
    $price = $value['price'];
    $sql_order_product = "insert into order_product
    values('$id_order','$id_product','$price','$quantity')";
    mysqli_query($connect,$sql_order_product);
}

unset($_SESSION['cart']);
header('location:view_cart.php');
mysqli_close($connect);