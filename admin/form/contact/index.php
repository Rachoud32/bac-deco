<?php
require_once("../../../config/db.php");
require_once("../../controller/contact/contactController.php");
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
$contactController = new ContactController();
$result = $contactController->getAllContacts($pdo_conn);
?>

<table class="tbl-qa">
    <thead>
    <tr>
        <th class="table-header" width="20%">Name</th>
        <th class="table-header" width="20%">Email</th>
        <th class="table-header" width="20%">Phone</th>
        <th class="table-header" width="40%">Subject</th>
        <th class="table-header" width="40%">Message</th>
        <th class="table-header" width="5%">Actions</th>
    </tr>
    </thead>
    <tbody id="table-body">
    <?php
    if (!empty($result)) {
        foreach ($result as $row) {
            ?>
            <tr class="table-row">
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["phone"]; ?></td>
                <td><?php echo $row["subject"]; ?></td>
                <td><?php echo $row["message"]; ?></td>
                <td>
                    <a class="ajax-action-links" href='delete.php?id=<?php echo $row['id']; ?>'>
                        <img src="../../assets/img/delete.png" title="Delete"/>
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