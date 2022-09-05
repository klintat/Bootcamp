<html>

<head></head>

<body>

    <?php if (isset($_POST["FirstName"]) && isset($_POST["LastName"])) { ?>
        <h1>Hello <?= $_POST["FirstName"] . " " . $_POST["LastName"] ?></h1>
    <?php } else { ?>
        <h1>Error occured</h1>
    <?php } ?>

</body>

</html>