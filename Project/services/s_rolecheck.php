<?php
function getRoleNum($role)
{
    $rank = 0;
    switch ($role) {
        case empty($role):
            $rank = 0;
            break;
        case 'user':
            $rank = 1;
            break;
        case 'admin':
            $rank = 2;
            break;
        case 'superadmin':
            $rank = 3;
            break;
    }
    return $rank;
}

function checkRole($reqRole)
{
    $reqRoleNum = getRoleNum($reqRole);
    $roleNum = getRoleNum($_SESSION['role']);
    $path = "index.php";
    if ($reqRoleNum > $roleNum)
        header('Location: ' . $path);
}
