<?php
require_once("../../config/db.php");
require_once("../../model/product/product.php");

class ProductController
{
    private $product;
    function create($pdo_conn) {
        if (!empty($_POST["add_record"])) {
            $this->product = new Product();
            $this->product->setName($_POST['name']);
            $this->product->setReference($_POST['reference']);
            $this->product->setDescription($_POST['description']);
            $this->product->setQuantity(intval($_POST['quantity']));
            $this->product->setPrice(floatval($_POST['price']));
            $this->product->setCreated(date("Y-m-d"));
            $this->product->setUpdated(date("Y-m-d"));
            $sql = "INSERT INTO product ( reference, name, description, quantity, price, created, updated )
                    VALUES ( :reference, :name, :description, :quantity, :price, :created, :updated )";
            $pdo_statement = $pdo_conn->prepare($sql);

            $result = $pdo_statement->execute(array(
                ':reference' => $_POST['reference'],
                ':name' => $_POST['name'],
                ':description' => $_POST['description'],
                ':quantity' => $_POST['quantity'],
                ':price' => $_POST['price'],
                ':created' => $_POST['created'],
                ':updated' => $_POST['updated'])
            );
            if (!empty($result)) {
                header('location:index.php');
            }
        }
    }
    function edit($pdo_conn) {
        if (!empty($_POST["save_record"])) {
            $this->product = new Product();
            $this->product->setName($_POST['name']);
            $this->product->setReference($_POST['reference']);
            $this->product->setDescription($_POST['description']);
            $this->product->setQuantity(intval($_POST['quantity']));
            $this->product->setPrice(floatval($_POST['price']));
            $this->product->setCreated(date("Y-m-d"));
            $this->product->setUpdated(date("Y-m-d"));
            $sql = "INSERT INTO product ( reference, name, description, quantity, price, created, updated )
                    VALUES ( :reference, :name, :description, :quantity, :price, :created, :updated )";
            $pdo_statement = $pdo_conn->prepare($sql);

            $result = $pdo_statement->execute(array(
                ':reference' => $_POST['reference'],
                ':name' => $_POST['name'],
                ':description' => $_POST['description'],
                ':quantity' => $_POST['quantity'],
                ':price' => $_POST['price'],
                ':created' => $_POST['created'],
                ':updated' => $_POST['updated'])
            );
            if (!empty($result)) {
                header('location:index.php');
            }
        }
    }

    function getProductById($pdo_conn) {
        $pdo_statement = $pdo_conn->prepare("SELECT * FROM product where id=" . $_GET["id"]);
        $pdo_statement->execute();
        return $result = $pdo_statement->fetchAll();
    }

    function getAllProducts($pdo_conn) {
        $pdo_statement = $pdo_conn->prepare("SELECT * FROM product ORDER BY id DESC");
        $pdo_statement->execute();
        return $result = $pdo_statement->fetchAll();
    }

    function delete($pdo_conn) {
        $pdo_statement=$pdo_conn->prepare("delete from product where id=" . $_GET['id']);
        $pdo_statement->execute();
    }

}