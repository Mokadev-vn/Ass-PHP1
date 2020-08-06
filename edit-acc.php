<?php
require_once './libs/config.php';
$conn = connDB();

$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';
$avatar = isset($_FILES['avatar']) ? $_FILES['avatar'] : '';
$fileName = $_POST['avatarOld'];
$id = $_POST['id'];

if($name == '' || $birthdate == ''){
    $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin";
    header('Location: user-edit.php?id='.$id);
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
    header('Location: user-edit.php?id='.$id);
    die();
}



if ($avatar['size'] > 0) {
    if (
        $avatar['type'] == "image/png" ||
        $avatar['type'] == "image/jpeg" ||
        $avatar['type'] == "image/gif" ||
        $avatar['type'] == "image/jpg"
    ) {

        $nameArr = explode(".", $avatar['name']);

        $fileName = './avatars/' . (md5($nameArr[0]) . "_" . time() . "." . $nameArr[1]);

        $result = move_uploaded_file($avatar['tmp_name'], $fileName);
    } else {
        $_SESSION['error'] = "Vui lòng chọn file hoặc file phải đúng định dạng ảnh";
        header('Location: user-edit.php?id='.$id);
        die();
    }
}


$updateUserSql = "UPDATE users SET name = '$name', avatar = '$fileName', birthday = '$birthdate' WHERE id = '$id'";
$stmt = $conn->prepare($updateUserSql);
if($stmt->execute()){
    $_SESSION['success'] = "Update Success";
    header('Location: user-edit.php?id='.$id);
}