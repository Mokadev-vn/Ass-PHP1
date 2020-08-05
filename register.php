<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng kí tài khoản </title>
    <?php include_once './inc/style.php'; ?>
</head>
<?php include_once './inc/header.php'; ?>

<main class="container-fluid" style="margin-top: 40px;">
    <div class="card">
        <div class="card-header">ĐĂNG kÍ TÀI KHOẢN</div>
        <form action="<?= BASE_URL ?>creat-acc.php" method="post" enctype="multipart/form-data" style="margin: 20px;">
            <?php
            if (isset($_SESSION['error']) && $_SESSION['error']!= '') {
                echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }

            if(isset($_SESSION['success']) && $_SESSION['success'] != '') {
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
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Mật Khẩu </label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Xác Nhận Mật Khẩu</label>
                        <input type="password" name="repassword" class="form-control">
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Ảnh đại diện</label>
                        <input type="file" name="avatar" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Ngày sinh</label>
                        <input type="date" name="birthdate" class="form-control">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-sm btn-info">Lưu</button>
                &nbsp;
                <a href="" class="btn btn-sm btn-danger">Hủy</a>
            </div>

        </form>
    </div>
</main>


<body>
    <?php include_once './inc/footer.php'; ?>