<?php 
require_once './libs/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include_once 'inc/style.php' ?>
</head>

<body>
    <?php include_once 'inc/header.php' ?>
    <?php
    $conn = connDB();

    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

    $getUserSql = "SELECT * FROM users";

    if($keyword != ''){
        $getUserSql .= " WHERE name like '%$keyword%' or email like '%$keyword%'";
    }


    $stmt = $conn->prepare($getUserSql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    $users = $stmt->fetchAll();

    ?>

    <main class="container main" style="margin-top: 40px;">
        <form action="" method="get">
            <div class="form-group row">
                <label for="" class="col-sm-1 col-form-label">Từ Khóa</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="keyword" value="<?= $keyword ?>">
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-header">List Users <a href="<?= BASE_URL?>register.php" class="float-right btn btn-sm btn-success">Add User</a></div>
            <table class="table" style="text-align: center;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Avatar</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Birth Day</th>
                        <th scope="col">Control</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <th scope="row"><?= $user['id'] ?></th>
                        <th><img src="<?= $user['avatar'] ?>" alt="" style="width: 30px; height: 30px; border-radius: 50%;"></th>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= ($user['role'] == 1) ? "Admin" : "User" ?></td>
                        <td><?= formatDate($user['birthday']) ?></td>
                        <td><a href="<?= BASE_URL ?>user-eidt.php=<?= $user['id'] ?>" class="btn btn-sm btn-primary">Edit</a></td> 
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include_once 'inc/footer.php' ?>