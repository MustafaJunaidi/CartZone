<?php
require "connection.php";
$adminName = $_SESSION['admin_name'];
$adminSQL = "SELECT administrator_id FROM administrator WHERE administrator_name = '$adminName'";
$result = DB()->query("$adminSQL");
$row = $result->fetch_assoc();

$adminID = $row['administrator_id'];


$userID = $_GET['id'];
$sql = "INSERT INTO customer_administrator (administrator_id , customer_id , ban_status)
VALUES ('$adminID', '$userID', 'BANNED')";

if (DB()->query("$sql")) {
    echo '<script>';
    echo "alert('User Banned Successfully')";
    echo '</script>';
    header("refresh:0; url=../users_table.php");
} else {
    $sql = "DELETE FROM customer_administrator WHERE customer_id='$userID'";
    DB()->query("$sql");
    echo '<script>';
    echo "alert('User is UnBanned Successfully')";
    echo '</script>';
    header("refresh:0; url=../users_table.php");
}

?>