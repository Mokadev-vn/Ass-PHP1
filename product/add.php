<?php
require_once '../libs/config.php';
role();

$getCateSql = "SELECT * FROM categories";
$categories = getList($getCateSql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
    <?php include_once '../inc/style.php'; ?>
</head>

<body>
    <?php include_once '../inc/header.php'; ?>

    <main class="container-fluid" style="margin-top: 40px;">
        <div class="card">
            <div class="card-header">Create Product</div>
            <form action="<?= BASE_URL ?>product/hand-add.php" method="post" enctype="multipart/form-data" style="margin: 20px;">
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
                            <label for="">Product Name</label>
                            <input type="text" name="name" class="form-control">
                            <?= (isset($_SESSION['error']['name'])) ? '<span class="text-danger">' . $_SESSION['error']['name'] . '</span>' : ''; ?>
                        </div>
                        <div class="form-group">
                            <label for="">Detail</label>
                            <textarea type="text" name="detail" class="form-control" rows="8"></textarea>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Main Image</label>
                            <input type="file" name="image" class="form-control">
                            <?= (isset($_SESSION['error']['img'])) ? '<span class="text-danger">' . $_SESSION['error']['img'] . '</span>' : ''; ?>
                        </div>
                        <div class="form-group">
                            <label for="">Main Image</label>
                            <div class="row text-center text-lg-left" id="galleries">
                                <div class="col-lg-3 col-md-3 col-4">
                                    <div class="upload-btn-wrapper">
                                        <button class="button-upload"><i class="fas fa-plus-circle"></i></button>
                                        <input type="file" name="galleries[]" class="addGallery" />
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Category</label>
                            <select class="form-control" name="category">
                                <?php foreach ($categories as $cate) : ?>
                                    <option value="<?= $cate['id'] ?>"><?= $cate['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Product Price</label>
                            <input type="number" name="price" class="form-control">
                            <?= (isset($_SESSION['error']['price'])) ? '<span class="text-danger">' . $_SESSION['error']['price'] . '</span>' : ''; ?>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-sm btn-info">Lưu</button>
                    &nbsp;
                    <a href="<?= BASE_URL ?>product" class="btn btn-sm btn-danger">Hủy</a>
                </div>

            </form>
        </div>
    </main>
    <?php unset($_SESSION['error']); ?>
    <?php include_once '../inc/footer.php'; ?>