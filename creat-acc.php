<?php
    session_start();
    require_once './libs/db.php';

    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $repassword = isset($_POST['repassword']) ? $_POST['repassword'] : '';
    $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';
    $avatar = isset($_FILES['avatar']) ? $_FILES['avatar'] : '';
    $role = 0;

    
    if($name == '' || $email == '' || $password == '' || $birthdate == ''){
        $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin";
        header('Location: register.php');
        die();
    }

    if($password != $repassword){
        $_SESSION['error'] = "Vui lòng nhập 2 mật khẩu trùng nhau";
        header('Location: register.php');
        die();
    }

    if(!preg_match('/^[a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶ" +
    "ẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợ" +
    "ụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\\s]+$/',$name)){
        $_SESSION['error'] = "Tên Không Được Chứa Kí Tự Đặc Biệt!";
        header('Location: register.php');
        die();
    }

    if(!preg_match("/^[a-z][a-z0-9_\.]{1,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/",$email)){
        $_SESSION['error'] = "Email sai định dạng!";
        header('Location: register.php');
        die();
    }


    $password2 = password_hash($password, PASSWORD_BCRYPT);


    $conn = connDB();

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = '$email'");

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    if($stmt->fetch()){
        $_SESSION['error'] = "Email này đã đăng kí tài khoản rồi";
        header('Location: register.php');
        die();
    }


    if($avatar['type'] == "image/png" || 
       $avatar['type'] == "image/jpeg" || 
       $avatar['type'] == "image/gif" || 
       $avatar['type'] == "image/jpg"){

        $nameArr = explode(".", $avatar['name']);

        $fileName = './avatars/'.(md5($nameArr[0]) ."_".time(). "." . $nameArr[1]);
    
        $result = move_uploaded_file($avatar['tmp_name'],$fileName);
        
        if(!$result){
            $fileName = '';
        }


    }else{
        $_SESSION['error'] = "Vui lòng chọn file đúng định dạng ảnh";
        header('Location: register.php');
        die();
    }

    $sql = "INSERT INTO users (name, email, avatar, password, role, birthday) VALUES ('$name', '$email', '$fileName', '$password2', '$role', '$birthdate')";

    $stmt = $conn->prepare($sql);

    $_SESSION['success'] = ($stmt->execute())? "Đăng Kí Tài Khoản Thành Công!" : "Đăng Kí Không Thành Công Vui Lòng Thử Lại!";
    header('Location: register.php');
   




