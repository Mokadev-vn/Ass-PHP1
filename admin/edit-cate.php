<?php
require_once '../libs/config.php';
$id = isset($_POST['id']) ? trim($_POST['id']) : '';
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$showMenu = isset($_POST['showMenu']) ? trim($_POST['showMenu']) : '';
$description = isset($_POST['description']) ? trim($_POST['description']) : '';


if($name == ''){
    $_SESSION['error'] = "Vui lòng nhập tên danh mục!";
    header("Location: ./control-cate.php?id=$id");
    die();
}

$conn = connDB();

$updateCateSql = "UPDATE categories SET name = '$name', show_menu = '$showMenu', description = '$description' WHERE id = '$id'";
$stmt = $conn->prepare($updateCateSql);

if($stmt->execute()){
    $_SESSION['success'] = "Update Category Successfully !";
    header("Location: ./control-cate.php?id=$id");
    die();
}else{
    $_SESSION['error'] = "Đã có lỗi xảy ra vui lòng thử lại!";
    header("Location: ./control-cate.php?id=$id");
    die();
}
