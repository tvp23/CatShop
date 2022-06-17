<?php
$currentPage = str_replace(["/catshop/", ".php"], "", "$_SERVER[REQUEST_URI]");
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="./assest/img/logo.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
        CatShop
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav d-flex" style="width: 100%;">
            <li class="nav-item <?php if ($currentPage == 'index') echo "active" ?>">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item <?php if ($currentPage == 'products') echo "active" ?>">
                <a class="nav-link" href="products.php">Products</a>
            </li>
            <?php if ($_SESSION != null) {
                if ($_SESSION['role'] != 'user') {
            ?>
                    <li class="nav-item <?php if ($currentPage == 'files') echo "active" ?>">
                        <a class="nav-link" href="files.php">Files</a>
                    </li>
                    <?php if ($_SESSION['role'] != 'admin') { ?>
                        <li class="nav-item <?php if ($currentPage == 'alerts') echo "active" ?>">
                            <a class="nav-link" href="alerts.php">Alerts</a>
                        </li>
                    <?php } ?>
            <?php }
            } ?>
        </ul>
        <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px; margin:0em;">
            <?php if ($_SESSION != null) { ?>
                <li class="nav-item dropdown <?php if ($currentPage == 'settings') echo "active" ?> <?php if ($currentPage == 'users') echo "active" ?>">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION["name"]; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                        <?php
                        if ($_SESSION['role'] != 'user') {
                        ?>
                            <?php if ($_SESSION['role'] != 'admin') { ?>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="users.php">Users</a></li>
                            <?php } ?>
                        <?php } ?>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item font-weight-bold logout" href="./services/s_logout.php">Logout</a></li>
                    </ul>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            <?php } ?>

        </ul>
    </div>
</nav>

<style>
    .logout:hover {
        color: #dc3545;
    }

    .logout {
        color: #dc3545;
    }

    .logout:enabled {
        color: #dc3545;
    }

    .logout:active {
        background-color: #dc3545 !important;
        color: white !important;
    }
</style>