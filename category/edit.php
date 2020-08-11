<?php
require_once '../libs/config.php';
role();

$id = isset($_GET['id']) ? trim($_GET['id']) : '';

if ($id == '') {
    header('Location: ' . BASE_URL);
    die();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Categories</title>
    <?php include_once '../inc/style.php'; ?>
</head>

<body>
    <?php include_once '../inc/header.php'; ?>
    <?php
    $getCateSql = "SELECT * FROM categories WHERE id = '$id'";

    $category = getRow($getCateSql);

    if (!$category) {
        header('Location: ' . BASE_URL);
        die();
    }
    ?>
    <main class="container-fluid" style="margin-top: 40px;">
        <div class="row">
            <div class="col-md-7" style="margin: auto;">
                <div class="card">
                    <div class="card-header">EDIT CATEGORIES</div>
                    <form action="<?= BASE_URL ?>category/hand-edit.php" method="post" style="margin: 20px;">
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
                            <input type="text" name="name" class="form-control" value="<?= $category['name'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Show Menu</label>
                            <select class="form-control" name="showMenu">
                                <option value="1" <?= ($category['show_menu'] == 1) ? 'selected' : '' ?>>Có</option>
                                <option value="0" <?= ($category['show_menu'] == 0) ? 'selected' : '' ?>>Không</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Category Description</label>
                            <textarea type="text" name="description" class="form-control" rows="5"><?= $category['description'] ?></textarea>
                            <input type="hidden" name="id" value="<?= $id ?>">
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