<?php
require_once("config/db.php");
?>
<html>
<head>
    <title>PHP CRUD</title>
    <link rel="stylesheet" href="assets/CSS/style.css" type="text/css">
</head>
<body>
<?php
$db = new Database();
$pdo_conn = $db->connect();
$pdo_statement = $pdo_conn->prepare("SELECT * FROM posts ORDER BY id DESC");
$pdo_statement->execute();
$result = $pdo_statement->fetchAll();
$db->closeConnection($pdo_conn);
?>
<div class="create_button"><a href="add.php" class="button_link"><img src="crud-icon/add.png" title="Add New Record"
                                                                      class="add-icon"/>Create</a></div>
<table class="tbl-qa">
    <thead>
    <tr>
        <th class="table-header" width="20%">Title</th>
        <th class="table-header" width="40%">Description</th>
        <th class="table-header" width="20%">Date</th>
        <th class="table-header" width="5%">Actions</th>
    </tr>
    </thead>
    <tbody id="table-body">
    <?php
    if (!empty($result)) {
        foreach ($result as $row) {
            ?>
            <tr class="table-row">
                <td><?php echo $row["post_title"]; ?></td>
                <td><?php echo $row["description"]; ?></td>
                <td><?php echo $row["post_at"]; ?></td>
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
    ?>
    </tbody>
</table>
</body>
</html>