<?php
require_once '../libs/config.php';
role();

$id = isset($_GET['id']) ? trim($_GET['id']) : '';

if ($id == '') {
    header('Location: ' . BASE_URL);
    die();
}

$table = "products";
$where = "id = '$id'";

$result = remove($table, $where);

$table = "product_galleries";
$where = "product_id = '$id'";

remove($table, $where);

if($result){
    $_SESSION['success'] = "Remove Category By ID: $id Successfully!";
    header('Location: ' . BASE_URL.'product');
}else{
    $_SESSION['error'] = "Remove Category By ID: $id Fail!";
    header('Location: ' . BASE_URL.'product');
}