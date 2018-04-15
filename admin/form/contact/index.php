<?php
require_once("../../../config/db.php");
require_once("../../controller/dimension/dimensionController.php");
require_once("../../controller/product/productController.php");
?>
<html>
<head>
    <title>Product list</title>
    <link rel="stylesheet" href="../../assets/CSS/style.css" type="text/css">
</head>
<body>
<?php
$db = new Database();
$pdo_conn = $db->connect();
$productController = new ProductController();
$dimensionController = new DimensionController();
$result = $productController->getAllProducts($pdo_conn);
?>
<div class="create_button"><a href="add.php" class="button_link"><img src="../../assets/img/add.png" title="Add New Product"
                                                                      class="add-icon"/>Create</a></div>
<table class="tbl-qa">
    <thead>
    <tr>
        <th class="table-header" width="20%">Reference</th>
        <th class="table-header" width="20%">Name</th>
        <th class="table-header" width="20%">Picture</th>
        <th class="table-header" width="40%">Description</th>
        <th class="table-header" width="40%">Quantity</th>
        <th class="table-header" width="20%">Price</th>
        <th class="table-header" width="20%">Water reserve</th>
        <th class="table-header" width="20%">Created date</th>
        <th class="table-header" width="20%">Updated date</th>
        <th class="table-header" width="20%">Dimension</th>
        <th class="table-header" width="5%">Actions</th>
    </tr>
    </thead>
    <tbody id="table-body">
    <?php
    if (!empty($result)) {
        foreach ($result as $row) {
            ?>
            <tr class="table-row">
                <td><?php echo $row["reference"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["picture"]; ?></td>
                <td><?php echo $row["description"]; ?></td>
                <td><?php echo $row["quantity"]; ?></td>
                <td><?php echo $row["price"]; ?></td>
                <td><?php echo ($row["water_reserve"] == 1 ? 'Yes' : 'No') ; ?></td>
                <td><?php echo $row["created"]; ?></td>
                <td><?php echo $row["updated"]; ?></td>
                <td>
                    <?php
                        $dimension = $dimensionController->getDimensionById($pdo_conn, $row["dimension_id"]);
                        if (!empty($dimension)) {
                            echo $dimension[0]['diameter'] . ' ' . $dimension[0]['height'] . ' ' . $dimension[0]['qube'];
                        }
                    ?>
                </td>
                <td>
                    <a class="ajax-action-links" href='edit.php?id=<?php echo $row['id']; ?>'>
                        <img src="crud-icon/edit.png" title="Edit"/>
                    </a>
                    <a class="ajax-action-links" href='delete.php?id=<?php echo $row['id']; ?>'>
                        <img src="crud-icon/delete.png" title="Delete"/>
                    </a>
                </td>
            </tr>
            <?php
        }
    }
    $db->closeConnection($pdo_conn);
    ?>
    </tbody>
</table>
</body>
</html>