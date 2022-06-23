<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="icon" href="assest/img/favicon.png" type="image/ico">

    <title>Catshop</title>
</head>

<body>
    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



    <?php session_start(); ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/components/c_nav.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/services/s_rolecheck.php';
    checkRole('admin'); ?>
    <?php
    if (isset($_POST['deleteFile'])) {

        if (!unlink('files/' . $_POST['deleteFile'])) {
    ?>
            <div class="alert alert-danger" role="alert">
                <?php echo ($_POST['deleteFile'] . " cannot be deleted due to an error") ?>
            </div>
        <?php
        } else {
        ?>
            <div class="alert alert-success" role="alert">
                <?php echo ($_POST['deleteFile'] . " has been deleted") ?>
            </div>
    <?php
        }
    }
    ?>
    <div class="container" style="margin-top: 10em;">
        <div class="card">
            <div class="card-body">
                <h4>Files</h4>
                <?php if ($_SESSION['role'] != 'admin') { ?>
                    <!-- DeleteButton -->
                    <button style="height: 24.5px; margin-bottom:0.5em;" class="btn btn-primary d-flex align-items-center" type="button" data-toggle="modal" data-target="#add"><i class="bi bi-plus"></i></button>
                    <!-- DeleteModal -->
                    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="ActivateAlertLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ActivateAlertLabel">File Upload</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="services/s_upload.php" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        Select image to upload:
                                        <input type="file" name="fileToUpload" id="fileToUpload">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="activateAlert" value="Upload Image" class="btn btn-primary">Upload File</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Tools</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $dir = 'files/';
                        $files = scandir($dir);

                        for ($i = 2; $i < count($files); $i++) { ?>
                            <tr>
                                <th scope="row"><?php echo $i - 1 ?></th>
                                <td><?php echo $files[$i] ?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example" style="padding-bottom: 0.5em;">
                                        <!-- DownloadButton -->
                                        <button style="height: 24.5px;" class="btn btn-primary d-flex align-items-center" type="button"><a class="download" href="services/s_download.php?path=<?php echo $files[$i] ?>"><i class="bi bi-download"></i></a></button>
                                        <?php if ($_SESSION['role'] != 'admin') { ?>
                                            <!-- DeleteModal -->
                                            <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="ActivateAlertLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="ActivateAlertLabel">Warning</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete the file?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="post">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" value="<?php echo $files[$i] ?>" name="deleteFile" class="btn btn-danger">Delete File</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- DeleteButton -->
                                            <button style="height: 24.5px;" class="btn btn-danger d-flex align-items-center" type="button" data-toggle="modal" data-target="#delete"><i class="bi bi-x"></i></button>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>

<style>
    /* unvisited link */
    .download:link {
        color: white;
    }

    /* visited link */
    .download:visited {
        color: white;
    }

    /* mouse over link */
    .download:hover {
        color: white;
    }

    /* selected link */
    .download:active {
        color: white;
    }
</style>