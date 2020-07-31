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

    $sql = "SELECT * FROM users";

    $stmt = $conn->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    $users = $stmt->fetchAll();

    ?>

    <main class="container-fluid main" style="margin-top: 40px;">
        <div class="card">
            <div class="card-header">List Users</div>
            <table class="table" style="text-align: center;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Birth Day</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <th scope="row"><?= $user['id'] ?></th>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= ($user['role'] == 1) ? "Admin" : "User" ?></td>
                        <td><?= $user['birthday'] ?></td>    
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include_once 'inc/footer.php' ?>