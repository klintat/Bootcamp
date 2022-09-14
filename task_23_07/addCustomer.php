<?php
if ($_POST["FirstName"] === "" || $_POST["LastName"] === "" || $_POST["Email"] === "") {
    $errorMessage = "First name, Last name and email are mandatory.";
} else {
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $databasename = "js_06_02";
    
    $connection = new mysqli($hostname, $username, $password, $databasename);
    
    $errorMessage = "";
    
    if ($connection->connect_error) {
    $errorMessage = $connection->connect_error;
    }
    else {
        $querry = "INSERT INTO customer (firstname, lastname, email, phone, comments, photo)
        VALUES ('" . $_POST["FirstName"] . "','" . $_POST["LastName"] . "', '" . $_POST["Email"] . "','" . $_POST["Phone"] . "','" . $_POST["Comments"] . "','" . $_POST["Photo"] . "')";
        if ($connection->query($querry)) {
            $success = "Customer succesfully added."; 
        } else {
            $errorMessage = $connection->error;
        }
    }
}
?>

<html>

<?php
    include("header.php");
?>

<body>
    <?php include("navbar.php"); ?>
    <div class="container p-3">
        <?php if ($errorMessage != "") { ?>
        <div class="alert alert-danger" role="alert"><?= $errorMessage ?></div>
        <?php } else { ?>
        <div class="alert alert-success" role="alert"><?= $success?></div>
        <?php } ?>
    </div>
</body>

</html>