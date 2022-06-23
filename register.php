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

    <?php session_start(); ?>
    <?php
    if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role="alert">
            <span style="font-weight: bold;">Warning:</span>
            <div class="d-flex">
                <p>the following input was incorect: </p>
                <?php if (in_array(0, $_SESSION['error']) | in_array(1, $_SESSION['error'])) { ?>
                    <p style="font-weight: bold;">Email,</p>
                <?php }
                if (in_array(2, $_SESSION['error'])) { ?>
                    <p style="font-weight: bold;">Name,</p>
                <?php }
                if (in_array(3, $_SESSION['error'])) { ?>
                    <p style="font-weight: bold;">Password</p>
                <?php } ?>
            </div>
        </div>
    <?php }
    unset($_SESSION['error']);
    ?>

    <div style="margin-top: 10%;" class="d-flex justify-content-center align-items-center">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/components/c_register.php' ?>
    </div>

</body>

</html>