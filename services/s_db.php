<?php

function connect()
{
    include $_SERVER['DOCUMENT_ROOT'] . '/secrets/info.db.php';
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/* 
*
* Users
*
*/
function selectUserWhereEmail($email)
{
    $conn = connect();

    $sql = "SELECT * FROM catshop_users WHERE email=:email";
    $params = array(
        ":email" => $email
    );

    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetch();
}

function insertUser($name, $email, $password, $role)
{
    $conn = connect();

    $sql = "INSERT INTO catshop_users (name, email, password, role) VALUES (:name, :email, :password, :role)";
    $params = array(":name" => $name, ":email" => $email, ":password" => $password, ":role" => $role,);

    $sth = $conn->prepare($sql);
    $sth->execute($params);
}

function selectUsers()
{
    $conn = connect();

    $sql = "SELECT id, email, name, role FROM catshop_users";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function updateRole($id, $role)
{
    $conn = connect();

    $sql = "UPDATE catshop_users SET role = :role WHERE id = :id;";
    $params = array(":id" => $id, ":role" => $role);

    $sth = $conn->prepare($sql);
    $sth->execute($params);
}

function deleteUser($id)
{
    $conn = connect();

    $sql = "DELETE FROM catshop_users WHERE id=:id";
    $params = array(":id" => $id);

    $sth = $conn->prepare($sql);
    $sth->execute($params);
}

/* 
*
* Products
*
*/
function selectProducts()
{
    $conn = connect();

    $sql = "SELECT * FROM catshop_products";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function selectProductsWhereName($name)
{
    $conn = connect();

    $sql = "SELECT * FROM catshop_products WHERE name LIKE :name";
    $params = array(
        ":name" => $name . '%'
    );

    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

/* 
*
* Alerts
*
*/
function selectAlerts()
{
    $conn = connect();

    $sql = "SELECT * FROM catshop_alerts";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function selectActiveAlert()
{
    $conn = connect();

    $sql = "SELECT * FROM catshop_alerts WHERE active = TRUE";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetch();
}

// Note
//     Updates current active to inactive and given id to active.
function updateActiveAlert($id)
{
    $conn = connect();

    $sql = "UPDATE catshop_alerts SET active = FALSE WHERE active = TRUE;
        UPDATE catshop_alerts SET active = TRUE WHERE id = :id";

    $params = array(":id" => $id);

    $sth = $conn->prepare($sql);
    $sth->execute($params);
}

function updateDisableAlerts()
{
    $conn = connect();

    $sql = "UPDATE catshop_alerts SET active = FALSE WHERE active = TRUE;";

    $sth = $conn->prepare($sql);
    $sth->execute();
}

function updateAlert($id, $message, $color)
{
    $conn = connect();

    $sql = "UPDATE catshop_alerts SET message = :message, color = :color WHERE id = :id;";
    $params = array(":id" => $id, ":message" => $message, ":color" => $color);

    $sth = $conn->prepare($sql);
    $sth->execute($params);
}

function insertAlert($message, $color)
{
    $conn = connect();

    $sql = "INSERT INTO catshop_alerts (message, color) VALUES (:message, :color);";
    $params = array(":message" => $message, ":color" => $color);

    $sth = $conn->prepare($sql);
    $sth->execute($params);
}

function deleteAlert($id)
{
    $conn = connect();

    $sql = "DELETE FROM catshop_alerts WHERE id = :id;";
    $params = array(":id" => $id);

    $sth = $conn->prepare($sql);
    $sth->execute($params);
}
