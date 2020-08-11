<?php
require_once '../libs/config.php';
role();

// lấy dữ liệu search
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// sql get data product
$getCateSql = "SELECT * FROM categories";

if ($keyword != '') {
    $getCateSql .= " WHERE name like '%$keyword%'";
}

$categories = getList($getCateSql);


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

    <main class="container-fluid main">
        <div class="container" style="margin-top: 40px;">
            <?php
            if (isset($_SESSION['error']) && $_SESSION['error'] != '') {
                echo '<div class="alert alert-danger fade in alert-dismissible show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" style="font-size:20px">×</span>
                        </button>
                        <strong>ERROR!</strong> '.$_SESSION['error'].'
                     </div>';
                unset($_SESSION['error']);
            }

            if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                echo '<div class="alert alert-success fade in alert-dismissible show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" style="font-size:20px">×</span>
                        </button>
                        <strong>SUCCESS!</strong> '.$_SESSION['success'].'
                     </div>';
                unset($_SESSION['success']);
            }

            ?>
            <form action="" method="get">
                <div class="form-group row">
                    <label for="" class="col-sm-1 col-form-label">Từ Khóa</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="keyword" value="<?= $keyword ?>">
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-header">List Categories <a href="<?= BASE_URL ?>category/add.php" class="float-right btn btn-sm btn-success">Add Category</a></div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 5%;">ID</th>
                            <th scope="col" style="width: 30%;">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col" style="width: 13%;">Control</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $cate) : ?>
                            <tr>
                                <th scope="row"><?= $cate['id'] ?></th>
                                <td><?= $cate['name'] ?></td>
                                <td>
                                    <p class="format"><?= $cate['description'] ?></p>
                                </td>
                                <td>
                                    <a href="<?= BASE_URL ?>category/edit.php?id=<?= $cate['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="<?= BASE_URL ?>category/delete.php?id=<?= $cate['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confrim delete.')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
    </main>

    <?php include_once '../inc/footer.php' ?>