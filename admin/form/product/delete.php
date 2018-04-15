<?php
require_once("../../../config/db.php");
$db = new Database();
$pdo_conn = $db->connect();
$pdo_statement=$pdo_conn->prepare("delete from product where id=" . $_GET['id']);
$pdo_statement->execute();
$db->closeConnection($pdo_conn);
header('location:index.php');
?>