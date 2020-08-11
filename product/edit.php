<?php
require_once '../libs/config.php';
role();

$id = isset($_GET['id']) ? trim($_GET['id']) : '';

if ($id == '') {
    header('Location: ' . BASE_URL);
    die();
}

$getCateSql = "SELECT * FROM categories";
$categories = getList($getCateSql);

$getProductSql = "SELECT p.*, 
                        c.name as cate_name, 
                        pg.image as galleries FROM categories c  
                                                join products p on p.cate_id = c.id 
                                                join product_galleries pg on p.id = pg.product_id
                                                WHERE p.id = '$id'";
$product = getRow($getProductSql);
$objImg = json_decode($product['galleries']);

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
            <form action="<?= BASE_URL ?>product/hand-edit.php" method="post" enctype="multipart/form-data" style="margin: 20px;">
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
                            <label for="">Product Name</label>
                            <input type="text" name="name" class="form-control" value="<?= $product['name'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Detail</label>
                            <textarea type="text" name="detail" class="form-control" rows="8"><?= $product['detail'] ?></textarea>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group text-center">
                            <img src="<?= BASE_URL . 'public/products/' . $product['main_image'] ?>" alt="" style="width: 150px; height: 150px;">
                            <input type="hidden" name="avatarOld" value="<?= $product['main_image'] ?>">
                            <input type="hidden" name="id" value="<?= $product['id'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Main Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Main Image</label>
                            <div class="row text-center text-lg-left" id="galleries">
                                <?php foreach ($objImg as $img) : ?>
                                    <div class="col-lg-3 col-md-3 col-4">
                                        <input type="hidden" name="oldGallies[]" value="<?= $img ?>">
                                        <div class="d-block mb-4 h-100 position-relative">
                                            <img style="height: 100px; width: 130px" src="<?= BASE_URL . 'public/products/' . $img ?>" alt="">
                                            <a href="#" class="remove-img"><i class="fas fa-times-circle"></i></a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>


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
                                    <option value="<?= $cate['id'] ?>" <?= ($cate['id'] == $product['cate_id']) ? 'selected' : '' ?>><?= $cate['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Product Price</label>
                            <input type="number" name="price" class="form-control" value="<?= $product['price']; ?>">
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

    <?php include_once '../inc/footer.php'; ?>