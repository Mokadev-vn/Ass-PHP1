<?php
require_once '../libs/config.php';
role('admin');

$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';
$avatar = isset($_FILES['avatar']) ? $_FILES['avatar'] : '';
$role = isset($_POST['role']) ? $_POST['role'] : '';
$fileName = $_POST['avatarOld'];
$id = $_POST['id'];

if($name == '' || $birthdate == ''){
    $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin";
    header('Location: '. BASE_URL .'admin/user-edit.php?id='.$id);
    die();
}


if (
    !preg_match('/^[a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶ" +
    "ẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợ" +
    "ụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\\s]+$/', $name)
    || strlen($name) < 2
    || strlen($name) > 30
) {

    $_SESSION['error'] = "Tên Không Được Chứa Kí Tự Đặc Biệt Và Trong Khoảng 4-30 Kí Tự";
    header('Location: '. BASE_URL .'admin/user-edit.php?id='.$id);
    die();
}



if ($avatar['size'] > 0) {
    $type = [ 
        "image/png", 
        "image/jpeg", 
        "image/gif", 
        "image/jpg",
    ];
    
    if (in_array($avatar['type'], $type)) {

        $nameArr = explode(".", $avatar['name']);

        $fileName = (md5($nameArr[0]) . "_" . time() . "." . $nameArr[1]);

        $result = move_uploaded_file($avatar['tmp_name'],'../public/avatars/' . $fileName);
    } else {
        $_SESSION['error'] = "Vui lòng chọn file hoặc file phải đúng định dạng ảnh";
        header('Location: '. BASE_URL .'admin/user-edit.php?id='.$id);
        die();
    }
}

$table = "users";
$data  = [
    'name'     => $name,
    'avatar'   => $fileName,
    'role'     => $role,
    'birthday' => $birthdate
];
$where = "id = '$id'";

$result = update($table, $data, $where);

if($result){
    $_SESSION['success'] = "Update Success";
    header('Location: '. BASE_URL .'admin/user-edit.php?id='.$id);
}else{
    $_SESSION['error'] = "Update Fail!";
    header('Location: '. BASE_URL .'admin/user-edit.php?id='.$id);
}