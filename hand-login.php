<?php
require_once './libs/config.php';
checkLog();

// get data 
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// validate data 
if($email == '' || $password == ''){
    $msg = "Vui lòng nhập email!";
    error('name', $msg);
}

if($password == ''){
    $msg = "Vui lòng nhập password!";
    error('password', $msg);
}

if(isset($_SESSION['error'])){
    header("Location: ".BASE_URL."login.php");
    die();
}

// get data in table user
$sql = "SELECT * FROM users WHERE email = '$email'";
$user = getRow($sql);

if($user && password_verify($password,$user['password'])){
    $_SESSION['user'] = [
        'id' => $user['id'],
        'name' => $user['name'],
        'email' => $user['email'],
        'avatar' => $user['avatar'],
        'role' => $user['role']
    ];
    $_SESSION['success'] = "Login successful.";
    header("Location: ".BASE_URL);    
}else{
    $_SESSION['error'] = "Thông tin tài khoản mật khẩu không chính xác!";
    header("Location: ".BASE_URL."login.php");
    die();
}