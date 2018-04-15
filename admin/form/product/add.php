<?php
echo date('Y-m-d');
if (!empty($_POST["add_record"])) {
    require_once("../../config/db.php");
    require_once("../../controller/product/productController.php");
    $db = new Database();
    $pdo_conn = $db->connect();
    $productController = new ProductController();
    $productController->create($pdo_conn);
    $db->closeConnection($pdo_conn);
}
?>
<html>
<head>
    <title>Add New Product</title>
    <link rel="stylesheet" href="../../assets/CSS/style.css" type="text/css">
</head>
<body>
<div class="back-to-list"><a href="index.php" class="button_link">Back to List</a></div>
<div class="frm-add">
    <h1 class="demo-form-heading">Add New Product</h1>
    <form name="frmAdd" action="" method="POST">
        <div class="demo-form-row">
            <label>Reference: </label><br>
            <input type="text" name="reference" class="demo-form-field" required/>
        </div>
        <div class="demo-form-row">
            <label>Name: </label><br>
            <input type="text" name="name" class="demo-form-field" required/>
        </div>
        <div class="demo-form-row">
            <label>Description: </label><br>
            <textarea name="description" class="demo-form-field" rows="5" required></textarea>
        </div>
        <div class="demo-form-row">
            <label>Quantity: </label><br>
            <input type="number" name="quantity" class="demo-form-field" required/>
        </div>
        <div class="demo-form-row">
            <label>Price: </label><br>
            <input type="text" name="price" class="demo-form-field" required/>
        </div>
        <div class="demo-form-row">
            <input name="add_record" type="submit" value="Add" class="demo-form-submit">
        </div>
    </form>
</div>
</body>
</html>