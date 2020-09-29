<?php
require_once '../libs/config.php';
role();

$id = isset($_POST['id']) ? trim($_POST['id']) : '';
$name      = isset($_POST['name']) ? trim($_POST['name'])    : '';
$detail    = isset($_POST['detail']) ? trim($_POST['detail']) : '';
$image     = $_FILES['image'];
$category  = isset($_POST['category']) ? $_POST['category']  : '';
$price     = isset($_POST['price']) ? $_POST['price']        : '';
$removeGalleries = isset($_POST['removeGalleries']) ? trim($_POST['removeGalleries'], ',') : '';
$galleries = $_FILES['galleries'];
$fileName = isset($_POST['avatarOld']) ? $_POST['avatarOld'] : '';


if ($name == '') {
    $msg = "Tên sản phẩm không được để trống!";
    error('name', $msg);
}


if ($price < 0 || $price == '') {
    $msg = "Vui lòng nhập giá lớn hoặc bằng 0";
    error('price', $msg);
}


$type = [
    "image/png",
    "image/jpeg",
    "image/gif",
    "image/jpg",
];

if ($image['size'] > 0 && !in_array($image['type'], $type)) {
    $msg = "Vui lòng chọn đúng định dạng ảnh!";
    error('img', $msg);
}

if (isset($_SESSION['error'])) {
    header('Location: ' . BASE_URL . 'product/edit.php?id=' . $id);
    die();
}

if ($image['size'] > 0) {
    $nameArr = explode(".", $image['name']);

    $fileName = (md5($nameArr[0]) . "_" . time() . "." . $nameArr[1]);

    $result = move_uploaded_file($image['tmp_name'], '../public/products/' . $fileName);
}

$listGallery = [];

for ($i = 0; $i < count($galleries['name']); $i++) {
    $nameImg  = $galleries['name'][$i];
    $tmp_name = $galleries['tmp_name'][$i];
    $typeImg  = $galleries['type'][$i];
    $sizeImg  = $galleries['size'][$i];

    if (in_array($typeImg, $type)) {

        $nameArr = explode(".", $nameImg);

        $fileNameGallery = (md5($nameArr[0]) . "_" . time() . "." . $nameArr[1]);

        $result = move_uploaded_file($tmp_name, '../public/products/' . $fileNameGallery);

        $listGallery[] = $fileNameGallery;
    }
}


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
} else {
    $_SESSION['error'] = "Update Product Fail!";
    header('Location: ' . BASE_URL . 'product/edit.php?id=' . $id);
    die();
}


$table = "product_galleries";

$arrRemove = explode(',',$removeGalleries);

foreach ($arrRemove as $id_gallery){
    $where = "id = '$id_gallery'";
    remove($table, $where);
}

foreach ($listGallery as $img) {

    $data  = [
        'image' => $img,
        'product_id' => $id
    ];

    insert($table, $data);
}


header('Location: ' . BASE_URL . 'product/edit.php?id=' . $id);
