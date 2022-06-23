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
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/services/s_rolecheck.php';
    checkRole('superadmin'); ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/services/s_db.php' ?>
    <?php
    if (isset($_POST['activateAlert'])) {
        updateActiveAlert($_POST['activateAlert']);
    }
    if (isset($_POST['editAlert'])) {
        updateAlert($_POST['editAlert'], $_POST['updatemessage'], $_POST['updatecolor']);
    }
    if (isset($_POST['deleteAlert'])) {
        deleteAlert($_POST['deleteAlert']);
    }
    if (isset($_POST['insertAlert'])) {
        insertAlert($_POST['insertmessage'], $_POST['insertcolor']);
    }
    if (isset($_POST['disableAlerts'])) {
        updateDisableAlerts();
    }
    ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/components/c_nav.php' ?>
    <div class="container" style="padding-top: 8em">
        <div class="card" style="margin-top: 2em;">
            <div class="card-body">
                <h4 class="card-title">Alerts</h4>
                <div class="btn-group" role="group" aria-label="Basic example" style="padding-bottom: 0.5em;">
                    <!-- InsertButton -->
                    <button style="height: 24.5px;" class="btn btn-primary d-flex align-items-center" type="button" data-toggle="modal" data-target="#insert"><i class="bi bi-plus"></i></button>
                    <!-- DisableButton -->
                    <button style="height: 24.5px;" class="btn btn-warning d-flex align-items-center" type="button" data-toggle="modal" data-target="#disable"><i class="bi bi-x"></i></button>
                </div>
                <!-- InsertModal -->
                <div class="modal fade" id="insert" tabindex="-1" aria-labelledby="insertLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="insertAlertLabel">Insert</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <!-- Message -->
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Message</label>
                                            <input type="text" name="insertmessage" class="form-control">
                                        </div>

                                        <!-- ColorSelect -->
                                        <div class="form-group col-md-4">
                                            <label for="inputState">Color</label>
                                            <select id="inputState" name="insertcolor" class="form-control">
                                                <option selected>primary</option>
                                                <option>secondary</option>
                                                <option>success</option>
                                                <option>danger</option>
                                                <option>warning</option>
                                                <option>info</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="insertAlert" class="btn btn-primary">Insert alert</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- ActivateModal -->
                <div class="modal fade" id="disable" tabindex="-1" aria-labelledby="disableAlertLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="disableAlertLabel">Warning</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to disable all alerts?
                            </div>
                            <div class="modal-footer">
                                <form method="post">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="disableAlerts" class="btn btn-warning">Disable all</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- AlertTable -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Message</th>
                            <th scope="col">
                                <div class="d-flex justify-content-center">Color</div>
                            </th>
                            <th scope="col">Active</th>
                            <th scope="col">Tools</th>
                        </tr>
                    </thead>
                    <?php
                    $alerts = selectAlerts();
                    if (!empty($alerts)) {
                        for ($i = 0; $i < count($alerts); $i++) { ?>
                            <tr>
                                <th scope="row"><?php echo $alerts[$i]['id'] ?></th>
                                <td><?php echo $alerts[$i]['message'] ?></td>
                                <td>
                                    <div style="margin-top: 0.6em;" class="d-flex justify-content-center align-self-center"><span class="badge badge-<?php echo $alerts[$i]['color'] ?>">&#32</span></div>
                                </td>
                                <td>
                                    <?php
                                    if ($alerts[$i]['active'] == 1) {
                                    ?><span class="badge badge-primary">Active</span><?php
                                                                                    } else {
                                                                                        ?><span class="badge badge-secondary">Inactive</span><?php
                                                                                                                                            }
                                                                                                                                                ?>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-toggle">
                                        <!-- ActivateButton -->
                                        <button class="btn btn-primary d-flex align-items-center" style="height: 24.5px;" type="button" data-toggle="modal" data-target="#Activate<?php echo $alerts[$i]['id'] ?>">
                                            <i class="bi bi-check"></i>
                                        </button>
                                        <!-- ActivateModal -->
                                        <div class="modal fade" id="Activate<?php echo $alerts[$i]['id'] ?>" tabindex="-1" aria-labelledby="ActivateAlertLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ActivateAlertLabel">Warning</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to activate the alert?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="post">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" name="activateAlert" value="<?php echo $alerts[$i]['id'] ?>" class="btn btn-primary">Activate Alert</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- EditButton -->
                                        <button class="btn btn-warning d-flex align-items-center" style="height: 24.5px;" type="button" data-toggle="modal" data-target="#edit<?php echo $alerts[$i]['id'] ?>">
                                            <i class="bi bi-dash" style="color: black;"></i>
                                        </button>
                                        <!-- EditeModal -->
                                        <div class="modal fade" id="edit<?php echo $alerts[$i]['id'] ?>" tabindex="-1" aria-labelledby="EditAlertLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ActivateAlertLabel">Update alert</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <!-- Message -->
                                                                <div class="col-md-12">
                                                                    <label for="exampleInputEmail1">Message</label>
                                                                    <input type="text" value="<?php echo $alerts[$i]['message'] ?>" name="updatemessage" class="form-control">
                                                                </div>

                                                                <!-- ColorSelect -->
                                                                <div class="form-group col-md-4">
                                                                    <label for="inputState">Color</label>
                                                                    <select id="inputState" name="updatecolor" class="form-control">
                                                                        <option selected>primary</option>
                                                                        <option>secondary</option>
                                                                        <option>success</option>
                                                                        <option>danger</option>
                                                                        <option>warning</option>
                                                                        <option>info</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" name="editAlert" value="<?php echo $alerts[$i]['id'] ?>" class="btn btn-warning">Update alert</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- DeleteModal -->
                                        <div class="modal fade" id="Delete<?php echo $alerts[$i]['id'] ?>" tabindex="-1" aria-labelledby="ActivateAlertLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ActivateAlertLabel">Warning</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete the alert?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="post">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" name="deleteAlert" value="<?php echo $alerts[$i]['id'] ?>" class="btn btn-danger">Delete Alert</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- DeleteButton -->
                                        <button class="btn btn-danger d-flex align-items-center" style="height: 24.5px;" type="button" data-toggle="modal" data-target="#Delete<?php echo $alerts[$i]['id'] ?>">
                                            <i class=" bi bi-x"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>