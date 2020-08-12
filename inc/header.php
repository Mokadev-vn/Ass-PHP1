<?php
// get list Category
$getCateMenuSql = "SELECT * FROM categories WHERE show_menu = '1'";
$cateMenus = getList($getCateMenuSql);

?>
<header class="header container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?= BASE_URL ?>">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <?php if (!role('user', 1)) : ?>
                    <a class="nav-item nav-link" href="<?= BASE_URL . 'user/register.php' ?>">Register</a>
                    <a class="nav-item nav-link" href="<?= BASE_URL . 'login.php' ?>">Login</a>
                <?php else : ?>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?= BASE_URL . 'public/avatars/' . $_SESSION['user']['avatar'] ?>" alt="" style="width: 30px; height: 30px; border-radius: 50%;">
                            <?= $_SESSION['user']['name'] ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarProfile">
                            <a class="dropdown-item" href="<?= BASE_URL ?>user/edit.php">Edit Profile</a>
                            <a class="dropdown-item" href="<?= BASE_URL ?>user/change-password.php">Change Password</a>
                            <a class="dropdown-item" href="<?= BASE_URL . 'logout.php' ?>">Logout</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= BASE_URL ?>category" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            List Categories
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?php foreach ($cateMenus as $cate) : ?>
                                <a class="dropdown-item" href="#"><?= $cate['name'] ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <a class="nav-item nav-link" href="<?= BASE_URL ?>product">Product</a>
                    <a class="nav-item nav-link" href="<?= BASE_URL ?>category">Category</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>