<?php
    require_once '../libs/config.php';
    checkLog();

    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $repassword = isset($_POST['rePassword']) ? $_POST['rePassword'] : '';
    $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';
    $avatar = isset($_FILES['avatar']) ? $_FILES['avatar'] : '';
    $role = isset($_POST['role']) ? $_POST['role']  : '';

    // validate data

    if($name == '' || $email == '' || $password == '' || $birthdate == ''){
        $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin";
        header('Location: '. BASE_URL .'admin/add-user.php');
        die();
    }

    if(strlen($password) < 6 || (strlen(str_replace(" ","",$password)) != strlen($password))){
        $_SESSION['error'] = "Mật khẩu không được chứa khoảng trắng và nhiều hơn 6 kí tự!";
        header('Location: '. BASE_URL .'admin/add-user.php');
        die();
    }

    if($password != $repassword){
        $_SESSION['error'] = "Vui lòng nhập 2 mật khẩu trùng nhau";
        header('Location: '. BASE_URL .'admin/add-user.php');
        die();
    }

    if(!preg_match('/^[a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶ" +
    "ẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợ" +
    "ụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\\s]+$/',$name) 
                        || strlen($name) < 2 
                        || strlen($name) > 30){

        $_SESSION['error'] = "Tên Không Được Chứa Kí Tự Đặc Biệt Và Trong Khoảng 4-30 Kí Tự";
        header('Location: '. BASE_URL .'admin/add-user.php');
        die();
    }


    if(!preg_match("/^[a-z][a-z0-9_\.]{1,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/",$email)){
        $_SESSION['error'] = "Email sai định dạng!";
        header('Location: '. BASE_URL .'admin/add-user.php');
        die();
    }


    $password2 = password_hash($password, PASSWORD_BCRYPT);


    $getUserSql = "SELECT * FROM users WHERE email = '$email'";
    $result = getRow($getUserSql);

    if($result){
        $_SESSION['error'] = "Email này đã đăng kí tài khoản rồi";
        header('Location: '. BASE_URL .'admin/add-user.php');
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
        header('Location: '. BASE_URL .'admin/add-user.php');
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

    $_SESSION['success'] = ($result)? "Thêm User Thành Công!" : "Đăng Kí Không Thành Công Vui Lòng Thử Lại!";
    header('Location: '. BASE_URL .'index.php');
   




