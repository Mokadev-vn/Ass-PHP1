<?php
require_once '../libs/config.php';
role();

$id = isset($_POST['id']) ? trim($_POST['id']) : '';
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$showMenu = isset($_POST['showMenu']) ? trim($_POST['showMenu']) : '';
$description = isset($_POST['description']) ? trim($_POST['description']) : '';

if($name == ''){
    $_SESSION['error'] = "Tên danh mục không được để trống!";
    header("Location: ". BASE_URL ."category/edit.php?id=$id");
    die();
}

$table = "categories";
$data = [
    'name'        => $name,
    'show_menu'   => $showMenu,
    'description' => $description
];
$where = "id = '$id'";

$result = update($table, $data, $where);

if($result){
    $_SESSION['success'] = "Update Category Successfully !";
    header("Location: ". BASE_URL ."category/edit.php?id=$id");
    die();
}else{
    $_SESSION['error'] = "Đã có lỗi xảy ra vui lòng thử lại!";
    header("Location: ". BASE_URL ."category/edit.php?id=$id");
    die();
}
