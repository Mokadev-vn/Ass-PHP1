<?php
require_once '../libs/config.php';

$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$showMenu = isset($_POST['showMenu']) ? trim($_POST['showMenu']) : '';
$description = isset($_POST['description']) ? trim($_POST['description']) : '';

if ($name == '') {
    $_SESSION['error'] = "Vui lòng nhập tên danh mục!";
    header("Location: ./add-cate.php");
    die();
}

$conn = connDB();

$insCateSql = "INSERT INTO categories(name, show_menu, description) VALUES ('$name', '$showMenu', '$description')";
$stmt = $conn->prepare($insCateSql);
$result = $stmt->execute();

if ($result) {
    $_SESSION['success'] = "Đã tạo thành công danh mục $name";
    header("Location: ./add-cate.php");
    die();
}

$_SESSION['error'] = "Có lỗi xảy ra vui lòng thực hiện lại!";
header("Location: ./add-cate.php");
