<?php
require_once '../libs/config.php';
role();

$id = $_SESSION['user']['id'];

if (count($_POST) != 0) {

    $oldPassword = isset($_POST['oldPassword']) ? $_POST['oldPassword'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $rePassword = isset($_POST['rePassword']) ? $_POST['rePassword'] : '';

    if ($oldPassword == '' || $password == '' || $rePassword == '') {
        $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin!";
        header('Location: ' . BASE_URL . 'user/change-password.php');
        die();
    }

    if (strlen($password) < 6 || (strlen(str_replace(" ", "", $password)) != strlen($password))) {
        $_SESSION['error'] = "Mật khẩu không được chứa khoảng trắng và nhiều hơn 6 kí tự!";
        header('Location: ' . BASE_URL . 'user/change-password.php');
        die();
    }

    $getUserSql = "SELECT * FROM users WHERE id = '$id'";
    $user = getRow($getUserSql);

    if (!password_verify($oldPassword, $user['password'])) {
        $_SESSION['error'] = "Mật khẩu cũ không chính xác!";
        header('Location: ' . BASE_URL . 'user/change-password.php');
        die();
    }

    if ($password != $rePassword) {
        $_SESSION['error'] = "Mật khẩu không giống nhau!";
        header('Location: ' . BASE_URL . 'user/change-password.php');
        die();
    }

    $password2 = password_hash($password, PASSWORD_BCRYPT);

    $table = "users";
    $data  = [
        'password' => $password2
    ];
    $where = "id = '$id'";

    $result = update($table, $data, $where);

    if ($result) {
        $_SESSION['success'] = "Change Password Successful!";
        header('Location: ' . BASE_URL . 'user/change-password.php');
        die();
    } else {
        $_SESSION['error'] = "Có lỗi xảy ra vui lòng thử lại!";
        header('Location: ' . BASE_URL . 'user/change-password.php');
        die();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Change Password</title>
    <?php include_once '../inc/style.php'; ?>
</head>

<body>
    <?php include_once '../inc/header.php'; ?>
    <main class="container-fluid" style="margin-top: 40px;">
        <div class="row">
            <div class="col-md-7" style="margin: auto;">
                <div class="card">
                    <div class="card-header">EDIT CATEGORIES</div>
                    <form action="<?= BASE_URL ?>user/change-password.php" method="post" style="margin: 20px;">
                        <?php
                        if (isset($_SESSION['error']) && $_SESSION['error'] != '') {
                            echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                            unset($_SESSION['error']);
                        }

                        if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                            echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                            unset($_SESSION['success']);
                        }

                        ?>

                        <div class="form-group">
                            <label for="">Old Password</label>
                            <input type="password" name="oldPassword" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">New Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Re-Type New Password</label>
                            <input type="password" name="rePassword" class="form-control">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-info">Lưu</button>
                            &nbsp;
                            <a href="" class="btn btn-sm btn-danger">Hủy</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php include_once '../inc/footer.php'; ?>