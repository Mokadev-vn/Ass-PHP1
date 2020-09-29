<?php
require_once '../libs/config.php';
checkLog();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng kí tài khoản </title>
    <?php include_once '../inc/style.php'; ?>
</head>
<body>
<?php include_once '../inc/header.php'; ?>

<main class="container-fluid" style="margin-top: 40px;">
    <div class="card">
        <div class="card-header">ĐĂNG kÍ TÀI KHOẢN</div>
        <form action="<?= BASE_URL ?>user/create-acc.php" method="post" enctype="multipart/form-data" style="margin: 20px;">
            <?php
            if (isset($_SESSION['error']) && $_SESSION['error'] != '' && !is_array($_SESSION['error'])) {
                echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }


            if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                unset($_SESSION['success']);
            }

            ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Họ và Tên</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <?= (isset($_SESSION['error']['name'])) ? '<span class="text-danger">' . $_SESSION['error']['name'] . '</span>' : ''; ?>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control">
                        <?= (isset($_SESSION['error']['email'])) ? '<span class="text-danger">' . $_SESSION['error']['email'] . '</span>' : ''; ?>
                    </div>
                    <div class="form-group">
                        <label for="">Mật Khẩu </label>
                        <input type="password" name="password" class="form-control">
                        <?= (isset($_SESSION['error']['password'])) ? '<span class="text-danger">' . $_SESSION['error']['password'] . '</span>' : ''; ?>
                    </div>
                    <div class="form-group">
                        <label for="">Xác Nhận Mật Khẩu</label>
                        <input type="password" name="repassword" class="form-control">
                        <?= (isset($_SESSION['error']['rePassword'])) ? '<span class="text-danger">' . $_SESSION['error']['rePassword'] . '</span>' : ''; ?>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Ảnh đại diện</label>
                        <input type="file" name="avatar" class="form-control">
                        <?= (isset($_SESSION['error']['img'])) ? '<span class="text-danger">' . $_SESSION['error']['img'] . '</span>' : ''; ?>
                    </div>

                    <div class="form-group">
                        <label for="">Ngày sinh</label>
                        <input type="date" name="birthdate" class="form-control">
                        <?= (isset($_SESSION['error']['date'])) ? '<span class="text-danger">' . $_SESSION['error']['date'] . '</span>' : ''; ?>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-sm btn-info">Lưu</button>
                &nbsp;
                <a href="<?= BASE_URL ?>" class="btn btn-sm btn-danger">Hủy</a>
            </div>

        </form>
    </div>
</main>
<?php unset($_SESSION['error']); ?>
<?php include_once '../inc/footer.php'; ?>