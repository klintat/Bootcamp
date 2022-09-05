<?php
$err = "";
if ($_POST["FirstName"] === "" || $_POST["LastName"] === "" || $_POST["EMail"] === "") {
    $err = "First Name, Last Name and E-Mail are mandatory!";
} else {

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $databasename = "js_06_02";

    $con = new mysqli($hostname, $username, $password, $databasename);

    $success = "";
    if ($con->connect_error) {
        $err = $con->connect_error;
    } else {
        $query = "INSERT INTO customer (firstname,lastname,email,phone) 
    VALUES('" . $_POST["FirstName"] .  "','" . $_POST["LastName"] .  "','" . $_POST["EMail"] .  "','" . $_POST["phone"] .  "')";
        if ($con->query($query)) {
            $success = "Customer successfully added";
        } else {
            $err = $con->error;
        }
    }
}
?>

<html>

<head>
</head>

<body>
    <?php if ($err != "") { ?>
        <h1 style="color:red"><?= $err ?></h1>
    <?php } else { ?>
        <h1 style="color:green"><?= $success ?></h1>
    <?php } ?>
</body>

</html>