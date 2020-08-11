<?php
require_once '../libs/config.php';
role();

$name      = isset($_POST['name']) ? trim($_POST['name'])    : '';
$detail    = isset($_POST['detail']) ? trim($_POST['detail']): '';
$image     = isset($_FILES['image']) ? $_FILES['image']      : '';
$category  = isset($_POST['category']) ? $_POST['category']  : '';
$price     = isset($_POST['price']) ? $_POST['price']        : '';
$galleries = $_FILES['galleries'];


if ($name == '' || $detail == '' || $price == '') {
    $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin";
    header('Location: '. BASE_URL.'product/add.php');
    die();
}

if ($image['size'] <= 0) {
    $_SESSION['error'] = "Vui lòng chọn ảnh chính của sản phẩm";
    header('Location: '. BASE_URL.'product/add.php');
    die();
}

$type = [ 
    "image/png", 
    "image/jpeg", 
    "image/gif", 
    "image/jpg",
];

if (in_array($image['type'], $type)) {

    $nameArr = explode(".", $image['name']);

    $fileName = (md5($nameArr[0]) . "_" . time() . "." . $nameArr[1]);

    $result = move_uploaded_file($image['tmp_name'], '../public/products/' . $fileName);

    if (!$result) {
        $fileName = '';
    }
} else {
    $_SESSION['error'] = "Vui lòng chọn file hoặc file phải đúng định dạng ảnh";
    header('Location: '. BASE_URL.'product/add.php');
    die();
}

$arrImg = [];

for($i=0;$i<count($galleries['name']);$i++){
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

$objImg = json_encode($arrImg);


$table = "products";
$data  = [
    'name' => $name,
    'main_image' => $fileName,
    'price' => $price,
    'detail' => $detail,
    'cate_id' => $category
];

$result = insert($table, $data);

if ($result) {
    $_SESSION['success'] = "Thêm sản phẩm '$name' thành công";
} else {
    $_SESSION['error'] = "Có lỗi xảy ra vui lòng thử lại!";
    header('Location: '. BASE_URL.'product');
    die();
}

// get id new insert
$productId = getIdInsertNew();

$table = "product_galleries";
$data  = [
    'image' => $objImg,
    'product_id' => $productId
];

insert($table, $data);

header('Location: '. BASE_URL.'product');
