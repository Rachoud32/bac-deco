<?php
require_once("../../../config/db.php");
require_once("../../model/product/product.php");

class ProductController
{
    private $product;

    function create($pdo_conn)
    {
        //print_r($_POST);die;
        if (!empty($_POST["add_record"])) {
            $this->product = new Product();
            $this->product->setReference($_POST['reference']);
            $this->product->setName($_POST['name']);
            $this->product->setPicture($_POST['fileToUpload']);
            $this->product->setDescription($_POST['description']);
            $this->product->setQuantity(intval($_POST['quantity']));
            $this->product->setPrice(floatval($_POST['price']));
            $this->product->setWaterReserve($_POST['water_reserve'] == 'on' ? 1 : 0);
            $this->product->setCreated($_POST['created']);
            $this->product->setUpdated($_POST['updated']);
            $this->product->setDimensionId($_POST['dimension']);
            $sql = "INSERT INTO product ( reference, name, picture, description, quantity, price, water_reserve, created, updated, dimension_id )
                    VALUES ( :reference, :name, :picture, :description, :quantity, :price, :water_reserve, :created, :updated, :dimension_id )";
            $pdo_statement = $pdo_conn->prepare($sql);

            $result = $pdo_statement->execute(array(
                    ':reference' => $_POST['reference'],
                    ':name' => $_POST['name'],
                    ':picture' => $_POST['fileToUpload'],
                    ':description' => $_POST['description'],
                    ':quantity' => $_POST['quantity'],
                    ':price' => $_POST['price'],
                    ':water_reserve' => $_POST['water_reserve'] == 'on' ? 1 : 0,
                    ':created' => $_POST['created'],
                    ':updated' => $_POST['updated'],
                    ':dimension_id' => $_POST['dimension']
                )
            );
            if (!empty($result)) {
                header('location:index.php');
            }
        }
    }

    function edit($pdo_conn)
    {
        if (!empty($_POST["save_record"])) {
            $this->product = new Product();
            $this->product->setReference($_POST['reference']);
            $this->product->setName($_POST['name']);
            $this->product->setPicture($_POST['fileToUpload']);
            $this->product->setDescription($_POST['description']);
            $this->product->setQuantity(intval($_POST['quantity']));
            $this->product->setPrice(floatval($_POST['price']));
            $this->product->setWaterReserve($_POST['water_reserve'] == 'on' ? 1 : 0);
            $this->product->setCreated($_POST['created']);
            $this->product->setUpdated($_POST['updated']);
            $this->product->setDimensionId($_POST['dimension']);
            $sql = "update product set reference= :reference, name= :name, picture= :picture, description= :description, quantity= :quantity, price= :price, water_reserve= :water_reserve, updated= :updated, dimension_id= :dimension_id where id=" . $_GET["id"];

            $pdo_statement = $pdo_conn->prepare($sql);

            $result = $pdo_statement->execute(array(
                    ':reference' => $_POST['reference'],
                    ':name' => $_POST['name'],
                    ':picture' => $_POST['fileToUpload'],
                    ':description' => $_POST['description'],
                    ':quantity' => $_POST['quantity'],
                    ':price' => $_POST['price'],
                    ':water_reserve' => $_POST['water_reserve'] == 'on' ? 1 : 0,
                    ':updated' => $_POST['updated'],
                    ':dimension_id' => $_POST['dimension']
                )
            );
            if (!empty($result)) {
                header('location:index.php');
            }
        }
    }

    function uploadFile()
    {
        $target_dir = "../../upload_files/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    function getProductById($pdo_conn)
    {
        $pdo_statement = $pdo_conn->prepare("SELECT * FROM product where id=" . $_GET["id"]);
        $pdo_statement->execute();
        return $result = $pdo_statement->fetchAll();
    }

    function getAllProducts($pdo_conn)
    {
        $pdo_statement = $pdo_conn->prepare("SELECT * FROM product ORDER BY id DESC");
        $pdo_statement->execute();
        return $result = $pdo_statement->fetchAll();
    }

    function delete($pdo_conn)
    {
        $pdo_statement = $pdo_conn->prepare("delete from product where id=" . $_GET['id']);
        $pdo_statement->execute();
    }

}