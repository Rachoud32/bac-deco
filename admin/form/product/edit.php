<?php
require_once("../../../config/db.php");
require_once("../../controller/product/productController.php");
require_once("../../controller/dimension/dimensionController.php");

$db = new Database();
$pdo_conn = $db->connect();
$productController = new ProductController();
if (!empty($_POST["save_record"])) {
    $productController->edit($pdo_conn);
}
$result = $productController->getProductById($pdo_conn);
$dimensionController = new DimensionController();
$dimensions = $dimensionController->getAllDimensions($pdo_conn);
$db->closeConnection($pdo_conn);
?>
<html>
<head>
    <title>Edit Record</title>
    <link rel="stylesheet" href="../../assets/CSS/style.css" type="text/css">
</head>
<body>
<div class="back-to-list"><a href="index.php" class="button_link">Back to List</a></div>
<div class="frm-add">
    <h1 class="demo-form-heading">Edit product</h1>
    <form name="frmAdd" action="" method="POST">
        <div class="demo-form-row">
            <label>Reference*: </label><br>
            <input type="text" name="reference" class="demo-form-field" value="<?php echo $result[0]['reference']; ?>"
                   required/>
        </div>
        <div class="demo-form-row">
            <label>Name*: </label><br>
            <input type="text" name="name" class="demo-form-field" value="<?php echo $result[0]['name']; ?>" required/>
        </div>
        <div class="demo-form-row">
            <label>Select image to upload: </label><br>
            <input type="file" name="fileToUpload" class="demo-form-field" id="fileToUpload"/>
        </div>
        <div class="demo-form-row">
            <label>Description: </label><br>
            <textarea name="description" class="demo-form-field" rows="5"
                      required><?php echo $result[0]['description']; ?></textarea>
        </div>
        <div class="demo-form-row">
            <label>Quantity*: </label><br>
            <input type="number" name="quantity" class="demo-form-field" value="<?php echo $result[0]['quantity']; ?>"
                   required/>
        </div>
        <div class="demo-form-row">
            <label>Price*: </label><br>
            <input type="text" name="price" class="demo-form-field" value="<?php echo $result[0]['price']; ?>"
                   required/>
        </div>
        <div class="demo-form-row">
            <label for="">Dimension</label><br>
            <select id="dimension" name="dimension">
                <?php foreach ($dimensions as $row) {
                    if ($result[0]['dimension_id'] == $row['id']) {
                        ?>
                        <option value="<?php echo $row['id']; ?>"
                                selected><?php echo $row['diameter'] . ' ' . $row['height'] . ' ' . $row['qube']; ?></option>
                        <?php
                    } else {
                        ?>
                        <option value="<?php echo $row['id']; ?>">
                            <?php echo $row['diameter'] . ' ' . $row['height'] . ' ' . $row['qube']; ?></option>
                        <?php
                    }
                    ?>
                <?php } ?>
            </select>
        </div>
        <div class="demo-form-row">
            <label>Water reserve: </label>
            <input type="checkbox" id="id-water_reserve" name="water_reserve" class="switch-input"/>
            <label for="id-water_reserve" class="switch-label"></label>
        </div>
        <div style="display: none;" class="demo-form-row">
            <input type="date" name="created" class="demo-form-field" value="<?php echo $result[0]['created']; ?>"/>
            <input type="date" name="updated" class="demo-form-field" value="<?php echo date("Y-m-d"); ?>"/>
        </div>
        <div class="demo-form-row">
            <input name="save_record" type="submit" value="Save" class="demo-form-submit">
        </div>
    </form>
</div>
</body>
</html>