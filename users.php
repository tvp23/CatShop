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
    <?php include 'components/c_nav.php'; ?>
    <?php include './services/s_db.php' ?>
    <?php
    if (isset($_POST['changeRole'])) {
        updateRole($_POST['changeRole'], $_POST['role']);
    }
    if (isset($_POST['deleteAccount'])) {
        deleteUser($_POST['deleteAccount']);
    }
    ?>
    <div class="container" style="margin-top: 10em;">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Users</h5>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">email</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Name</th>
                            <th scope="col">Role</th>
                            <th scope="col">Tools</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $users = selectUsers();
                        for ($i = 0; $i < count($users); $i++) { ?>
                            <tr>
                                <th scope="row"><?php echo $i + 1 ?></th>
                                <td colspan="3"><?php echo $users[$i]['email'] ?></td>
                                <td><?php echo $users[$i]['name'] ?></td>
                                <td>
                                    <?php if ($users[$i]['role'] == 'user') { ?>
                                        <span class="badge badge-primary">User</span>
                                    <?php } ?>
                                    <?php if ($users[$i]['role'] == 'admin') { ?>
                                        <span class="badge badge-success">Admin</span>
                                    <?php } ?>
                                    <?php if ($users[$i]['role'] == 'superadmin') { ?>
                                        <span class="badge badge-warning">Super-Admin</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <!-- RoleButton -->
                                        <button type="button" style="height: 24.5px;" class="btn btn-primary d-flex align-items-center" data-toggle="modal" data-target="#roleModal<?php echo $i ?>"><i class="bi bi-person-fill"></i></button>
                                        <!-- RoleModal -->
                                        <div class="modal fade" id="roleModal<?php echo $i ?>" tabindex="-1" aria-labelledby="RoleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="RoleModalLabel">Change Role</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <label class="input-group-text" for="inputGroupSelect01">Role</label>
                                                                </div>
                                                                <select name="role" class="custom-select" id="inputGroupSelect01">
                                                                    <option value="user" <?php if ($users[$i]['role'] == 'user') { ?>selected<?php } ?>>User</option>
                                                                    <option value="admin" <?php if ($users[$i]['role'] == 'admin') { ?>selected<?php } ?>>Admin</option>
                                                                    <option value="superadmin" <?php if ($users[$i]['role'] == 'superadmin') { ?>selected<?php } ?>>Super-Admin</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" name="changeRole" value="<?php echo $users[$i]['id'] ?>" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- DeleteModal -->
                                        <div class="modal fade" id="DeleteModal<?php echo $i ?>" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="DeleteModalLabel">Delete Account</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete <span style="font-weight: bold;"><?php echo $users[$i]['email'] ?></span>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form method="post">
                                                            <button type="submit" name="deleteAccount" value="<?php echo $users[$i]['id'] ?>" class="btn btn-danger">Delete Account</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- DeleteButton -->
                                        <button type="button" style="height: 24.5px;" class="btn btn-danger d-flex align-items-center" data-toggle="modal" data-target="#DeleteModal<?php echo $i ?>"><i class="bi bi-x"></i></button>
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