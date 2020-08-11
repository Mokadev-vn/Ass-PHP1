<?php
require_once '../libs/config.php';
role();

$id = isset($_POST['id']) ? trim($_POST['id']) : '';
$name      = isset($_POST['name']) ? trim($_POST['name'])    : '';
$detail    = isset($_POST['detail']) ? trim($_POST['detail']) : '';
$image     = $_FILES['image'];
$category  = isset($_POST['category']) ? $_POST['category']  : '';
$price     = isset($_POST['price']) ? $_POST['price']        : '';
$oldGallies = isset($_POST['oldGallies']) ? $_POST['oldGallies'] : [];
$galleries = $_FILES['galleries'];
$fileName = isset($_POST['avatarOld']) ? $_POST['avatarOld'] : '';


if ($name == '' || $detail == '' || $price == '') {
    $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin";
    header('Location: ' . BASE_URL . 'product/edit.php?id='.$id);
    die();
}

$type = [
    "image/png",
    "image/jpeg",
    "image/gif",
    "image/jpg",
];

if ($image['size'] > 0) {

    if (in_array($image['type'], $type)) {

        $nameArr = explode(".", $image['name']);

        $fileName = (md5($nameArr[0]) . "_" . time() . "." . $nameArr[1]);

        $result = move_uploaded_file($image['tmp_name'], '../public/products/' . $fileName);
    } else {
        $_SESSION['error'] = "Vui lòng chọn file hoặc file phải đúng định dạng ảnh";
        header('Location: ' . BASE_URL . 'product/edit.php?id='.$id);
        die();
    }
}



for ($i = 0; $i < count($galleries['name']); $i++) {
    $nameImg  = $galleries['name'][$i];
    $tmp_name = $galleries['tmp_name'][$i];
    $typeImg  = $galleries['type'][$i];
    $sizeImg  = $galleries['size'][$i];

    if (in_array($typeImg, $type)) {

        $nameArr = explode(".", $nameImg);

        $fileNameGallery = (md5($nameArr[0]) . "_" . time() . "." . $nameArr[1]);

        $result = move_uploaded_file($tmp_name, '../public/products/' . $fileNameGallery);

        $oldGallies[] = $fileNameGallery;
    }
}

$objImg = json_encode($oldGallies);

$updateProductSql = "UPDATE products SET name = '$name', main_image = '$fileName', price = '$price', detail = '$detail', cate_id = '$category' WHERE id = '$id'";
$updateGalleriesSql = "UPDATE product_galleries SET image = '$objImg' WHERE product_id = '$id'";

$table = "products";
$data  = [
    'name' => $name,
    'main_image' => $fileName,
    'price' => $price,
    'detail' => $detail,
    'cate_id' => $category
];
$where = "id = '$id'";

$result = update($table, $data, $where);

if ($result) {
    $_SESSION['success'] = "Update Product Successfully!";
}else{
    $_SESSION['error'] = "Update Product Fail!";
    header('Location: ' . BASE_URL . 'product/edit.php?id='.$id);
    die();
}

$table = "product_galleries";
$data  = [
    'image' => $objImg,
];
$where = "product_id = '$id'";

update($table, $data, $where);

header('Location: ' . BASE_URL . 'product/edit.php?id='.$id);