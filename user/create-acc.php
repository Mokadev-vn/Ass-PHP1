<?php
    require_once '../libs/config.php';
    checkLog();

    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $repassword = isset($_POST['repassword']) ? $_POST['repassword'] : '';
    $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';
    $avatar = isset($_FILES['avatar']) ? $_FILES['avatar'] : '';
    $role = 0;

    // validate data

    if($name == ''){
        $msg = "Họ tên không được để trống";
        error('name',$msg);
    }

    if($birthdate == ''){
        $msg = "Vui lòng chọn ngày tháng năm sinh";
        error('date',$msg);
    }

    if(strlen($password) < 6 || (strlen(str_replace(" ","",$password)) != strlen($password))){
        $msg = "Mật khẩu không được chứa khoảng trắng và nhiều hơn 6 kí tự!";
        error('password',$msg);
    }

    if($password != $repassword){
        $msg = "Vui lòng nhập 2 mật khẩu trùng nhau";
        error('rePassword',$msg);
    }

    if(!preg_match('/^[a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶ" +
    "ẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợ" +
    "ụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\\s]+$/',$name) 
                        || strlen($name) < 2 
                        || strlen($name) > 30){

        $msg = "Tên Không Được Chứa Kí Tự Đặc Biệt Và Trong Khoảng 4-30 Kí Tự";
        error('name',$msg);
    }


    if(!preg_match("/^[a-z][a-z0-9_\.]{1,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/",$email)){
        $msg = "Nhập đúng định dạng email!";
        error('email',$msg);
    }



    $password2 = password_hash($password, PASSWORD_BCRYPT);


    $getUserSql = "SELECT * FROM users WHERE email = '$email'";
    $result = getRow($getUserSql);

    if($result){
        $msg = "Email này đã đăng kí tài khoản rồi";
        error('email',$msg);
    }

    if($avatar['size'] <= 0){
        $msg = "Vui lòng chọn ảnh đại diện";
        error('img',$msg);
    }

    if(isset($_SESSION['error'])){
        header('Location: '. BASE_URL .'user/register.php');
        die();
    }

    $type = [ 
        "image/png", 
        "image/jpeg", 
        "image/gif", 
        "image/jpg",
    ];
    
    if (in_array($avatar['type'], $type)) {

        $nameArr = explode(".", $avatar['name']);

        $fileName = (md5($nameArr[0]) ."_".time(). "." . $nameArr[1]);
    
        $result = move_uploaded_file($avatar['tmp_name'],'../public/avatars/'.$fileName);
        
        if(!$result){
            $fileName = '';
        }


    }else{
        $_SESSION['error'] = "Vui lòng chọn file hoặc file phải đúng định dạng ảnh";
        header('Location: '. BASE_URL .'user/register.php');
        die();
    }

    $table = "users";
    $data  = [
        'name' => $name,
        'email' => $email,
        'avatar' => $fileName,
        'password' => $password2,
        'role' => $role,
        'birthday' => $birthdate
    ];

    $result = insert($table, $data);

    $_SESSION['success'] = ($result)? "Đăng Kí Tài Khoản Thành Công!" : "Đăng Kí Không Thành Công Vui Lòng Thử Lại!";
    header('Location: '. BASE_URL .'user/register.php');
   




