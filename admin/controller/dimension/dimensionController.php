<?php
require_once("../../../config/db.php");
require_once("../../model/dimenion/dimension.php");

class DimensionController
{
    function getAllDimensions($pdo_conn) {
        $pdo_statement = $pdo_conn->prepare("SELECT * FROM dimension ORDER BY id DESC");
        $pdo_statement->execute();
        return $result = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
    }
    function getDimensionById($pdo_conn, $id) {
        $pdo_statement = $pdo_conn->prepare("SELECT * FROM dimension where id=" . $id);
        $pdo_statement->execute();
        return $result = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
    }
}