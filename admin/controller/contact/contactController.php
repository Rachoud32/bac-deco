<?php

class ContactController
{
    function getAllContacts($pdo_conn) {
        $pdo_statement = $pdo_conn->prepare("SELECT * FROM contact ORDER BY id DESC");
        $pdo_statement->execute();
        return $result = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
    }
}