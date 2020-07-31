<?php
session_start();
require_once './libs/db.php';

$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if($email == '' || $password == ''){
    $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin";
    header("Location: ./login.php");
    die();
}


$conn = connDB();
$sql = "SELECT * FROM users WHERE email = :email";

$stmt = $conn->prepare($sql);
$stmt->bindParam(":email",$email);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$user = $stmt->fetch();
if($user && password_verify($password,$user['password'])){
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    
}else{
    echo "fail";
}