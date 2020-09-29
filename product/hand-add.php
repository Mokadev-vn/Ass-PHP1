<?php
require_once '../libs/config.php';
role();

$name      = isset($_POST['name']) ? trim($_POST['name'])    : '';
$detail    = isset($_POST['detail']) ? trim($_POST['detail']) : '';
$image     = isset($_FILES['image']) ? $_FILES['image']      : '';
$category  = isset($_POST['category']) ? $_POST['category']  : '';
$price     = isset($_POST['price']) ? $_POST['price']        : '';
$galleries = $_FILES['galleries'];

if ($name == '') {
    $msg = "Tên sản phẩm không được để trống!";
    error('name', $msg);
}

$type = [
    "image/png",
    "image/jpeg",
    "image/gif",
    "image/jpg",
];

if ($image['size'] <= 0) {
    $msg = "Vui lòng chọn ảnh chính của sản phẩm";
    error('img', $msg);
}else if (!in_array($image['type'], $type)) {
    $msg = "Vui lòng chọn file hoặc file phải đúng định dạng ảnh";
    error('img', $msg);
}


if ($price < 0 || $price == '') {
    $msg = "Vui lòng nhập giá lớn hoặc bằng 0";
    error('price', $msg);
}



if(isset($_SESSION['error'])){
    header('Location: ' . BASE_URL . 'product/add.php');
    die();
}


$nameArr = explode(".", $image['name']);

$fileName = (md5($nameArr[0]) . "_" . time() . "." . $nameArr[1]);

$result = move_uploaded_file($image['tmp_name'], '../public/products/' . $fileName);

if (!$result) {
    $fileName = '';
}

$arrImg = [];

for ($i = 0; $i < count($galleries['name']); $i++) {
    $nameImg  = $galleries['name'][$i];
    $tmp_name = $galleries['tmp_name'][$i];
    $typeImg  = $galleries['type'][$i];
    $sizeImg  = $galleries['size'][$i];

    if (in_array($typeImg, $type)) {

        $nameArr = explode(".", $nameImg);

        $fileName = (md5($nameArr[0]) . "_" . time() . "." . $nameArr[1]);

        $result = move_uploaded_file($tmp_name, '../public/products/' . $fileName);

        $arrImg[] = $fileName;
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

$result = insert($table, $data, true);

if ($result) {
    $_SESSION['success'] = "Thêm sản phẩm '$name' thành công";
} else {
    $_SESSION['error'] = "Có lỗi xảy ra vui lòng thử lại!";
    header('Location: ' . BASE_URL . 'product');
    die();
}

// get id new insert

$productId = $result;

$table = "product_galleries";

foreach ($arrImg as $img) {
    $data  = [
        'image' => $img,
        'product_id' => $productId
    ];
    insert($table, $data);
}


header('Location: ' . BASE_URL . 'product');
