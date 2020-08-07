<header class="header container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="<?= BASE_URL ?>">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="<?= BASE_URL.'admin/category.php' ?>">Categories <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="#">Products</a>
                    <a class="nav-item nav-link" href="<?= BASE_URL.'user/register.php' ?>">Register</a>
                    <a class="nav-item nav-link" href="<?= BASE_URL.'login.php' ?>">Login</a>
                </div>
            </div>
        </nav>
    </header>