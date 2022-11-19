<?php
if(empty($_POST['name']) || empty($_FILES['image']) || empty($_POST['price']) || empty($_POST['description']) || empty($_POST['id_manufacturer'])){
    header('location:form_insert.php?error=Phải điền đầy đủ thông tin');
    exit;
}
require '../connect.php';
$name = $_POST['name'];
$image = $_FILES['image'];
$price = $_POST['price'];
$description = $_POST['description'];
$id_manufacturer = $_POST['id_manufacturer'];

$folder = 'photos/';
$file_extension = explode('.', $image['name'])[1];
$file_name = time() . '.' . $file_extension;
$path_file = $folder . $file_name;

move_uploaded_file($image["tmp_name"], $path_file);

$sql = "INSERT INTO products(name, image, price, description, id_manufacturer) 
VALUES ('$name', '$file_name', '$price', '$description', '$id_manufacturer')";
mysqli_query($connect,$sql);
mysqli_close($connect);

header('location:form_insert.php?success=Thêm thành công');