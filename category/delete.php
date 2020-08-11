<?php
require_once '../libs/config.php';
role();

$id = isset($_GET['id']) ? trim($_GET['id']) : '';

if ($id == '') {
    header('Location: ' . BASE_URL);
    die();
}

$table = "categories";
$where = "id = '$id'";

$result = remove($table, $where);

if($result){
    $_SESSION['success'] = "Remove Category By ID: $id Successfully!";
    header('Location: ' . BASE_URL.'category');
}else{
    $_SESSION['error'] = "Remove Category By ID: $id Fail!";
    header('Location: ' . BASE_URL.'category');
}