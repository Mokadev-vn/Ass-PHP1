<?php
require_once '../libs/config.php';
role();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Categories</title>
    <?php include_once '../inc/style.php' ?>
</head>

<body>
    <?php include_once '../inc/header.php'; ?>
    <main class="container-fluid" style="margin-top: 40px;">
        <div class="row">
            <div class="col-md-7" style="margin: auto;">
                <div class="card">
                    <div class="card-header">ADD CATEGORIES</div>
                    <form action="<?= BASE_URL ?>category/hand-add.php" method="post" style="margin: 20px;">
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

                        <div class="form-group">
                            <label for="">Category Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Show Menu</label>
                            <select class="form-control" name="showMenu">
                                <option value="1">Có</option>
                                <option value="0">Không</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Category Description</label>
                            <textarea type="text" name="description" class="form-control" rows="5"></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-info">Lưu</button>
                            &nbsp;
                            <a href="" class="btn btn-sm btn-danger">Hủy</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php include_once '../inc/footer.php'; ?>