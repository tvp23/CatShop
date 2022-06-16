<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="icon" href="assest/img/favicon.png" type="image/ico">

    <title>Catshop</title>
</head>

<body>
    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <?php session_start() ?>
    <?php include 'components/c_nav.php' ?>
    <?php include './services/s_db.php' ?>
    <?php include 'components/c_alert_banner.php'; ?>
    <div class="container d-flex justify-content-center flex-column" style="margin-top: 5em; width: 62em;">
        <div class="d-flex justify-content-center" style="margin-bottom: 2em;">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="input-group mb-3" style="width: 40em;">
                    <input type="text" class="form-control" placeholder="Search product" aria-describedby="button-addon2" name="product">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="d-flex flex-row bd-highlight mb-3 flex-wrap">
            <?php
            $products = selectProducts();
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST['product'];
                if (!empty($name)) {
                    $products = selectProductsWhereName($name);
                }
            }

            if (!empty($products)) {
                for ($i = 0; $i < count($products); $i++) { ?>
                    <div class="card" style="width: 18rem; margin: 1em;">
                        <img src="./assest/img/products/<?php echo $products[$i]['image'] ?>" class="card-img-top" alt="<?php echo $products[$i]['name'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $products[$i]['name'] ?></h5>
                            <p>$<?php echo $products[$i]['price'] ?></p>
                            <p class="card-text"><?php echo $products[$i]['description'] ?></p>
                        </div>
                    </div>
            <?php }
            }
            ?>
        </div>
    </div>
</body>

</html>