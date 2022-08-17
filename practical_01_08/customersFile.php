<?php
include("utils.php");
$customersHTML = "";
if (isset($_POST["filename"])) {
    $customersHTML = getCustomersFromXML($_POST["filename"]);
}

if (isset($_POST["filenameSave"])) {
    insertFromXML($_POST["filenameSave"]);
}
?>

<head>
    <?php include("header.php") ?>
</head>

<body>
    <form method="post">
        <input type="file" name="filename">
        <button class="btn">Read</button>
    </form>
    <div class="container">
        <b>
            <div class="row">
                <div class="col">
                    First name
                </div>
                <div class="col">
                    Last name
                </div>
                <div class="col">
                    E-Mail
                </div>
                <div class="col">
                    Phone
                </div>
            </div>
        </b>
        <?php echo ($customersHTML); ?>

        <?php if (isset($_POST["filename"])) { ?>
            <form method="post">
                <input hidden name="filenameSave" value="<?= $_POST["filename"] ?>">
                <button class="btn">Save to DB</button>
            </form>
        <?php } ?>
    </div>
</body>