<?php
require_once '../libs/config.php';
role();

$_SESSION['carts'] = [
    [
        'id' => 1,
        'image' => 'aaca0f5eb4d2d98a6ce6dffa99f8254b_1597175187.jpg',
        'name' => 'Test',
        'price' => 2000,
        'count' => 2
    ]
];

$listCart = isset($_SESSION['carts']) ? $_SESSION['carts'] : [];

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
    <?php include_once '../inc/header.php'; ?>
    <main class="container-fluid main">
        <div class="container" style="margin-top: 40px;">
            <?php
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
            <div class="card">
                <div class="card-header">Cart </div>
                <table class="table" style="text-align: center;">
                    <thead>
                        <tr>
                            <th scope="col">Img</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listCart as $product) : ?>
                            <tr>
                                <th><img src="<?= BASE_URL . 'public/products/' . $product['image'] ?>" alt="" style="width: 30px; height: 30px; border-radius: 50%;"></th>
                                <td><?= $product['name'] ?></td>
                                <td><?= $product['price'] ?></td>
                                <td><?= $product['count'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
                <div class="d-flex justify-content-end m-2">
                    <button type="submit" class="btn btn-sm btn-info">Thanh Toán</button>
                    &nbsp;
                    <a href="<?= BASE_URL ?>" class="btn btn-sm btn-danger">Hủy</a>
                </div>
            </div>
        </div>
        <hr>
    </main>
    <?php include_once '../inc/footer.php'; ?>
</body>

</html>