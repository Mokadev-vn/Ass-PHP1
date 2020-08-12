<?php
require_once '../libs/config.php';
role();

// lấy dữ liệu search
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// sql get data product
$getProductSql = "SELECT p.*, c.name as cate_name FROM products p join categories c on p.cate_id = c.id";

if ($keyword != '') {
    $getProductSql .= " WHERE name like '%$keyword%'";
}

$products = getList($getProductSql);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Products</title>
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
                        <strong>ERROR!</strong> ' . $_SESSION['error'] . '
                     </div>';
                unset($_SESSION['error']);
            }

            if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                echo '<div class="alert alert-success fade in alert-dismissible show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" style="font-size:20px">×</span>
                        </button>
                        <strong>SUCCESS!</strong> ' . $_SESSION['success'] . '
                     </div>';
                unset($_SESSION['success']);
            }

            ?>
            <form action="" method="get">
                <div class="form-group row">
                    <label for="" class="col-sm-1 col-form-label">Từ khóa</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="keyword" value="<?= $keyword ?>">
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-header">List Product <a href="<?= BASE_URL ?>product/add.php" class="float-right btn btn-sm btn-success">Add Product</a></div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Detail</th>
                            <th scope="col">Price</th>
                            <th scope="col">Category</th>
                            <th scope="col">Control</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <th scope="row"><?= $product['id'] ?></th>
                                <th><img src="<?= BASE_URL . 'public/products/' . $product['main_image'] ?>" alt="" style="width: 30px; height: 30px; border-radius: 50%;"></th>
                                <td>
                                    <p class="name-product"><?= $product['name'] ?></p>
                                </td>
                                <td>
                                    <p class="format-product"><?= $product['detail'] ?></p>
                                </td>
                                <td><?= number_format($product['price'], 0, '', ','); ?>đ</td>
                                <td><?= $product['cate_name'] ?></td>
                                <td>
                                    <a href="<?= BASE_URL ?>product/edit.php?id=<?= $product['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="<?= BASE_URL ?>product/delete.php?id=<?= $product['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confrim delete.')">Delete</a>
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