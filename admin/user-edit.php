<?php
require_once '../libs/config.php';
role('admin');

$id = isset($_GET['id']) ? $_GET['id'] : '';
$type= isset($_GET['type']) ? $_GET['type'] : '';

if ($id == '') {
    header('Location: '. BASE_URL);
    die();
}

if($type == 'delete') {
    remove("users","id = '$id'");
    $_SESSION['success'] = "Delete User Successfully!";
    header('Location: '. BASE_URL);
    die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include_once '../inc/style.php' ?>
</head>

<body>
    <?php include_once '../inc/header.php' ?>
    <main class="container-fluid" style="margin-top: 40px;">
        <?php

        $sql = "SELECT * FROM users WHERE id = '$id'";
        $user = getRow($sql);

        if (!$user) {
            header('Location: '. BASE_URL);
            die();
        }

        ?>

        <div class="card">
            <div class="card-header">Edit User</div>
            <form action="<?= BASE_URL ?>admin/edit-acc.php" method="post" enctype="multipart/form-data" style="margin: 20px;">
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Họ và Tên</label>
                            <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" value="<?= $user['email'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Ngày sinh</label>
                            <input type="date" name="birthdate" class="form-control" value="<?= $user['birthday']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Role</label>
                            <select class="form-control" name="role">
                                <option value="1" <?= ($user['role'] == 1) ? 'selected' : ''?>>Admin</option>
                                <option value="0" <?= ($user['role'] == 0) ? 'selected' : ''?>>User</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group text-center">
                            <img src="<?= BASE_URL . 'public/avatars/' .$user['avatar'] ?>" alt="" style="width: 150px; height: 150px; border-radius: 50%;">
                            <input type="hidden" name="avatarOld" value="<?= $user['avatar'] ?>">
                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Ảnh đại diện</label>
                            <input type="file" name="avatar" class="form-control">
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
    <?php include_once '../inc/footer.php' ?>