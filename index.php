<?php
require_once './libs/config.php';
role();

// lấy dữ liệu search
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// Sql get data table user
$getUserSql = "SELECT * FROM users";

if ($keyword != '') {
    $getUserSql .= " WHERE name like '%$keyword%' or email like '%$keyword%'";
}

$users = getList($getUserSql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include_once './inc/style.php' ?>
</head>

<body>
    <?php include_once './inc/header.php' ?>


    <main class="container-fluid main">
        <div class="container" style="margin-top: 40px;">
            <form action="" method="get">
                <div class="form-group row">
                    <label for="" class="col-sm-1 col-form-label">Từ Khóa</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="keyword" value="<?= $keyword ?>">
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-header clearfix">List Users <?php if (role('admin', 1)) echo '<a href="' . BASE_URL . 'admin/add-user.php" class="float-right btn btn-sm btn-success">Add User</a>'; ?></div>
                <table class="table" style="text-align: center;">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Avatar</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Birth Day</th>
                            <?php if (role('admin', 1)) echo '<th scope="col">Control</th>'; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <th scope="row"><?= $user['id'] ?></th>
                                <th><img src="<?= BASE_URL . 'public/avatars/' . $user['avatar'] ?>" alt="" style="width: 30px; height: 30px; border-radius: 50%;"></th>
                                <td><?= $user['name'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td><?= ($user['role'] == 1) ? "Admin" : "User" ?></td>
                                <td><?= formatDate($user['birthday']) ?></td>
                                <?php if (role('admin', 1)) echo '<td><a href="' . BASE_URL . 'admin/user-edit.php?id=' . $user["id"] . '" class="btn btn-sm btn-primary">Edit</a> <a href="' . BASE_URL . 'admin/user-edit.php?id=' . $user["id"] . '&type=delete" class="btn btn-sm btn-danger" onclick="return confirm(\' Confrim delete. \')">Delete</a></td>'; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
    </main>

    <?php include_once './inc/footer.php' ?>