<?php
    require_once './libs/config.php';
    checkLog(true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include_once 'inc/style.php' ?>
</head>

<body>
    <?php include_once 'inc/header.php' ?>

    <main class="container-fluid main" style="margin-top: 40px;">
        <div class="row">
            <div class="col-md-6" style="margin : auto;">
                <div class="card">
                    <div class="card-header">Đăng Nhập</div>
                    <form action="<?= BASE_URL ?>hand-login.php" method="post" style="padding: 10px;">
                        <?php
                        if (isset($_SESSION['error']) && $_SESSION['error'] != '') {
                            echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                            unset($_SESSION['error']);
                        }

                        ?>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Mật Khẩu </label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-success">Đăng Nhập</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </main>

    <?php include_once 'inc/footer.php' ?>