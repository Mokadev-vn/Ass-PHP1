<?php
require_once '../libs/config.php';
$conn = connDB();

    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

    $getCateSql = "SELECT * FROM categories";

    if($keyword != ''){
        $getCateSql .= " WHERE name like '%$keyword%' or email like '%$keyword%'";
    }


    $stmt = $conn->prepare($getCateSql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    $categories = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <?php include_once '../inc/style.php'; ?>
</head>

<body>
    <?php include_once '../inc/header.php'; ?>
    <main class="main container-fluid">
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
                <div class="card-header">List Categories <a href="<?= BASE_URL ?>admin/add-cate.php" class="float-right btn btn-sm btn-success">Add Categories</a></div>
                <table class="table table-bordered" style="text-align: center;">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 10%;">ID</th>
                            <th scope="col" style="width: 60%;">Name</th>
                            <th scope="col">Control</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $cate) : ?>
                            <tr>
                                <th scope="row"><?= $cate['id'] ?></th>
                                <td><?= $cate['name'] ?></td>
                                <td><a href="<?= BASE_URL ?>user-edit.php?id=<?= $cate['id'] ?>" class="btn btn-sm btn-success">View</a> <a href="<?= BASE_URL ?>user-edit.php?id=<?= $cate['id'] ?>" class="btn btn-sm btn-primary">View</a> <a href="<?= BASE_URL ?>user-edit.php?id=<?= $cate['id'] ?>" class="btn btn-sm btn-danger">Delete</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </main>
    <?php include_once '../inc/footer.php'; ?>